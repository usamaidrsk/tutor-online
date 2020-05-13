<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Propaganistas\LaravelPhone\PhoneNumber;
use Carbon\Carbon;
use App\Asigment;
use App\Teacher;
use DB;

class AsigmentController extends Controller
{
    const ALLOWED_FILE_EXTENSIONS = ['pdf', 'png', 'jpg', 'jpeg'];
    const MAX_FILE_SIZE = 500 * 1024; // 500KB
    const MAX_FILE_NUM = 3;
    const MIN_BUDGET = 5; // $ 5.00

    public function create()
    {
        // Teacher can not create new asigments
        if (auth()->check()) {
            return redirect('profile');
        }

        if ($email = Cookie::get('email')) {
            if (Asigment::where('email', $email)->exists()) {
                return redirect()->route('asigment.index');
            }
        }

        return view()->component(
            'asigment.create',
            ['title' => 'Nueva propuesta'],
            [
                'levels' => DB::table('levels')->get(),
                'categories' => DB::table('categories')->get(),
                'ALLOWED_FILE_EXTENSIONS' => $this::ALLOWED_FILE_EXTENSIONS,
                'MAX_FILE_SIZE' => $this::MAX_FILE_SIZE,
                'MAX_FILE_NUM' => $this::MAX_FILE_NUM,
            ]
        );
    }

    public function index()
    {
        if (auth()->check()) {
            return redirect('profile');
        }

        $email = Cookie::get('email');
        $asigment = Asigment::with('level', 'category', 'files')
            ->where('email', $email)
            ->first();

        if (!$asigment) {
            return redirect()->route('asigment.create');
        }

        if ($asigment->payment) {
            return redirect()->route('room');
        }

        $id = $asigment->id;

        $avalible_teachers = Teacher::select('teachers.*')
            ->join('invitations', 'teachers.id', '=', 'teacher_id')
            ->where([['asigment_id', $id], ['is_acepted', true]])
            ->get();

        return view()->component(
            'asigment.show',
            ['title' => 'Propuesta'],
            [
                'asigment' => $asigment,
                'teachers' => $avalible_teachers,
                'isNew' => request()->query('is-new', '0'),
            ]
        );
    }

    public function store()
    {
        $this->validator()->validate();

        $input = request()->only([
            'email',
            'phone',
            'budget',
            'details',
            'date',
            'level_id',
            'category_id',
        ]);

        $input['date'] = Carbon::parse($input['date']);

        $phone = request()->input('phone_prefix') . $input['phone'];
        $input['phone'] = (string) PhoneNumber::make($phone);

        $asigment = Asigment::create($input);

        try {
            $this->store_files($asigment);
            $this->invite_teachers($asigment);
        } catch (\Throwable $th) {
            $this->delete_files($asigment);
            $asigment->delete();
            throw $th;
        }

        return $this->response_with_cookie($asigment);
    }

    public function delete()
    {
        $email = Cookie::get('email');
        $asigment = Asigment::where('email', $email)->first();

        abort_if(!$asigment, 404);

        $this->delete_files($asigment);
        $asigment->delete();

        return $asigment;
    }

    public function conflict($action)
    {
        $email = request()->input('email');
        $asigment = Asigment::where('email', $email)->first();

        switch ($action) {
            case 'RECOVER':
                // For now there is nothing special needed to
                // recover old asigment, just return the
                // `email` cookie
                break;

            case 'OVERWRITE':
                $asigment->delete();
                $this->store();
                break;
        }

        return $this->response_with_cookie($asigment);
    }

    private function response_with_cookie(Asigment $asigment)
    {
        $response = \Response::make($asigment->id);
        $cookie = cookie()->forever('email', $asigment->email);
        $response->withCookie($cookie);

        return $response;
    }

    // Store in disk all files uploaded by user one by one
    // and at the same time store file details in database

    private function store_files(Asigment $asigment)
    {
        $folder = "attachments/{$asigment->id}";

        foreach (request()->file('files') as $file) {
            if (!$file->isValid()) {
                continue;
            }

            // TODO: if the file is an image we should compress it
            $filename = $file->store($folder);
            $path = "/storage/$filename";

            $asigment->files()->create([
                'name' => $file->getClientOriginalName(),
                'type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
                'path' => $path,
            ]);
        }
    }

    private function delete_files(Asigment $asigment)
    {
        $folder = "attachments/{$asigment->id}";
        Storage::deleteDirectory($folder);
    }

    // Query the database to find all teachers that
    // match with the asigment level, category and time
    // of the asigment and mail then an invitation

    private function invite_teachers(Asigment $asigment)
    {
        // This is the number of minutes of a class session
        // Theacer should not be invited if they acepted
        // another invitation to a class appointed to the same
        // day and hour
        $max_minutes = 60;

        $level_id = $asigment->level_id;
        $category_id = $asigment->category_id;

        $date = Carbon::parse($asigment->date);
        $day_of_week = ((int) $date->dayOfWeek) + 1;
        $year = $date->year;
        $time = $date->format('H:i');

        $matched_teachers = \DB::table('teachers as t')
            ->select('t.id as id')
            ->distinct()
            ->join('level_teacher as l_t', 't.id', '=', 'l_t.teacher_id')
            ->join('category_teacher as c_t', 't.id', '=', 'c_t.teacher_id')
            ->join('schedules as s', 't.id', '=', 's.teacher_id')
            ->leftJoin('invitations as i', 't.id', '=', 'i.teacher_id')
            ->leftJoin('asigments as a', 'a.id', '=', 'i.asigment_id')
            ->where([
                ['l_t.level_id', '=', $level_id],
                ['c_t.category_id', '=', $category_id],
                ['s.start', '<=', $time],
                ['s.end', '>=', $time],
                ['s.day_of_week', '=', $day_of_week],
            ])
            ->where(function ($query) use (
                $max_minutes,
                $day_of_week,
                $year,
                $time
            ) {
                $query
                    ->whereNull('a.id')
                    ->orWhere('i.is_acepted', false)
                    ->orWhere(function ($query) use (
                        $max_minutes,
                        $day_of_week,
                        $year,
                        $time
                    ) {
                        $query
                            ->whereRaw("DAYOFWEEK(a.date) <> $day_of_week")
                            ->orWhereRaw("YEAR(a.date) <> $year")
                            ->orWhereRaw(
                                "TIME(DATE_ADD(a.date, INTERVAL $max_minutes MINUTE)) <= '$time'"
                            )
                            ->orWhereRaw(
                                "TIME(DATE_SUB(a.date, INTERVAL $max_minutes MINUTE)) >= '$time'"
                            );
                    });
            })
            ->get();

        // Now create invitations in database
        $invitations = [];
        foreach ($matched_teachers as $teacher) {
            $invitations[] = [
                'asigment_id' => $asigment->id,
                'teacher_id' => $teacher->id,
            ];
        }

        $asigment->invitations()->createMany($invitations);

        try {
            $mail = new \App\Mail\Invitation($asigment);
            Mail::to($matched_teachers)->queue($mail);
        } catch (\Throwable $th) {
            report($th);
        }
    }

    public function validator()
    {
        $codes = DB::table('countries')
            ->select('code')
            ->get()
            ->map(function ($country) {
                return $country->code;
            })
            ->toArray();

        $rules = [
            'email' => 'required|email',
            'phone_prefix' => 'required|regex:/^(\+)([1-9]{2})$/',
            'phone' => 'required|phone:AUTO,' . implode(',', $codes),
            'budget' => 'required|numeric|min:' . $this::MIN_BUDGET,
            'details' => 'required|max:300|min:25',
            'level_id' => 'required|exists:levels,id',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date|after:today',
            'files' => 'required|array|min:1|max:' . $this::MAX_FILE_NUM,
            'files.*' =>
                'mimes:' .
                implode(',', $this::ALLOWED_FILE_EXTENSIONS) .
                '|max:' .
                $this::MAX_FILE_SIZE / 1024,
        ];

        $messages = [
            'budget.min' => 'El presupuesto mínimo es de $' . $this::MIN_BUDGET,
            'level_id.required' => 'Debes elegir el nivel de educación.',
            'category_id.required' => 'Debes elegir una materia.',
            'files.required' =>
                'Debes adjuntar al menos un archivo relacionado.',
            'files.min' => 'Debes adjuntar al menos un archivo relacionado.',
            'files.max' =>
                'No puedes adjuntar mas de ' .
                $this::MAX_FILE_NUM .
                'archivos.',
        ];

        return Validator::make(request()->all(), $rules, $messages);
    }
}
