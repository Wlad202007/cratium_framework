<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('document_user', function (Blueprint $table) {
            $table->unsignedInteger('document_id');
            $table->foreign('document_id', 'document_id_fk_2342115')->references('id')->on('documents')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_2342115')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
