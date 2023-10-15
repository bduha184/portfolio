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

        if($files != null){
            foreach($files as $file){
                $filename = now()->format('YmdHis') . uniqid('', true) . "." . $file->extension();
                $image_path = $file->storeAs('uploaded/', $filename, 'public');
                $image_paths[]=$image_path;
            };
            $images->image_path = serialize($image_paths);
            $images->user_id = Auth::id();
            $images->save();
        }

        return response()->json([
            'message'=>'image saved successfully'
            // 'image_path'=>$image_paths,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Images $images,$id)
    {

        if(Auth::id() == $id){
            $get_image_info = $images->where('user_id',$id)->first();
        }else{
            $team = Team::find($id)->first();
            $user_id = $team->user_id;
            $get_image_info = $images->where('user_id',$user_id)->first();

        }

        if($get_image_info ){
            $get_serialize_images = $get_image_info->image_path;
            $get_images = unserialize($get_serialize_images);
            return response()->json([
                'images'=>$get_images,
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
        $images = $images->where('user_id',$id)->first();
        $files = $request['images'];
        // $image_paths=unserialize($images->image_path);
        $exists_image_paths = unserialize($images->image_path);
        $image_paths=[];

        if ($images) {
            foreach($exists_image_paths as $path){
                Storage::disk('public')->delete($path);
            }
            if($files != null){
                foreach($files as $file){
                    if(strpos($file,'uploaded') ===  false){
                        $filename = now()->format('YmdHis') . uniqid('', true) . "." . $file->extension();
                        $image_path = $file->storeAs('uploaded/', $filename, 'public');
                        array_push($image_paths,$image_path);
                    }else{
                        array_push($image_paths,$file);
                    }
                };

                $images->image_path = serialize($image_paths);
                $images->user_id = Auth::id();
                $images->save();
            }
        }

        return response()->json([
            'message'=>'image saved successfully',
            // 'files'=>$files,
        ]);
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
