<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateUnitPivotTable extends Migration
{
    public function up()
    {
        Schema::create('template_unit', function (Blueprint $table) {
            $table->unsignedInteger('template_id');
            $table->foreign('template_id', 'template_id_fk_2341390')->references('id')->on('templates')->onDelete('cascade');
            $table->unsignedInteger('unit_id');
            $table->foreign('unit_id', 'unit_id_fk_2341390')->references('id')->on('units')->onDelete('cascade');
        });
    }
}
