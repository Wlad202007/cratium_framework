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
            $table->foreign('head_id', 'head_fk_2342012')->references('id')->on('users');
        });
    }
}
