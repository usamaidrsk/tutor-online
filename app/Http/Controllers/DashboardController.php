<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $type = $user->userable_type;
        $id = $user->userable_id;

        if ($user->isNot('teacher') && $user->isNot('student')) {
            return redirect()->route('choose-account-type');
        }

        $props = [];

        if ($user->is('student')) {
            $student = \App\Student::findOrFail($id);
            $asigments = \App\Asigment::where('student_id', $id)
                ->where(function ($query) {
                    $query
                        ->where('status', 'evaluating')
                        ->orWhere('status', 'waiting-for-class');
                })
                ->get();

            $openAsigments = $asigments
                ->filter(function ($asigment) {
                    return $asigment->status === 'evaluating';
                })
                ->map(function ($asigment) {
                    $asigment->invitations = $asigment
                        ->invitations()
                        ->where('status', 'accepted')
                        ->count();
                    return $asigment;
                });

            $scheduledClasses = $asigments
                ->filter(function ($asigment) {
                    return $asigment->status === 'waiting-for-class';
                })
                ->map(function ($asigment) {
                    $teacher = \App\Teacher::find($asigment->teacher_id);
                    $asigment->teacher = array_merge(
                        $teacher->user->toArray(),
                        $teacher->toArray()
                    );
                    return $asigment;
                });

            $student = array_merge($user->toArray(), $student->toArray());

            $props = compact('student', 'openAsigments', 'scheduledClasses');
        } elseif ($user->is('teacher')) {
            $teacher = \App\Teacher::findOrFail($id);

            if (!$teacher->answered_questions) {
                return redirect()->route('questions', 1);
            }

            $teacher->address;
            $teacher->schedule;

            $props = [
                'teacher' => array_merge($user->toArray(), $teacher->toArray()),
                'invitations' => \App\Asigment::select(
                    'asigments.*',
                    'i.id as invitation_id'
                )
                    ->with('level', 'category')
                    ->join('invitations as i', function ($join) use ($id) {
                        $join->where([
                            ['i.teacher_id', $id],
                            ['i.status', 'pending'],
                        ]);
                    })
                    ->where('asigments.status', 'evaluating')
                    ->orderBy('asigments.created_at', 'desc')
                    ->get(),
                'scheduledClasses' => \App\Asigment::with('level', 'category')
                    ->where([
                        ['teacher_id', $id],
                        ['status', 'waiting-for-class'],
                    ])
                    ->get(),
            ];
        }

        return view()->component(
            "dashboard.{$type}.index",
            ['title' => 'Dashboard'],
            $props
        );
    }

    public function edit()
    {
        $user = auth()->user();

        if ($user->isNot('teacher')) {
            return redirect()->back();
        }

        $teacher = \App\Teacher::with(
            'levels',
            'categories',
            'address',
            'bank'
        )->findOrFail($user->userable_id);

        if (!$teacher->answered_questions) {
            return redirect()->route('questions', 1);
        }

        return view()->component(
            'dashboard.teacher.edit',
            ['title' => 'Editar'],
            [
                'teacher' => array_merge($user->toArray(), $teacher->toArray()),
                'categories' => \DB::table('categories')->get(),
                'levels' => \DB::table('levels')->get(),
                'countries' => \DB::table('countries')
                    ->get()
                    ->map(function ($country) {
                        return [
                            'value' => $country->id,
                            'label' => $country->name,
                        ];
                    }),
            ]
        );
    }
}
