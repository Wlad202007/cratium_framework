<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToScoresTable extends Migration
{
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->unsignedInteger('author_id');
            $table->foreign('author_id', 'author_fk_2341428')->references('id')->on('users');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_fk_2341429')->references('id')->on('users');
        });
    }
}
