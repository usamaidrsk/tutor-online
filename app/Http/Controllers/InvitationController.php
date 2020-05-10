<?php

namespace App\Http\Controllers;

use App\Teacher;

use Illuminate\Http\Request;
use App\Asigment;
use App\Invitation;

class InvitationController extends Controller
{
    public function show($id)
    {
        $asigment = Asigment::with('files')->findOrfail($id);
        $invitation = $asigment
            ->invitations()
            ->where('teacher_id', auth()->id())
            ->first();

        // Abort if the user is trying to see an asigmente that he
        // was'nt invited to
        abort_unless($invitation, 403);

        return view()->component(
            'invitation',
            ['title' => 'Invitación'],
            ['asigment' => $asigment, 'invitation' => $invitation]
        );
    }

    public function update($id, int $answer)
    {
        $invitation = Invitation::findOrFail($id);

        if ($answer) {
            $invitation->is_acepted = true;
            $invitation->save();
        } else {
            $invitation->delete();
        }

        return $invitation;
    }
}
