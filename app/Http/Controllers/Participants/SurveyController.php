<?php

namespace App\Http\Controllers\Participants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Surveys\SurveyService;
use App\Models\Survey;

class SurveyController extends Controller
{
    protected $surveyService;

    public function __construct(SurveyService $surveyService)
    {
        $this->surveyService = $surveyService;
    }

    /**
     * Display the survey start page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // Check we have an invite model in the session
        $invite = $request->session()->get('invite', false);
        if (! $invite) {
            return redirect('/ask/invite-not-found');
        }

        // Get the survey, and if it isn't active or doesn't exits, redirect
        $survey = $this->surveyService->findActiveSurveyById($invite->survey_id);
        if (! $survey) {
            return redirect('/ask/survey-not-available');
        }

        // Get current section
        $section = $this->surveyService->getCurrentSection($invite->current_section_id);

        // Return view with the vars required
        return view('participants.surveys.view', [
            'invite'    => $invite,
            'survey'    => $survey,
            'currentSection'    => $section,
            'totalSections'    => $this->surveyService->totalNoOfSections(),
            'questions'    => $section->questions,
        ]);
    }
}
