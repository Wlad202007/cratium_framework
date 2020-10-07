<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->integer('score');
            $table->integer('duration')->nullable();
            $table->datetime('time_start')->nullable();
            $table->datetime('time_end')->nullable();
            $table->integer('test_per_page')->nullable();
            $table->integer('time_per_test')->nullable();
            $table->string('mode');
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
