<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('int_number')->nullable();
            $table->string('ext_number')->nullable();
            $table->string('status');
            $table->string('title');
            $table->longText('body')->nullable();
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
