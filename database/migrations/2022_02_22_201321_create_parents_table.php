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
            $table->string('first_name_en')->nullable();
            $table->string('middle_name_en')->nullable();
            $table->string('last_name_en')->nullable();
            $table->string('first_name_ar')->nullable();
            $table->string('middle_name_ar')->nullable();
            $table->string('last_name_ar')->nullable();
            $table->integer('marital_status_id');
            $table->string('university')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employer')->nullable();
            $table->string('type_of_business')->nullable();
            $table->string('business_address')->nullable();
            $table->string('business_mobile')->nullable();
            $table->string('business_email')->nullable();
            $table->boolean('alumni')->nullable();
            $table->string('class_off')->nullable();
            $table->string('type')->nullable();
            $table->string('school')->nullable();
            $table->integer('religion_id');
            $table->integer('nationality_id');
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('card_id' )->nullable();
            $table->string('card_id_file')->nullable();
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
