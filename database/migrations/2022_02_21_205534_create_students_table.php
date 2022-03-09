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
            $table->string('first_name_en')->nullable();
            $table->string('middle_name_en')->nullable();
            $table->string('last_name_en')->nullable();
            $table->string('first_name_ar')->nullable();
            $table->string('middle_name_ar')->nullable();
            $table->string('last_name_ar')->nullable();
            $table->integer('division_id');
            $table->integer('grade_id');
            $table->integer('class_id')->nullable();
            $table->string('national_no')->nullable();
            $table->string('passport_no')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('october_age_date')->nullable()->nullable();
            $table->integer('academic_year_applying_id');
            $table->integer('nationality_id');
            $table->integer('gender_id');
            $table->integer('bus_id');
            $table->integer('religion_id');
            $table->string('previous_school_nursery')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('photo')->nullable();
            $table->string('code')->nullable();
            $table->integer('lang_id');
            $table->integer('user_id');
            $table->string('birth_certificate')->nullable();
            $table->string('academic_house')->nullable();
            $table->string('report_cards')->nullable();
            $table->string('referance_letter')->nullable();
            $table->string('referance_name')->nullable();
            $table->string('referance_email')->nullable();
            $table->string('referance_phone')->nullable();
            $table->string('custody')->nullable();
            $table->boolean('foreigner')->nullable();
            $table->boolean('egy_returning')->nullable();
            $table->boolean('transfer_from_cairo')->nullable();
            $table->boolean('staff_child')->nullable();
            $table->string('staff_no')->nullable();
            $table->integer('student_status_id')->default(0);
            $table->boolean('learn_support')->nullable();
            $table->string('learn_support_details')->nullable();
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
