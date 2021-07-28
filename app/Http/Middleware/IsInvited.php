<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $inviteHash = $request->get('k', false);

        // Make sure an invite_hash is available in the URL
        if (! $inviteHash) {
            return redirect('/ask/invite-not-found');
        }

        // Check participants_survey for a row with this hash and where invited_at isn't null
        try {
            $invite = Invitation::where('invite_hash', $inviteHash)
            ->whereNotNull('invited_at')
            ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            // Overide the 404 - that's just confusing for the user
            if ($e instanceof ModelNotFoundException) {
                return redirect('/ask/invite-not-found');
            }
        }

        // Store the invite array in session & move on
        $request->session()->put('invite', $invite);
        return $next($request);
    }
}
