<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("short_description");
            $table->text("description");
            $table->text("picture");
            $table->string("slug",255);
            $table->integer("max_adult");
            $table->integer("max_children");
            $table->integer("beds");
            $table->double("room_area");
            $table->boolean("breakfast");
            $table->double("price");
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
        Schema::drop('room_type');
    }
}
