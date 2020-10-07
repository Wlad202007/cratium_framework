<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseGroupPivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_group', function (Blueprint $table) {
            $table->unsignedInteger('course_id');
            $table->foreign('course_id', 'course_id_fk_2340939')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedInteger('group_id');
            $table->foreign('group_id', 'group_id_fk_2340939')->references('id')->on('groups')->onDelete('cascade');
        });
    }
}
