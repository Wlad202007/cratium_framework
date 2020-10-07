<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToActivitiesTable extends Migration
{
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->unsignedInteger('course_id')->nullable();
            $table->foreign('course_id', 'course_fk_2340981')->references('id')->on('courses');
            $table->unsignedInteger('moderator_id');
            $table->foreign('moderator_id', 'moderator_fk_2340983')->references('id')->on('users');
        });
    }
}
