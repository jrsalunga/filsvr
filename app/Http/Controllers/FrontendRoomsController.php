<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoomType;
use App\Http\Requests;
use App\Feature;

class FrontendRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Request $request)
    {
     $request->session()->flash('current_page', 'rooms');
 }
 public function index()
 {
    $websitesettings = \App\WebsiteSetting::first();
    $contact_number = "N/A";
    if($websitesettings)
        $contact_number = ($websitesettings->contact_no !="") ? $websitesettings->contact_no : "N/A";
    $rooms = RoomType::with('features')->get();
    return view("frontend.rooms.index", compact("rooms", "contact_number"));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = RoomType::with("features")->where("slug", $id)->first();
        $features = Feature::all();
        if($room)
        {
            $websitesettings = \App\WebsiteSetting::first();
    $contact_number = "N/A";
    if($websitesettings)
        $contact_number = ($websitesettings->contact_no !="") ? $websitesettings->contact_no : "N/A";

         
           return view("frontend.rooms.show", compact("room", "features", "contact_number")); 
       }
       return abort(404);
       
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
