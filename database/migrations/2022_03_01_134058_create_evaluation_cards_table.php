<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationCardsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_cards', function (Blueprint $table) {
            $table->id('id');
            $table->datetime('exam_date')->nullable();
            $table->integer('exam_building_id')->nullable();
            $table->datetime('exam_date2')->nullable();
            $table->integer('exam_building2_id')->nullable();
            $table->datetime('meeting_date')->nullable();
            $table->integer('meeting_building_id')->nullable();
            $table->text('reg_notes')->nullable();
            $table->enum('entrance_ability',['A1','A2'])->nullable();
            $table->enum('entrance_recommendation',['R1','R2'])->nullable();
            $table->text('observation_comment')->nullable();
            $table->text('principal_note')->nullable();
            $table->enum('principal_recommendation',['Yes','Yes With Condition','Re-assess','No','More Info Needed'])->nullable();
            $table->enum('principal_ability',['Low','Medium','High'])->nullable();
            $table->text('director_comment')->nullable();
            $table->enum('application_status',['Waiting List','Accepted','Rejected'])->nullable();
            $table->integer('admission_id');
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
        Schema::drop('evaluation_cards');
    }
}
