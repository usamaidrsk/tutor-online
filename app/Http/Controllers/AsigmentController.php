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
        return view()->component(
            'asigment.show',
            ['title' => 'Propuesta'],
            [
                'asigment' => Asigment::findOrFail($id),
                'teachers' => Teacher::get(),
            ]
        );
    }

    public function store()
    {
        $validatedData = request()->validate(
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
                'files.min' =>
                    'Debes adjuntar al menos un archivo relacionado.',
                'files.max' =>
                    'No puedes adjuntar mas de ' .
                    this::MAX_FILE_NUM .
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

        foreach (request()->file('files') as $file) {
            if (!$file->isValid()) {
                continue;
            }

            // TODO: maybe should if the file is
            // an image we should compress it

            $asigment->files()->create([
                'name' => $file->getClientOriginalName(),
                'path' => $file->store('attachments'),
            ]);
        }

        return $asigment;
    }
}
