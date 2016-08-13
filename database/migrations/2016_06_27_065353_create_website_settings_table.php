<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->text("about");
            $table->string("contact_no");
            $table->text("google_map");
            $table->string("telephone_no");
            $table->string("email");
            $table->text("terms_and_condition");
            $table->text("logo");
            $table->double("tax");
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
        Schema::drop('website_settings');
    }
}
