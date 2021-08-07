<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = \App\Models\Section::all();
        $categories = \App\Models\Category::all();

        // Create a random number of questions for each section
        $sections->each(function ($section) use ($categories) {
            \App\Models\Question::factory()
                ->count(rand(2, 4))
                ->sequence(fn ($sequence) => ['order' => $sequence->index + 1])
                ->has(\App\Models\Category::factory()->count(2))
                ->create([
                    'question' => 'Question goes here - survid=' . $section->survey->id . '&secid=' . $section->id,
                    'section_id' => $section->id,
            ]);
        });
    }
}
