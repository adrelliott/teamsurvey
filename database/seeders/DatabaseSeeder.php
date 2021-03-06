<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ClientSeeder::class,
            SectionSeeder::class,
            // CategorySeeder::class,
            QuestionSeeder::class,
            InvitationSeeder::class,
            // ResponseSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
