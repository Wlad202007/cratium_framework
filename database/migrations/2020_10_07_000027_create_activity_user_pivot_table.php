<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('activity_user', function (Blueprint $table) {
            $table->unsignedInteger('activity_id');
            $table->foreign('activity_id', 'activity_id_fk_2340982')->references('id')->on('activities')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_2340982')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
