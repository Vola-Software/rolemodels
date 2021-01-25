<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleModelPollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_model_polls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('professional_id')->nullable();
            $table->foreign('professional_id')->references('id')->on('professionals');
            $table->unsignedBigInteger('school_visit_id');
            $table->foreign('school_visit_id')->references('id')->on('school_visits');
            $table->tinyInteger('did_happen');
            $table->string('why_failed')->nullable();
            $table->tinyInteger('satisfaction_rate')->nullable();
            $table->text('most_valuable')->nullable();
            $table->text('improvement_suggestions')->nullable();
            $table->tinyInteger('rolemodel_again')->nullable();
            $table->tinyInteger('other_tfb_initiatives')->nullable();            
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
        Schema::dropIfExists('role_model_polls');
    }
}
