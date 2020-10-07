<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolderGroupPivotTable extends Migration
{
    public function up()
    {
        Schema::create('folder_group', function (Blueprint $table) {
            $table->unsignedInteger('folder_id');
            $table->foreign('folder_id', 'folder_id_fk_2341363')->references('id')->on('folders')->onDelete('cascade');
            $table->unsignedInteger('group_id');
            $table->foreign('group_id', 'group_id_fk_2341363')->references('id')->on('groups')->onDelete('cascade');
        });
    }
}
