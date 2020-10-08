<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsTable extends Migration
{
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->date('date');
            $table->string('edition');
            $table->string('database')->nullable();
            $table->string('url')->nullable();
            $table->string('edition_number')->nullable();
            $table->integer('pages_count')->nullable();
            $table->string('location')->nullable();
            $table->string('type');
            $table->longText('coauthors')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
