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
        $AS->insert(['name' => 'New']);
        $AS->insert(['name' => 'To_Assess']);
        $AS->create(['name' => 'Re_Assess']);
        $AS->create(['name' => 'To_Interview']);
        $AS->create(['name' => 'Waiting_List']);
        $AS->create(['name' => 'Accepted']);
        $AS->create(['name' => 'Rejected']);
        $Gr = new \App\Models\Gender();
        $Gr->truncate();
        $Gr->insert(['name' => 'Male']);
        $Gr->insert(['name' => 'Female']);
        $Re = new \App\Models\Religion();
        $Re->truncate();
        $Re->insert(['name' => 'Muslim']);
        $Re->insert(['name' => 'Christian']);
        $Re->insert(['name' => 'Other']);
        \App\Models\User::factory(config("app.seeder_count",10))->create();
        \App\Models\UserType::factory(config("app.seeder_count",10))->create();
        \App\Models\Division::factory(config("app.seeder_count",10))->create();
        \App\Models\Grade::factory(config("app.seeder_count",10))->create();
        \App\Models\StClass::factory(config("app.seeder_count",10))->create();
        \App\Models\ApplyYear::factory(config("app.seeder_count",10))->create();
        \App\Models\Nationality::factory(config("app.seeder_count",10))->create();
        \App\Models\Bus::factory(config("app.seeder_count",10))->create();
        \App\Models\Language::factory(config("app.seeder_count",10))->create();
        \App\Models\Student::factory(config("app.seeder_count",10))->create();
        \App\Models\MaritalStatus::factory(config("app.seeder_count",10))->create();
        \App\Models\StParent::factory(config("app.seeder_count",10))->create();
        \App\Models\Admission::factory(config("app.seeder_count",10))->create();
        \App\Models\SchoolBuilding::factory(config("app.seeder_count",10))->create();
        \App\Models\EvaluationCard::factory(config("app.seeder_count",10))->create();

    }
}
