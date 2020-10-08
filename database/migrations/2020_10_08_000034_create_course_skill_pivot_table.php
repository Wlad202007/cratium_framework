<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSkillPivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_skill', function (Blueprint $table) {
            $table->unsignedInteger('skill_id');
            $table->foreign('skill_id', 'skill_id_fk_2350179')->references('id')->on('skills')->onDelete('cascade');
            $table->unsignedInteger('course_id');
            $table->foreign('course_id', 'course_id_fk_2350179')->references('id')->on('courses')->onDelete('cascade');
        });
    }
}
