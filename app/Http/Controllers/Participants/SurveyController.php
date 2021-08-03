<?php

namespace App\Http\Controllers\Participants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Surveys\SurveyService;
use App\Models\Invitation;
use App\Models\Survey;

class SurveyController extends Controller
{
    protected $surveyService;


    public function __construct(SurveyService $surveyService, Request $request)
    {
        $this->surveyService = $surveyService;
    }

    /**
     * Display the survey start page.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // Get the invite from the session (set in the is_invited middleware)
        $inviteHash = $inviteHash = filter_var($request->segment(2), FILTER_SANITIZE_STRING);
        $invitation = $request->session()->get('invitation.' . $inviteHash);

        // Get the survey, and if it isn't active or doesn't exist, redirect
        $survey = $this->surveyService->getSurvey($invitation);
        if (! $survey) {
            return redirect()->route('surveys.surveyNotFound');
        }

        // Return view with the vars required
        return view('participants.surveys.view', [
            'invitation'            => $invitation,
            'survey'                => $survey,
            'invite_hash'           => $inviteHash,
        ]);
    }

    public function store(StoreQuestionResponseRequest $formRequest)
    {
        dd($formRequest->session()->get('invitation'));
        // $this->invitation = Invitation::findByHashedId($inviteHash);
        $this->invitation->current_section_id = 2;
        $this->invitation->save();
    }
}
