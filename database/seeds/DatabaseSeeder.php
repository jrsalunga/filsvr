<?php
use database\seeds\RoomTypeTableSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call('UsersTableSeeder');
    	$this->call('RoomTypeTableSeeder');
    	$this->call('RoomsTableSeeder');

    	$this->command->info('User table seeded!');

        // $this->call(UsersTableSeeder::class);
    }
}
