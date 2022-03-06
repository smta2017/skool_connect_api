<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('id');
            $table->string('first_name_en');
            $table->string('middle_name_en');
            $table->string('last_name_en');
            $table->string('first_name_ar');
            $table->string('middle_name_ar');
            $table->string('last_name_ar');
            $table->integer('division_id');
            $table->integer('grade_id');
            $table->integer('class_id');
            $table->string('national_no');
            $table->string('passport_no');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->date('october_age_date');
            $table->integer('academic_year_applying_id');
            $table->integer('nationality_id');
            $table->integer('gender_id');
            $table->integer('bus_id');
            $table->integer('religion_id');
            $table->string('previous_school_nursery');
            $table->string('address');
            $table->string('city');
            $table->string('email');
            $table->string('mobile');
            $table->date('submit_date');
            $table->string('photo');
            $table->string('code');
            $table->integer('lang_id');
            $table->integer('user_id');
            $table->string('birth_certificate');
            $table->string('academic_house');
            $table->string('report_cards');
            $table->string('referance_letter');
            $table->string('referance_name');
            $table->string('referance_email');
            $table->string('referance_phone');
            $table->date('enroll_date');
            $table->string('custody');
            $table->boolean('foreigner');
            $table->boolean('egy_returning');
            $table->boolean('transfer_from_cairo');
            $table->boolean('staff_child');
            $table->string('staff_no');
            $table->integer('student_status_id')->default(0);
            $table->boolean('learn_support');
            $table->string('learn_support_details');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students');
    }
}
