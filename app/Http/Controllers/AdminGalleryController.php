<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Gallery;
use App\Http\Requests\GalleryRequest;
use Image;
class AdminGalleryController extends Controller
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
            $gallery = gallery::where("caption", "LIKE", "%$search%")
            ->orderBy($sort, $order);
            $output = array();
            $output['total'] = $gallery->count();
            $output['rows'] = $gallery ->take($take)->skip($skip)->get();
            return $output;
        }

        return view("admin.gallery.index");
    }

    /**
     * Show the form for creating a new resource.
     * This will display the create/upload form for the gallery
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view("admin.gallery.add_photo");
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {

        $img = Image::make($request->file("file"));
        $filename = $this->generateFilename();
        try {
           $img->save(public_path("gallery-images/".$filename));
           $gallery = new Gallery;
           $gallery->image = $filename;
           $gallery->save();

       } catch (Exception $e) {

       }


   }

   public function generateFilename()
   {
    return uniqid().".jpg";
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
        try {
             $gallery = Gallery::findOrFail($id);
             $gallery->update($request->all());
        } catch (Exception $e) {
            App::abort(404);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
       
       if($request->has("selected"))
        Gallery::destroy($request->get("selected"));
    else
        Gallery::destroy($id);
    }
}
