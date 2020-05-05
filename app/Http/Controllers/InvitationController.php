<?php

namespace App\Http\Controllers;

use App\Teacher;

use Illuminate\Http\Request;
use App\Invitation;

class InvitationController extends Controller
{
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
