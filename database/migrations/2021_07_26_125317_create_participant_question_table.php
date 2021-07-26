<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_question', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->constrained();
            $table->foreignId('question_id')->constrained();
            $table->string('text_response')->nullable();
            $table->integer('number_response')->nullable();
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
        $table->dropForeign(['participant_id']);
        $table->dropForeign(['question_id']);
        Schema::dropIfExists('participant_question');
    }
}
