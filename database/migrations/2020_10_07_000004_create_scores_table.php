<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
            $table->integer('model')->nullable();
            $table->string('model_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
