<?php

use Illuminate\Database\Seeder;
use App\RoomType;
use Illuminate\Database\Eloquent\Model;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('room_type')->delete();

    	RoomType::create(['name' => 'Superior Rooms',
    		'short_description'=>'Some short description is in here.',
    		'description'=>'This is a loooooooooooooooooooong description.',
    		'max_adult' => "2",
    		'max_children'=> "1",
    		'beds' => "2",
    		'room_area' => "50.00",
    		'breakfast'=> "1",
    		'price' => "500.00"]);
    }
}
