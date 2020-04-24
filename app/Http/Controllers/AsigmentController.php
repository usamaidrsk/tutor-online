<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asigment;
use DB;

class AsigmentController extends Controller
{
    const ALLOWED_FILE_EXTENSIONS = ['pdf', 'png', 'jpg', 'jpeg'];
    const MAX_FILE_SIZE = 1 * 1024 * 1024; // 1MB
    const MAX_FILE_NUM = 3;

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
            ['title' => ''],
            ['asigment' => []]
        );
    }

    public function store()
    {
        $validatedData = request()->validate([
            'email' => 'required|email',
            'budget' => 'required|numeric|min:5',
            'details' => 'required|max:300|min:50',
            'level_id' => 'required|exists:levels,id',
            'category_id' => 'required|exists:categories,id',
            'files' => 'required|array|min:1|max:' . $this::MAX_FILE_NUM,
            'files.*' =>
                'mimes:' .
                implode(',', $this::ALLOWED_FILE_EXTENSIONS) .
                '|max:' .
                $this::MAX_FILE_SIZE / 1024,
        ]);

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

            $asigment->files()->create([
                'name' => $file->getClientOriginalName(),
                'path' => $file->store('attachments'),
            ]);
        }
    }
}
