<?php

namespace App\Http\Controllers\Participants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participant;

class ResponseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $inviteHash)
    {
        // Vaidate

        // Get invitation from session & find the participant
        $invitation = $request->session()->get('invitation');
        $participant = Participant::firstOrFail('id', $invitation->participant_id);

        // Pass the 'responses' array to the participant model to save

        // Update the invitation with the current section no
        $participant->updateSectionNumber($request->get('c', 0), $request->get('t', 0));
        dd('line 29');
        // redirect


        dd($request->all());
        // Validate (faking it for now)
        $responses = $request->get('responses', false);

        // Set up the array to persist
        $toSave = [];
        foreach ($responses as $question_id => $response) {
            $toSave[] = [
                'question_id' => $question_id,
                'response' => $response,
            ];
        }

        // Get invitation from session & find the participant
        $invitation = $request->session()->get('invitation');
        $participant = Participant::firstOrFail('id', $invitation->participant_id);



        // Now sync the participant_question rows & redirect to the survey
        $participant->saveResponses($toSave);
        // $invitation = Invitation::firstOrFail('id', $invitation->id)->update(['current_section_id' => ])

        // Now update the invitation
        // $invitation = Invitation::firstOrFail('id', $invitation->id)->update(['current_section_id' => ])


        return redirect()->route('ask.show', ['inviteHash' => $inviteHash]);


        // Inviation::sync();

        dd($responses);

        // Make a new Response model
        // $response = Invitation::make([
        //     'participant_id' => ,
        //     'question_id' => ,
        //     'response' => ,
        // ]);

        // Validate

        // Store Response (parcipant_question pivot table)

        // Update Invitation (participant_survey pivot table)

        // redirect to survey
        return redirect();
    }
}
