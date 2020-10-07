<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUnitsTable extends Migration
{
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->unsignedInteger('head_id');
            $table->foreign('head_id', 'head_fk_2340906')->references('id')->on('users');
            $table->unsignedInteger('parent_id')->nullable();
            $table->foreign('parent_id', 'parent_fk_2340907')->references('id')->on('units');
        });
    }
}
