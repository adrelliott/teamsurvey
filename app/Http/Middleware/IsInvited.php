<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;
use App\Models\Invitation;

class IsInvited
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Look for segment 2 (/ask/ThisValue), sanitise & unhash
        $inviteHash = filter_var($request->segment(2), FILTER_SANITIZE_STRING);
        $id = head(Hashids::decode($inviteHash)); //Decode returns an array

        // Redirect if the id doesn't exist
        if (! $id) {
            return redirect()->route('surveys.inviteNotFound');
        }

        // Check participants_survey & redirect if nothing found
        $invitation = Invitation::where('id', $id)
            ->whereNotNull('invited_at')
            ->first();
        if (! $invitation) {
            return redirect('/ask/invite-not-found');
        }

        // Store the invite array in session & move on
        $invitation->invite_hash = $inviteHash;
        $request->session()->put('invitation', $invitation);
        // dd($request->session()->get('invitation'));
        return $next($request);
    }
}
