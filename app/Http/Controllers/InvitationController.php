<?php

namespace App\Http\Controllers;

use App\Teacher;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        // Do not show an invitations that was already accepted
        if ($invitation->status === 'accepted') {
            return redirect()->route('dashboard.index');
        }

        return view()->component(
            'invitation',
            ['title' => 'Invitación'],
            ['asigment' => $asigment, 'invitation' => $invitation]
        );
    }

    public function update($id, int $answer)
    {
        $invitation = Invitation::findOrFail($id);
        $invitation->status = $answer ? 'accepted' : 'denied';
        $invitation->save();

        if ($answer) {
            try {
                $mail = new \App\Mail\Notification();
                Mail::to($invitation->asigment->email)->queue($mail);
            } catch (\Throwable $th) {
                report($th);
            }
        }

        return $invitation;
    }
}
