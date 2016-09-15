<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\WebsiteSetting;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index(Request $request)
    {
        $roomtype = \App\RoomType::with('features')->take(2)->get();
        $request->session()->flash('current_page', 'home');
        return view("frontend.index", compact("roomtype"));
    }

    public function contact(Request $request)
    {
        $request->session()->flash('current_page', 'contact');
        $settings = WebsiteSetting::first();
      
        return view("frontend.contact.index", compact("settings"));
    }

    public function about(Request $request)
    {
        $website_settings = WebsiteSetting::first();
        $about = null;
        if(empty($website_settings) || empty($website_settings->about))
        {

            $about = "No about page to display.";
        }else
        {
            $about = $website_settings->about;
        }
        
        $request->session()->flash('current_page', 'about');
        return view("frontend.about.index", compact("about"));
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
        //
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
