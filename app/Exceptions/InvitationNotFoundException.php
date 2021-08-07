<?php

namespace App\Exceptions;

use Exception;

class InvitationNotFoundException extends Exception
{
    public function render()
    {
        return view('front-end.surveys.invitation-not-found');
    }
}
