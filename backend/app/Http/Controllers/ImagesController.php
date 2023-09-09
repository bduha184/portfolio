<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImagesRequest;
use App\Http\Requests\UpdateImagesRequest;
use App\Models\Images;
use App\Models\Recruit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Images $images)
    {


        $file = $request->file('image_path');
        $filename = now()->format('YmdHis') . uniqid('', true) . "." . $file->extension();
        $image_path = $file->storeAs('uploaded/', $filename, 'public');
        $images->image_path = $image_path;

        $images->user_id = Auth::id();
        $images->save();

        return response()->json([
            'image_path'=>$images->image_path,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Images $images,$id)
    {
        $user_id = Auth::id();
        if($id != $user_id){
            $recruit  = Recruit::find($id)->first();
            $user_id=$recruit->user_id;
        }
        $get_images = $images->where('user_id',$user_id)->get();

        return response()->json([
            'images'=>$get_images,
            'user_id'=>$user_id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Images $images)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImagesRequest $request, Images $images)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Images $images)
    {
        //
    }
}
