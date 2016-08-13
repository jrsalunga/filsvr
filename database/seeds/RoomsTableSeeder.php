<?php

use Illuminate\Database\Seeder;
use App\Room;
use App\RoomType;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
    	DB::table('room_type')->delete();
    	$room_type = RoomType::first();

    	if($room_type)
    	{
    		Room::create(['view' => 'Sea Side',
    			'room_no'=>'100',
    			'status'=>'vacant',
    			'room_type_id' => $room_type->id
    			]);
    	}
    }  
}
