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
                ->count(rand(7, 10))
                ->sequence(fn ($sequence) => ['order' => $sequence->index + 1])
                ->has(\App\Models\Category::factory()->count(2))
                ->create([
                    'section_id' => $section->id,
            ]);
        });
        // Get all sections
        // $sections = \App\Models\Section::all();
        // $categories = \App\Models\Category::all();

        // // Create a random number of questions for each section
        // $sections->each(function ($section) {
        //     \App\Models\Question::factory()
        //         ->count(rand(7, 10))
        //         ->sequence(fn ($sequence) => ['order' => $sequence->index])
        //         ->has($categories->random(3))
        //         ->create([
        //             'section_id' => $section->id,
        //     ]);
        // });

        // // Create a random number of questions for each section
        // $sections->each(function ($section) use ($categories) {
        //     \App\Models\Question::factory(rand(7, 10))
        //     ->hasCategories(rand(1, 3))
        //     ->create([
        //         'section_id' => $section->id,
        //     ]);
        // });
    }
}
