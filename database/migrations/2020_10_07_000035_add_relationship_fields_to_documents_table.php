<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDocumentsTable extends Migration
{
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->unsignedInteger('unit_id');
            $table->foreign('unit_id', 'unit_fk_2342106')->references('id')->on('units');
            $table->unsignedInteger('author_id');
            $table->foreign('author_id', 'author_fk_2342107')->references('id')->on('users');
        });
    }
}
