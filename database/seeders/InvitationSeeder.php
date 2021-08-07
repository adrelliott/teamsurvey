<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->comment('This may take a while. We are inviting ALL participants to ALL surveys for EVERY client  - get a cup of coffee and a KitKat....');
        // Get all surveys and group by clients
        $allSurveys = \App\Models\Survey::all()->groupBy('client_id');

        // Get all participants and group by clients
        $allParticipants = \App\Models\Participant::all()->groupBy('client_id');

        // Now for each survey invite all participants to that survey
        foreach ($allSurveys as $client => $surveys) {
            $invited = $allParticipants[$client]->pluck('id');
            $surveys->each(function ($survey) use ($invited) {
                $survey->invite($invited);
            });
        }
        $this->command->comment('.........And we are DONE!');
    }
}
