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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('sellers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('property_type');
            // $table->boolean('is_available')->default(true);
            $table->string('rent_for');
            $table->integer('total_room');
            $table->integer('available_room');
            $table->integer('room_length');
            $table->integer('room_width');
            $table->text('address');
            $table->text('link_location');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->integer('price');
            $table->float('rating');
            $table->integer('total_reviewer');
            $table->string('photo_1');
            $table->string('photo_2');
            $table->string('photo_3');
            $table->string('photo_4');
            $table->string('photo_5');
            $table->text('description');
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
        Schema::dropIfExists('properties');
    }
};