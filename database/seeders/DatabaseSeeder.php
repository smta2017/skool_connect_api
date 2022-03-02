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
        $AS = new \App\Models\AdmissionStatus();
        $AS->truncate();
        $AS->insert(['name' => 'To Assess']);
        $AS->create(['name' => 'Re-Assess']);
        $AS->create(['name' => 'To Interview']);
        $AS->create(['name' => 'Waiting List']);
        $AS->create(['name' => 'Accepted']);
        $AS->create(['name' => 'Rejected']);
        \App\Models\User::factory(config("app.seeder_count",10))->create();
        \App\Models\UserType::factory(config("app.seeder_count",10))->create();
        \App\Models\Division::factory(config("app.seeder_count",10))->create();
        \App\Models\Grade::factory(config("app.seeder_count",10))->create();
        \App\Models\StClass::factory(config("app.seeder_count",10))->create();
        \App\Models\ApplyYear::factory(config("app.seeder_count",10))->create();
        \App\Models\Nationality::factory(config("app.seeder_count",10))->create();
        \App\Models\Gender::factory(config("app.seeder_count",10))->create();
        \App\Models\Bus::factory(config("app.seeder_count",10))->create();
        \App\Models\Religion::factory(config("app.seeder_count",10))->create();
        \App\Models\Language::factory(config("app.seeder_count",10))->create();
        \App\Models\Student::factory(config("app.seeder_count",10))->create();
        \App\Models\MaritalStatus::factory(config("app.seeder_count",10))->create();
        \App\Models\StParent::factory(config("app.seeder_count",10))->create();
        \App\Models\Admission::factory(config("app.seeder_count",10))->create();
        \App\Models\SchoolBuilding::factory(config("app.seeder_count",10))->create();
        \App\Models\EvaluationCard::factory(config("app.seeder_count",10))->create();

    }
}
