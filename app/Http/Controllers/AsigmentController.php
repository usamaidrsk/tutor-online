<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function show($id)
    {
        $asigment = Asigment::with('level', 'category', 'files')->findOrFail(
            $id
        );

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
            ]
        );
    }

    public function review($id)
    {
        return view()->component(
            'asigment.review',
            ['title' => 'Invitación'],
            ['asigment' => Asigment::with('files')->findOrfail($id)]
        );
    }

    public function store()
    {
        request()->validate(
            [
                'email' => 'required|email',
                'budget' => 'required|numeric|min:' . $this::MIN_BUDGET,
                'details' => 'required|max:300|min:25',
                'level_id' => 'required|exists:levels,id',
                'category_id' => 'required|exists:categories,id',
                'files' => 'required|array|min:1|max:' . $this::MAX_FILE_NUM,
                'files.*' =>
                    'mimes:' .
                    implode(',', $this::ALLOWED_FILE_EXTENSIONS) .
                    '|max:' .
                    $this::MAX_FILE_SIZE / 1024,
            ],
            [
                'budget.min' =>
                    'El presupuesto mínimo es de $' . $this::MIN_BUDGET,
                'level_id.required' => 'Debes elegir el nivel de educación.',
                'category_id.required' => 'Debes elegir una materia.',
                'files.required' =>
                    'Debes adjuntar al menos un archivo relacionado.',
                'files.min' =>
                    'Debes adjuntar al menos un archivo relacionado.',
                'files.max' =>
                    'No puedes adjuntar mas de ' .
                    $this::MAX_FILE_NUM .
                    'archivos.',
            ]
        );

        $asigment = Asigment::create(
            request()->only([
                'email',
                'budget',
                'details',
                'level_id',
                'category_id',
            ])
        );

        // Store in disk all files uploaded by user one by one
        // and at the same time store file details in database

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

        // Now query the database to find al teachers that
        // match with the asigment `level` and `category`
        $matched_teachers = Teacher::join(
            'level_teacher as l_t',
            'teachers.id',
            '=',
            'l_t.teacher_id'
        )
            ->join(
                'category_teacher as c_t',
                'teachers.id',
                '=',
                'c_t.teacher_id'
            )
            ->where([
                ['l_t.level_id', '=', $asigment->level_id],
                ['c_t.category_id', '=', $asigment->category_id],
            ])
            ->get();

        // Now create invitations in database
        foreach ($matched_teachers as $teacher) {
            $teacher->invitations()->create(['asigment_id' => $asigment->id]);
        }

        return $asigment;
    }

    public function update($id, int $answer)
    {
        $invitation = Teacher::findOrfail(auth()->user()->id)
            ->invitations()
            ->where('asigment_id', $id)
            ->first();

        if (!$invitation) {
            return null;
        }

        if ($answer) {
            $invitation->is_acepted = true;
            $invitation->save();
        } else {
            $invitation->delete();
        }

        return $answer;
    }
}
