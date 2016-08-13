<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\WebsiteSettingsRequest;
use App\WebsiteSetting;

class AdminSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function showTerms()
    {
        $settings = WebsiteSetting::first();
        $termscondition = ($settings) ? $settings->terms_and_condition : "";
        return view("admin.settings.terms_condition", compact("termscondition"));
    }

    public function showTax()
    {
        $settings = WebsiteSetting::first();
        $tax = (empty($settings)) ? "" : $settings->tax;
        
        return view("admin.settings.tax_adjustments", compact("tax"));
        
    }
    // show contact details page
    public function showContact()
    {
        $settings = WebsiteSetting::first();
        if(empty($settings))
        {
            $settings = new WebsiteSetting;
            $settings->google_map = "";
            $settings->contact_no = "";
            $settings->email = "";
        }
        
        return view("admin.settings.contact_details", compact("settings"));
    }
    // show about page
    public function showAbout()
    {
        $settings = WebsiteSetting::first();
        $about = ($settings) ? $settings->about : "";
        return view("admin.settings.about", compact("about"));
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
    public function update(WebsiteSettingsRequest $request, $id)
    {
        try
        {

            $setting = WebsiteSetting::first();
            if(!$setting)
            {
               $setting = new WebsiteSetting;
               $setting->save();
           }
           $setting->update($request->all());
           return back()->withSuccess("You have successfully updated website settings");
       } catch(Exception $e)
       {
        return back()->withErrors(["Problem saving to database. Please try again"]);
    }


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
