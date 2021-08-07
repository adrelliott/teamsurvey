<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_survey', function (Blueprint $table) {
            $table->id()->from(2021);
            $table->foreignId('participant_id')->constrained();
            $table->foreignId('survey_id')->constrained();
            $table->string('invite_hash')->index();
            $table->integer('current_section_no')->default(0);
            $table->timestamp('invited_at')->nullable();
            $table->timestamp('completed_at')->nullable();
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
        $table->dropForeign(['survey_id']);
        Schema::dropIfExists('participant_survey');
    }
}
