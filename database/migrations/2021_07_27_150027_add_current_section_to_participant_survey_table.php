<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentSectionToParticipantSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participant_survey', function (Blueprint $table) {
            // $table->unsignedBigInteger('current_section_id')->after('invite_hash')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participant_survey', function (Blueprint $table) {
            $table->drop(['current_section_id']);
        });
    }
}
