<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToGroupsTable extends Migration
{
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->unsignedInteger('unit_id');
            $table->foreign('unit_id', 'unit_fk_2342026')->references('id')->on('units');
            $table->unsignedInteger('head_id')->nullable();
            $table->foreign('head_id', 'head_fk_2342032')->references('id')->on('users');
            $table->unsignedInteger('parent_id')->nullable();
            $table->foreign('parent_id', 'parent_fk_2343743')->references('id')->on('groups');
        });
    }
}
