<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPremisesTable extends Migration
{
    public function up()
    {
        Schema::table('premises', function (Blueprint $table) {
            $table->unsignedInteger('unit_id');
            $table->foreign('unit_id', 'unit_fk_2342018')->references('id')->on('units');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2342022')->references('id')->on('teams');
        });
    }
}
