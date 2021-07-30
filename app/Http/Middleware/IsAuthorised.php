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
        // Get the two values, and redirect if they're not present
        $invite = $request->session()->get('invite', false);
        $participantId = $request->get('p_id', false);
        if (! $invite || ! $participantId) {
            return redirect('/ask/invite-not-found');
        }

        // Abort if the participant_id !== the same one passed in the form
        abort_if(intval($participantId) !== $invite->participant_id, 403);
        return $next($request);
    }
}
