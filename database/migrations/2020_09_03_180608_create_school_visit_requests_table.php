<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolVisitRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_visit_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('teacher_status', ['преподаващ алум', 'учител първа година', 'учител втора година']);
            $table->string('phone_calls_time', 250)->nullable();
            $table->string('students_details', 1200)->nullable();
            $table->unsignedBigInteger('class_stage_id');
            $table->foreign('class_stage_id')->references('id')->on('class_stages')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('class_major_id')->nullable();
            $table->foreign('class_major_id')->references('id')->on('class_majors')->onUpdate('cascade')->onDelete('cascade');
            $table->string('role_model_profession');
            $table->enum('meeting_type', ['на живо', 'онлайн', 'нямам предпочитания'])->comment('live/online/both');
            $table->string('visit_time', 250);
            $table->enum('potential_participants_count', ['5-10', '11-15', '16-20', 'над 20']);
            $table->string('tech_equipment')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('request_status_id')->default(1);
            $table->foreign('request_status_id')->references('id')->on('request_statuses')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('school_year')->default(2020);
            $table->tinyInteger('term')->default(1);

            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('approved_at')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('school_visit_requests');
    }
}
