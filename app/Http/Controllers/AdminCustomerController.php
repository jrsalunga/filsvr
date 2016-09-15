<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests;
use App\Customer;
class AdminCustomerController extends Controller
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

            $promo = Customer::where("firstname", "LIKE", "%$search%")
            ->orWhere("lastname", "LIKE", "%$search%")
            ->orWhere("email", "like", "%$search%")
            ->orWhere("contact_no","like", "%$search%")
            ->orderBy($sort,$order);
            
            $output = array();
            $output['total'] = $promo->count();
            $output['rows'] = $promo->skip($skip)->take($take)->get();
            return $output;
        }

        return view("admin.customer.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.customer.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $input = $request->all();
        try
        {
         $customer = new Customer;
         $customer::create($input);
         return back()->withSuccess("You have successfully created a new customer.");
     }catch(Exception $e)
     {
        return back()->withErrors(['Problem saving into the database. Please try agian later.']);
    }

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
        $customer = Customer::whereId($id)->first();
        if($customer)
            return view("admin.customer.update", compact("customer"));
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
     $input = $request->all();
     $customer = Customer::whereId($id)->first();
     if($customer)
     {
        try{
            $customer->update($input);
            return back()->withSuccess("You have successfully updated this customer");
        }
        catch(Exception $e)
        {
            return back()->withErrors(array("Something went wrong. Please try again."));
        } 
        }
    }

public function searchCustomer(Request $request)
{
    if($request->ajax())
    {
        $keyword = $request->get("keyword", array("term"=>""));
        $keyword = $keyword['term'];
        $customer = Customer::where("firstname", "like", "%$keyword%")
        ->orWhere(\DB::raw("concat_ws(' ',firstname,lastname)"), "like","%$keyword%")
        ->orWhere("lastname", "like", "%keyword%")->get();

        if($customer)
        {

            $output = array();
            foreach($customer as $c)
            {
                $tmp_output = array();
                $tmp_output['text'] = "ID: ".$c->id." | ".ucfirst($c->firstname)." ".ucfirst($c->lastname);
                $tmp_output['id'] = $c->id;   
                array_push($output, $tmp_output);
            }
            $final_output = array();
            $final_output['results'] = $output;
            return $final_output;
        }
    }
    return response("You are not authorized to access this page.", 403);
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
