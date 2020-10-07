<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBillsTable extends Migration
{
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_2349624')->references('id')->on('users');
            $table->unsignedInteger('author_id');
            $table->foreign('author_id', 'author_fk_2349627')->references('id')->on('users');
            $table->unsignedInteger('unit_id');
            $table->foreign('unit_id', 'unit_fk_2349633')->references('id')->on('units');
        });
    }
}
