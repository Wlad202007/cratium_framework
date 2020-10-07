<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVariantsTable extends Migration
{
    public function up()
    {
        Schema::table('variants', function (Blueprint $table) {
            $table->unsignedInteger('question_id')->nullable();
            $table->foreign('question_id', 'question_fk_2342081')->references('id')->on('questions');
        });
    }
}
