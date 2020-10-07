<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAnswersTable extends Migration
{
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_fk_2342086')->references('id')->on('users');
            $table->unsignedInteger('variant_id');
            $table->foreign('variant_id', 'variant_fk_2342087')->references('id')->on('variants');
        });
    }
}
