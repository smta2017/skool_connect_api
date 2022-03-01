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
            $table->datetime('exam_date');
            $table->integer('exam_building_id');
            $table->datetime('exam_date2');
            $table->integer('exam_building2_id');
            $table->datetime('meeting_date');
            $table->integer('meeting_building_id');
            $table->text('reg_notes');
            $table->enum('entrance_ability',['A1','A2']);
            $table->enum('entrance_recommendation',['R1','R2']);
            $table->text('observation_comment');
            $table->text('principal_note');
            $table->enum('principal_recommendation',['Yes','Yes With Condition','Re-assess','No','More Info Needed']);
            $table->enum('principal_ability',['Low','Medium','High']);
            $table->text('director_comment');
            $table->string('application_status');
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
