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

        $files=$request->file('image_path');
        foreach($files as $file){
            $filename = now()->format('YmdHis') . uniqid('', true) . "." . $file->extension();
            $image_path = $file->storeAs('uploaded/', $filename, 'public');
            $images->image_path = $image_path;
            $images->user_id = Auth::id();
            $images->save();
        }
        // $images->image_path = $imagesArray;
        // $images->user_id = Auth::id();

        return response()->json([
            // 'files'=>$files,
            // 'message'=>'image saved successfully'
            // 'image_path'=>$imagesArray,
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
    public function update(Request $request, Images $images,$id)
    {
        $images = $images->where('user_id',$id)->first();
        $files = $request->file('image_path');
        // foreach($files as $file){
        //     $filename = now()->format('YmdHis') . uniqid('', true) . "." . $file->extension();
        //     $image_path = $file->storeAs('uploaded/', $filename, 'public');
        //     $images->image_path = $image_path;
        // }


        // $images->save();

        return response()->json([
            'images'=>$images,
            'files'=>$files,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Images $images,$id)
    {
        $images = $images->where('user_id',$id)->get();

        if ($images) {

            $images->each(function($image){
                $image->delete();
            });
            return response()->json([
                'message' => 'delete successfully'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'Images not found'
            ], Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'images'=>$images
        ]);
    }
}
