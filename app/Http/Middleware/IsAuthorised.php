<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAuthorised
{
    /**
     * Ensures that the participant_id passed in the form hasn't been tampered with
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the invite hash from the request & the invite object from the session
        $inviteHash = $request->get('i', false);
        $invitation = $request->session()->get('invitation.' . $inviteHash);

        // Redirect if the id doesn't exist
        if (! $inviteHash || ! $invitation) {
            return redirect()->route('surveys.inviteNotFound');
        }

        return $next($request);
    }
}
