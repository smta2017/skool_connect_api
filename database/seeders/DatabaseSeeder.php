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
        \App\Models\User::factory(config("app.seeder_count",10))->create();
        \App\Models\UserType::factory(config("app.seeder_count",10))->create();
    }
}
