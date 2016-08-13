<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
class AdminUserController extends Controller
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
        $search = $request->input("search","");

        $user = User::where("firstname", "LIKE", "%$search%")
        ->orWhere("lastname", "LIKE", "%$search%")
        ->orWhere("username", "LIKE", "%$search%")
        ->orWhere("email", "LIKE", "%$search%")
        ->take($take)->skip($skip)
        ->orderBy($sort, $order)
        ->get();

        $output = array();
        $output['total'] = $user->count();
        $output['rows'] = $user;
        return $output;
    }

    return view("admin.user.index");
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.user.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $request->all();
        try
        {
             $user = User::create($input); 
            return back()->withSuccess("You have successfully created a user");
        }catch(Exception $e)
        {
            return back()->withErrors(array("Something went wrong. Please try again."));
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
        try {
            $user = User::findOrFail($id);
            return view("admin.user.update", compact("user"));
        } catch (Exception $e) {
            App::abort(404);
        }


    }


    /*showing currently logged in profile*/
    public function showMyProfile()
    {
     try
     {
        $user = User::findOrFail(\Auth::id());
        return view("admin.user.update", compact("user"));
    }
    catch(Exception $e)
    {
        App::abort(404);
    }
}
/*showing currently logged in user account settings*/
public function showMyAccount()
{
    try
    {
        $user = User::findOrFail(\Auth::id());
        return view("admin.user.update_account", compact("user"));
    }
    catch(Exception $e)
    {
        App::abort(404);
    }
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

    public function updateMyProfile(UserRequest $request)
    {
     try
     {
        $user = User::findOrFail(\Auth::id());
        $user->update($request->all());
        return back()->withSuccess("You have successfully updated your profile.");
    }
    catch(Exception $e)
    {
        App::abort(404);
    }
}


public function update(UserRequest $request, $id)
{
 try
 {
    $user = User::findOrFail(\Auth::id());
    $user->update($request->all());
    return back()->withSuccess("You have successfully updated your profile.");
}
catch(Exception $e)
{
    App::abort(404);
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
