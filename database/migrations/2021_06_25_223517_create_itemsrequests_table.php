<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsrequestsTable extends Migration
{
    public function up()
    {
        Schema::create('itemsrequests', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 100);
            $table->string('amount', 50);
            $table->unsignedBigInteger('request_id');
            $table->foreign('request_id')->references('id')->on('request_orders')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('itemsrequests');
    }
}
