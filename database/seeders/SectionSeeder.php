<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all surveys
        $surveys = \App\Models\Survey::all();

        // Create a random number of sections for each survey
        $surveys->each(function ($survey) {
            \App\Models\Section::factory()
                ->count(rand(3, 7))
                ->sequence(fn ($sequence) => ['order' => $sequence->index + 1])
                ->create([
                    'survey_id' => $survey->id,
            ]);
        });
    }
}
