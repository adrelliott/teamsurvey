<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $participant = \App\Models\Participant::with('surveys', 'questions')->first();



        echo 'This may take a while too. We simulating ALL participants answering all questions on all sections of ALL surveys for EVERY client  - get a cup of coffee and two KitKats....';

        // Get all participants and group by by clients
        $allParticipants = \App\Models\Participant::all()->groupBy('client_id');

        // Loop through allParticipants and get the surveys for each client, with sections and questions
        foreach ($allParticipants as $client_id => $participant) {

            // Get all surveys available for this client
            $surveysAvailable = \App\Models\Survey::with(['sections', 'questions'])
                ->where('client_id', $client_id)
                ->get();

            // Now get all sections with questions ordered by section order
            foreach ($surveysAvailable as $survey) {
                $sections = $survey->questions()->groupBy('sections');
                dd($sections);
            }

            dd($surveysAvailable)->first();
        }

        // get all surveys, with sections & questions & group by clients
        $surveys = \App\Models\Survey::with(['sections', 'questions']);

        dd($surveys->first()->toArray());

        // Get all participants and group by by clients
        $allParticipants = \App\Models\Participant::all()->groupBy('client_id');

        // Get all aprt

        // Get all surveys, with sections & questions and sort by clients
        $allSurveys = \App\Models\Survey::all()->groupBy('client_id');


        // Now for each survey invite all participants to that survey
        foreach ($allSurveys as $client => $surveys) {
            $invited = $allParticipants[$client];
            $surveys->each(function ($survey) use ($invited) {
                $survey->invite($invited);
            });
        }
        echo ' And we are DONE!';
    }
}
