<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSchoolVisitsAddPolls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_visits', function (Blueprint $table) {
            $table->unsignedBigInteger('role_model_poll_id')->after('online_session_url');
            $table->foreign('role_model_poll_id')->references('id')->on('role_model_polls');
            $table->unsignedBigInteger('teacher_poll_id')->after('online_session_url');
            $table->foreign('teacher_poll_id')->references('id')->on('teacher_polls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_visits', function (Blueprint $table) {
            $table->dropForeign(['teacher_poll_id']);
            $table->dropColumn('teacher_poll_id');
            $table->dropForeign(['role_model_poll_id']);
            $table->dropColumn('role_model_poll_id');
        });
    }
}
