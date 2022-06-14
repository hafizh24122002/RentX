<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('sellers')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('buyer_id')->constrained('buyers')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('property_id')->constrained('properties')->onUpdate('cascade')->onDelete('restrict');
            $table->date('date_order');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('duration');
            $table->integer('total_payment');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
