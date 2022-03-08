<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id('id');
            $table->integer('student_id');
            $table->integer('admission_status_id');
            $table->integer('evaluation_card_id');
            $table->string('apply_reason')->nullable();
            $table->integer('division_id')->nullable();
            $table->integer('grade_id')->nullable();
            $table->integer('apply_year_id')->nullable();
            $table->integer('apply_month')->nullable();
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
        Schema::drop('admissions');
    }
}
