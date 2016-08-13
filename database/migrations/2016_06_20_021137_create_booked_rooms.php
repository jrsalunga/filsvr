<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookedRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('booked_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("booking_id")->unsigned();
           // $table->foreign('booking_id')->references('id')->on('booking');   
            $table->string("room_no");
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
        Schema::drop('booked_rooms');
    }
}
