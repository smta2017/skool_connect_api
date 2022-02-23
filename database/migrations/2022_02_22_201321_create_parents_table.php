<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id('id');
            $table->string('first_name_en');
            $table->string('middle_name_en');
            $table->string('last_name_en');
            $table->string('first_name_ar');
            $table->string('middle_name_ar');
            $table->string('last_name_ar');
            $table->integer('marital_status_id');
            $table->string('university');
            $table->string('occupation');
            $table->string('employer');
            $table->string('type_of_business');
            $table->string('business_address');
            $table->string('business_mobile');
            $table->string('business_email');
            $table->boolean('alumni');
            $table->string('class_off');
            $table->string('type');
            $table->string('school');
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
        Schema::drop('parents');
    }
}
