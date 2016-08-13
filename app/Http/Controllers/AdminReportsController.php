<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Laravel\LavachartsFacade as Lava;
use App\Http\Requests;
use App\Booking;
use DB;
use \Carbon;
use App\RoomType;
class AdminReportsController extends Controller
{
	public function index(Request $request)
	{
		$lava = new \Khill\Lavacharts\Lavacharts;
    	$stocksTable = $lava->DataTable();  // Lava::DataTable() if using Laravel
    	$roomTypeTable = $lava->DataTable();  // Lava::DataTable() if using Laravel
    	$year = $request->get("year", date("Y"));
    	$month = $request->get("month", date("m"));
    	$query_scope= $request->get("scope", "monthly");
    	$dt = Carbon::parse("$year-$month");
    	$daysInMonth = $dt->daysInMonth;
    	$roomtype = RoomType::all();

    	$stocksTable->addDateColumn('Successfull Bookings Made '.date("F", $month))
    	->addNumberColumn('Walk In')
    	->addNumberColumn('Online');

    	$roomTypeTable->addDateColumn('Bookings according to room type'.date("F", $month));
    	foreach($roomtype as $key=>$rt)
    	{
    		$roomTypeTable->addNumberColumn($rt->name);
    		
    	}
    	

    	if($query_scope == "monthly")
    	{
    		$booking = Booking::with("rooms")->whereRaw(DB::raw("month(created_at)=$month and year(created_at)=$year"))->get();
    		$tmpdt = $dt;
    		$counter=0;
    		$tmproomtype_names = array();
    		$tmproomtype_data = array();
    		foreach($roomtype as $rt)
    		{
    			array_push($tmproomtype_data, 0);
    			array_push($tmproomtype_names, $rt->name);
    		}

    		while($counter<=$tmpdt->daysInMonth)
    		{

    			foreach($tmproomtype_data as $key=>$rtd)
    			{
    				$tmproomtype_data[$key]=0;
    			}
    			$countBookingA = 0;
    			$countBookingB = 0;
    			foreach($booking as $b)
    			{

    				$currentdate = Carbon::parse(date("Y-m-d",strtotime($b->created_at)));
    				if($currentdate->eq($tmpdt))
    				{
    					foreach($b->rooms as $rooms1)
    					{

    						foreach($roomtype as $key=>$rt1)
    						{
    						//return $rt1->id.' '.$rooms1->room_type_id;
    							if($rt1->id==$rooms1->room_type_id)
    							{

    								$tmproomtype_data[$key]++;
    							}
    						}
    					}

    					if($b->booking_type=="walk-in")
    					{

    						$countBookingA++;
    					}else if($b->booking_type=="online")
    					{
    						$countBookinB++;
    					}
    				}
    			}
    			$tmpdt->addDay();
    			$counter++;

    			$rowData = [
    			$tmpdt->toDateString(), $countBookingA, $countBookingB
    			];

    			$rowData2 = [
    			$tmpdt->toDateString()
    			];

    			foreach($tmproomtype_data as $key=>$tmpdata)
    			{
    				array_push($rowData2, $tmpdata);
    			}


    			$stocksTable->addRow($rowData);
    			$roomTypeTable->addRow($rowData2);
    		}
    		$chart = $lava->LineChart('MyStocks', $stocksTable)
    		->setOptions(array(
    			'title'     => 'Number of successful bookings made on '.$year.' '.date("F", strtotime($year."-".$month))
    			));

    		$chart2 = $lava->LineChart('RoomType', $roomTypeTable)
    		->setOptions(array(
    			'title'     => 'Bookings according to room type on '.$year.' '.date("F", strtotime($year."-".$month))
    			));


    	}else if($query_scope == "range")
    	{
    		
    		
    		$tmproomtype_names = array();
    		$tmproomtype_data1 = array();
    		foreach($roomtype as $rt)
    		{
    			array_push($tmproomtype_data1, 0);
    			array_push($tmproomtype_names, $rt->name);
    		}

    		$from = Carbon::parse($request->get("from"));
    		$to = Carbon::parse($request->get("to"));
    		$booking = Booking::with("rooms")->where(function($query) use($from, $to)
    		{
    			$query->whereBetween('created_at', array($from->toDateString(), $to->toDateString()))
    			->orWhereBetween('created_at', array($from->toDateString(), $to->toDateString()))
    			->orWhereRaw('"'.$from->toDateString().'" between created_at and created_at')
    			->orWhereRaw('"'.$to->toDateString().'" between created_at and created_at');
    		})->get();

    		$diffInDays = $to->diffInDays($from);
    		$tmpdt = $from;
    		$counter = 0;
    		while($counter <= $diffInDays)
    		{
    			$countBookingA = 0;
    			$countBookingB = 0;

    			foreach($tmproomtype_data1 as $key=>$rtd)
    			{
    				$tmproomtype_data[$key]=0;
    			}

    			foreach($booking as $b)
    			{
    			
    				$currentdate = Carbon::parse(date("Y-m-d",strtotime($b->created_at)));
    				if($currentdate->eq($tmpdt))
    				{

    					foreach($b->rooms as $rooms1)
    					{

    						foreach($roomtype as $key=>$rt1)
    						{

    							if($rt1->id==$rooms1->room_type_id)
    							{

    								$tmproomtype_data1[$key]++;
    							}

    						}

    					}


    					
    					if($b->booking_type=="walk-in")
    					{
    						$countBookingA++;
    					}else if($b->booking_type=="online")
    					{
    						$countBookingB++;
    					}

    				}


    			}

    		

    			$rowData = [
    			$tmpdt->toDateString(), $countBookingA, $countBookingB
    			];

    			$rowData2 = [
    			$tmpdt->toDateString()
    			];
    			foreach($tmproomtype_data1 as $tmpdata)
    			{
    				array_push($rowData2, $tmpdata);
    			}
    		
    			$stocksTable->addRow($rowData);
    			//$roomTypeTable->addRow($rowData2);
    			$tmpdt->addDay();
    			$counter++;
    		}
    		$chart = $lava->LineChart('MyStocks', $stocksTable)
    		->setOptions(array(
    			'title'     => 'Number of successful bookings made from '.$from->toDateString().' to '.$to->toDateString()
    			));

    		$chart2 = $lava->LineChart('RoomType', $roomTypeTable)
    		->setOptions(array(
    			'title'     => 'Bookings according to room type from '.$from->toDateString().' to '.$to->toDateString()
    			));
    	}

    	return view("admin.reports.index", compact('lava'));
    }
}
