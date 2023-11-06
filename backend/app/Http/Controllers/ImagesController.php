<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImagesRequest;
use App\Http\Requests\UpdateImagesRequest;
use App\Models\Images;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $files=$request['images'];
        if(isset($files)){
            foreach($files as $file){
                    $filename = now()->format('YmdHis') . uniqid('', true) . "." . $file->extension();
                    $image_path = $file->storeAs('uploaded/', $filename, 'public');
                    $images = new Images();
                    $images->image_path = $image_path;
                    $images->place = 1;
                    $images->user_id = Auth::id();
                    $images->save();
                };
            return response()->json([
                'message'=>'image saved successfully',
            ]);
        }
        return response()->json([
            'message' => 'upload files not found'
        ], Response::HTTP_NOT_FOUND);
    }


    /**
     * Display the specified resource.
     */
    public function show(Images $images,$id)
    {


        if(Auth::id() == $id){
            $get_images = $images->where('user_id',$id)->get();
        }else{
            $team = Team::find($id);
            $user_id = $team->user_id;
            $get_images = $images->where('user_id',$user_id)->get();

        }

        if($get_images ){
            $image_paths=[];
           foreach($get_images as $image){
                array_push($image_paths,$image->image_path);
           }

            return response()->json([
                'images'=>$image_paths,
            ]);
        }else {
        return response()->json([
            'message' => 'Images not found'
        ], Response::HTTP_NOT_FOUND);
    }
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
        $images = $images->where('user_id',$id)->get();
        foreach($images as $image){
            $image->delete();
        }
        $files = $request['images'];

        if(isset($files)){
            foreach($files as $file){
                    $filename = now()->format('YmdHis') . uniqid('', true) . "." . $file->extension();
                    $image_path = $file->storeAs('uploaded/', $filename, 'public');
                    $images = new Images();
                    $images->image_path = $image_path;
                    $images->place = 1;
                    $images->user_id = Auth::id();
                    $images->save();
                };
            return response()->json([
                'message'=>'image saved successfully',
            ]);
        }
        return response()->json([
            'message' => 'upload files not found'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Images $images,$id)
    {
        $image_info = $images->where('user_id',$id)->first();
        $image_paths = unserialize($image_info->image_path);

        if ($image_info) {

            foreach($image_paths as $path){
                Storage::disk('public')->delete($path);
            }

            $image_info->delete();
            $images->save();
            return response()->json([
                'message' => 'delete successfully'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'Images not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
