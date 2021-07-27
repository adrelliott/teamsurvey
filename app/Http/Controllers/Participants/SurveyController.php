<?php

namespace App\Http\Controllers\Participants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;

class SurveyController extends Controller
{

    /**
     * Display the survey start page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $survey = Survey::find($request->session()->get('survey_id'));

        ddd($survey);
        // Check to see if survey exists, and is open to participants
        try {
            $survey = Survey::get($request->session()->get('survey_id'))
            ->whereNotNull('published_at')
            ->whereNull('closed_at')
            ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            if ($e instanceof ModelNotFoundException) {
                dd('Survey either closed or not published yet');
            }
        }

        ddd($survey);
        // $survey_id = $request->session()->get('survey_id', null);
        // $survey = Survey::findOrFail($survey_id);

        // // return the 'start survey' view
        // return view('particpants.start-survey', compact('survey'));
        // get the survey (name only), with sections ordered by order, get first where is_completed=null
    }
}
