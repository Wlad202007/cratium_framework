<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPublicationsTable extends Migration
{
    public function up()
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->unsignedInteger('author_id');
            $table->foreign('author_id', 'author_fk_2349071')->references('id')->on('users');
        });
    }
}
