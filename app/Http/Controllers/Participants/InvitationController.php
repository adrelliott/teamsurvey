<?php

namespace App\Http\Controllers\Participants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\InvitationNotFoundException;
use App\Services\Surveys\SurveyService;
use App\Models\Participant;
use App\Models\Invitation;

class InvitationController extends Controller
{
    protected $surveyService;

    public function __construct(SurveyService $surveyService)
    {
        $this->surveyService = $surveyService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Invitation $invitation, Request $request)
    {
        // Firstly save the questions
        $participant = Participant::where('id', $invitation->participant_id)->first();
        $participant->saveResponses($request->get('responses'));

        // Update the current section on the invite & show next section
        $surveyStatus = $invitation->saveResponses($request->all());

        // Determine whether the survey has finished or not
        if ($surveyStatus) {
            return redirect()->route('surveys.surveyCompleted');
        }
        return redirect()->route('ask.show', ['invitation' => $invitation->invite_hash]);


        // $update = ['current_section_no' => intval($request->get('c', 0)) + 1];
        // if ($update['current_section_no'] == $request->get('t')) {
        //     $update['completed_at'] = now();
        //     $invitation->update($update);
        //     return redirect()->route('surveys.surveyCompleted');
        // }
        // if ($update['current_section_no'] == 1) {
        //     $update['started_at'] = now();
        // }

        // $invitation->update($update);
        // return redirect()->route('ask.show', ['invitation' => $invitation->invite_hash]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation)
    {
        // Abort if not invited & return early if survey is completed
        throw_if(! $invitation->invited_at, InvitationNotFoundException::class);
        if ($invitation->completed_at) {
            return redirect()->route('surveys.surveyCompleted');
        }

        // Set the survey up & redirect if it's not
        $survey = $this->surveyService->getSurvey($invitation);
        return view('front-end.surveys.show', compact('invitation', 'survey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
