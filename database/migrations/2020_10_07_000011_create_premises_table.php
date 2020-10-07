<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremisesTable extends Migration
{
    public function up()
    {
        Schema::create('premises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('address')->nullable();
            $table->integer('capacity')->nullable();
            $table->longText('gps')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
