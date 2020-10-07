<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedInteger('author_id');
            $table->foreign('author_id', 'author_fk_2341068')->references('id')->on('users');
            $table->unsignedInteger('document_id')->nullable();
            $table->foreign('document_id', 'document_fk_2341069')->references('id')->on('documents');
        });
    }
}
