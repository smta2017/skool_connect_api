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
        $AdmissionStatus = new \App\Models\AdmissionStatus();
        $AdmissionStatus->truncate();
        $AdmissionStatus->insert(['name' => 'New']);
        $AdmissionStatus->insert(['name' => 'To_Assess']);
        $AdmissionStatus->create(['name' => 'Re_Assess']);
        $AdmissionStatus->create(['name' => 'To_Interview']);
        $AdmissionStatus->create(['name' => 'Waiting_List']);
        $AdmissionStatus->create(['name' => 'Accepted']);
        $AdmissionStatus->create(['name' => 'Rejected']);
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $Gender = new \App\Models\Gender();
        $Gender->truncate();
        $Gender->insert(['name' => 'Male']);
        $Gender->insert(['name' => 'Female']);
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $Religion = new \App\Models\Religion();
        $Religion->truncate();
        $Religion->insert(['name' => 'Muslim']);
        $Religion->insert(['name' => 'Christian']);
        $Religion->insert(['name' => 'Other']);
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $MaritalStatus = new \App\Models\MaritalStatus();
        $MaritalStatus->truncate();
        $MaritalStatus->insert(['name' => 'Married']);
        $MaritalStatus->insert(['name' => 'Divorced']);
        $MaritalStatus->insert(['name' => 'Widowed']);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
        \App\Models\StParent::factory(config("app.seeder_count",10))->create();
        \App\Models\Admission::factory(config("app.seeder_count",10))->create();
        \App\Models\SchoolBuilding::factory(config("app.seeder_count",10))->create();
        \App\Models\EvaluationCard::factory(config("app.seeder_count",10))->create();

    }
}
