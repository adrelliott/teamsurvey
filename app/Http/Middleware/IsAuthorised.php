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
        // Get the invitation object from the request & redirect if it doesn't exist
        $invitation = $request->session()->get('invitation', false);
        if (! $invitation) {
            return redirect()->route('surveys.inviteNotFound');
        }

        return $next($request);
    }
}
