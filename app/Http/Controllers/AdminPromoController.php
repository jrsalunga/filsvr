<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Promo;
use App\Http\Requests\PromoRequest;
class AdminPromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $order = $request->input("order","desc");
            $sort = $request->input("sort", "created_at");
            $take = $request->input("limit",10);
            $skip = $request->input("offset", 0);
            $search = $request->input("search", "");
            
            $promo = Promo::where("name", "LIKE", "%$search%")
            ->orWhere("description", "LIKE", "%$search%")
            ->orWhere("from", "like", "%$search%")
            ->orWhere("to","like", "%$search%")
            ->orderBy($sort,$order)
            ->skip($skip)->take($take);
            $output = array();
            $output['total'] = $promo->count();
            $output['rows'] = $promo->get();
            return $output;
        }
        return view("admin.promo.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.promo.create");
    }

    /**
     * Store a natcasesort(array)ewly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromoRequest $request)
    {
        $input = $request->all();
        $promo = Promo::create($input);
        return back()->withSuccess("You have successfully created a new promo");
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

        $promo = Promo::findOrFail($id);
        return view("admin.promo.update", compact("promo"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PromoRequest $request, $id)
    {
       $input = $request->all();
       $input['status'] = $request->get("status", 0);

       $promo = Promo::findOrFail($id);
       $promo->update($input);
       return back()->withSuccess("You have successfully created a new promo");
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
