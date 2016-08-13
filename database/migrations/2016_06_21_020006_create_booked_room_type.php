<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookedRoomType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /* Schema::create('booked_room_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("booking_id")->unsigned(    );
            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->string("room_type_id");
            $table->foreign('room_type_id')->references('id')->on('room_type');
            $table->integer("quantity");
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('booked_room_type');
    }
}
