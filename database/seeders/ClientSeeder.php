<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 clients, with associated users, surveys and participants
        \App\Models\Client::factory()
            ->count(5)
            ->hasUsers(2)
            ->hasSurveys(3)
            ->hasParticipants(11)
            ->create();
    }
}
