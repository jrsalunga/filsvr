<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsRoomtypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_type', function (Blueprint $table) {
            $table->double("monday_price");
            $table->double("tuesday_price");
            $table->double("wednesday_price");
            $table->double("thursday_price");
            $table->double("friday_price");
            $table->double("saturday_price");
            $table->double("sunday_price");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_type', function (Blueprint $table) {
            //
        });
    }
}
