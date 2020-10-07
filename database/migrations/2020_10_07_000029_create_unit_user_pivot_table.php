<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('unit_user', function (Blueprint $table) {
            $table->unsignedInteger('unit_id');
            $table->foreign('unit_id', 'unit_id_fk_2342008')->references('id')->on('units')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_2342008')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
