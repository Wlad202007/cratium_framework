<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount', 15, 2);
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
