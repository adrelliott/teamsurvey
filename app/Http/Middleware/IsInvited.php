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
        // Check for key in url, and assign if it's present
        if (! $invite_hash = $request->get('k', false)) {
            return redirect('/ask/invite-not-found');
        }

        // Check participants_survey for a row with this hash and where invited_at isn't null
        try {
            $invite = Invitation::where('invite_hash', $invite_hash)
            ->whereNotNull('invited_at')
            ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            // Overide the 404 - that's just confusing
            if ($e instanceof ModelNotFoundException) {
                return redirect('/ask/invite-not-found');
            }
        }

        // Store the particpant_id and survey_id in the session & proceed
        $request->session()->put('participant_id', $invite->participant_id);
        $request->session()->put('survey_id', $invite->survey_id);

        return $next($request);
    }
}
