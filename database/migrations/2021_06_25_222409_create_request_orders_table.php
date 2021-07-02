<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('request_orders', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('created_by', 100);
            $table->string('status', 50);
            $table->string('observations', 250);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('request_orders');
    }
}
