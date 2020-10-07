<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->longText('explanation')->nullable();
            $table->float('score', 6, 1)->nullable();
            $table->string('status');
            $table->string('type');
            $table->string('priority');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
