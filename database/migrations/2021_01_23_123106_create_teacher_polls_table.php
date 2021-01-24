<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherPollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_polls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->unsignedBigInteger('school_visit_id');
            $table->foreign('school_visit_id')->references('id')->on('school_visits');
            $table->tinyInteger('did_happen');
            $table->string('why_failed')->nullable();
            $table->tinyInteger('useful_rate')->nullable();
            $table->text('most_valuable')->nullable();
            $table->tinyInteger('invite_rm_again')->nullable();
            $table->string('why_not_inviting_againt', 500)->nullable();
            $table->text('next_steps')->nullable();
            $table->text('improvement_suggestions')->nullable();
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
        Schema::dropIfExists('teacher_polls');
    }
}
