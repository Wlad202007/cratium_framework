<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentFolderPivotTable extends Migration
{
    public function up()
    {
        Schema::create('document_folder', function (Blueprint $table) {
            $table->unsignedInteger('document_id');
            $table->foreign('document_id', 'document_id_fk_2342116')->references('id')->on('documents')->onDelete('cascade');
            $table->unsignedInteger('folder_id');
            $table->foreign('folder_id', 'folder_id_fk_2342116')->references('id')->on('folders')->onDelete('cascade');
        });
    }
}
