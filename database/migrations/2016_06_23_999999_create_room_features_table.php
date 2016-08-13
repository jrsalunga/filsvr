<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_features', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("room_type_id")->unsigned();
            $table->integer("feature_id")->unsigned();
            $table->string("name",255);
             $table->foreign('room_type_id')
            ->references('id')->on('room_type')
            ->onDelete('cascade');
             $table->foreign('feature_id')
            ->references('id')->on('features')
            ->onDelete('cascade');

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
        Schema::drop('room_features');
    }
}
