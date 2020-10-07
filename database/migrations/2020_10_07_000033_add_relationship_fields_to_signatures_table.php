<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSignaturesTable extends Migration
{
    public function up()
    {
        Schema::table('signatures', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_fk_2341377')->references('id')->on('users');
            $table->unsignedInteger('document_id');
            $table->foreign('document_id', 'document_fk_2341378')->references('id')->on('documents');
        });
    }
}
