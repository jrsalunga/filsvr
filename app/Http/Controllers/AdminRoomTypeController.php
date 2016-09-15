<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRoomType;
use App\Http\Requests;
use App\RoomType;
use App\MealPlan;
use \Image;
use App\Helpers\BookingIdGenerator;
use App\RoomFeature;

class AdminRoomTypeController extends Controller
{
  public function index()
  {
    $uid = new BookingIdGenerator("B");
    return $uid;
    return redirect("/admin/rooms/");
  }

  public function roomFeatures()
  {
   return view("admin.rooms.features");
 }
 public function store(CreateRoomType $request)
 {
  try
  {  
    $input = $request->all();
    $input['breakfast']=$request->get("breakfast", 0);
    $room_features = $request->get("room_feature", array());
    if($request->hasFile("picture"))
    { 
      $img = Image::make($request->file("picture"));
      $filename = $this->generateFilename();
      $img->save(public_path("asset/hotel-images/".$filename));
      $input['picture'] = $filename;
      
    }else
    {
      $input['picture'] = "";
    }
    
    $roomtype = RoomType::create($input);
    if($roomtype->id)
    {
      return $roomtype;
      foreach($room_features as $rf)
      {
        $roomfeature = new RoomFeature;
        $roomfeature->room_type_id = $room_type->id;
        $roomfeature->feature_id = $rf;
        $roomfeature->save();
      }
    }

    return back()->withSuccess("You have successfully created the room type <strong>".$roomtype->name."</strong>");

  }catch(Exception $e)
  {
    return back()->withErrors(["Problem saving to database, please try again."]);
  }
}

public function bookingFilter()
{

}

public function create(Request $request)
{
 $mealplans = MealPlan::all();
 $room_features = \App\Feature::all();

 return view("admin.rooms.create_room_type", compact("room_features", "mealplans"));
}

public function generateFilename()
{
  return uniqid().".jpg";
}

public function edit($id)
{
  try
  {
    $mealplans = MealPlan::all();
    $room_features = \App\Feature::all();
    $selectedroomtype = RoomType::with("features")->where("slug", $id)->first();
        //return $selectedroomtype;
    if(!$selectedroomtype)
     return back()->withErrors("You are trying to access invalid Room Type.");
   return view("admin.rooms.update_room_type", compact("room_features", "selectedroomtype", "mealplans"));
 }catch(Exception $e)
 {

  return back()->withErrors("You are trying to access invalid Room Type.");
}
}

public function update($id, CreateRoomType $request)
{

  try
  {   
    $input = $request->all();
    
    $input['breakfast']=$request->get("breakfast", 0);
    $room_features = $request->get("room_feature", array());
    /*
    Under maintenance
    if($request->hasFile("picture"))
    { 

      $img = Image::make($request->file("picture"));
      $filename = $this->generateFilename();
      $img->save(public_path("asset/hotel-images/".$filename));
      $input['picture'] = $filename;
      
    }else
    {
      $input['picture'] = "";
    }*/
   // return $input;
    $roomtype = RoomType::with("features")->find($id);
    $roomtype->update($input); 
    if($roomtype->id)
    {
      foreach($roomtype->features as $rtf)
      {
        $rtf->delete();
      }
      foreach($room_features as $rf)
      {
        $roomfeature = new RoomFeature;
        $roomfeature->room_type_id = $roomtype->id;
        $roomfeature->feature_id = $rf;
        $roomfeature->save();
      }
    }
    return back()->withSuccess("You have successfully created the room type <strong>".$roomtype->name."</strong>");
  }catch(Exception $e)
  {
   return back()->withErrors(["Problem saving to database, please try again."]);
 }

}

public function show($slug)
{
  try
  {
    $roomtype = RoomType::all();
    $selectedroomtype = RoomType::where("slug", $slug)->with("rooms")->first();
    if($roomtype)
    {
      return view("admin.rooms.room_type", compact("selectedroomtype","roomtype"));
    }

    return back()->withErrors(["This room type is not available "]);
  }catch(Exception $e)
  {
    return back()->withErrors(["This room type is not available "]);
  }
}

public function patch($id)
{

}

public function delete($id)
{
  $selectedroomtype = RoomType::where("slug", $id)->first();
  if($selectedroomtype)
  {
    return view("admin.rooms.delete.roomtype", compact("selectedroomtype"));
  }
}

public function destroy($id)
{
  try
  {
    $roomtype = RoomType::findOrFail($id);
    $roomtype->destroy($id);
    return redirect("admin/rooms/")->withSuccess("You have successfully deleted a room type.");  
  }catch(Exception $e)
  {
    App::abort(404);
  }
  
}
}
