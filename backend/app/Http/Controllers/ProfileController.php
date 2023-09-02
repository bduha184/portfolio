<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecruitRequest;
use App\Http\Requests\UpdateRecruitRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Profile::latest()->get();
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
    public function store(Request $request,Profile $profile)
    {
        $file_header = $request->file('header_img');
        $filename_header = now()->format('YmdHis') . uniqid('', true) . "." . $file_header->extension();
        $path_header = $file_header->storeAs('uploaded/', $filename_header, 'public');
        $profile->header_img_path = $path_header;

        $file_thumbnail = $request->file('thumbnail');
        $filename_thumbnail = now()->format('YmdHis') . uniqid('', true) . "." . $file_thumbnail->extension();
        $path_thumbnail = $file_thumbnail->storeAs('uploaded/', $filename_thumbnail, 'public');
        $profile->thumbnail_path = $path_thumbnail;

        $profile->title = $request->title;
        $profile->text = $request->text;
        $profile->user_id = Auth::id();
        $profile->save();

        return response()->json([
            'itemId'=>$profile->id,
            'path_header' => $path_header,
            'path_thumbnail' => $path_thumbnail,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $recruitItem = Profile::where('id',$id)->first();

        return response()->json([
            'data'=>$recruitItem,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        $profile  = Profile::find($id)->first();

        $file_header = $request->file('header_img');
        $filename_header = now()->format('YmdHis') . uniqid('', true) . "." . $file_header->extension();
        $path_header = $file_header->storeAs('uploaded/', $filename_header, 'public');
        $profile->header_img_path = $path_header;

        $file_thumbnail = $request->file('thumbnail');
        $filename_thumbnail = now()->format('YmdHis') . uniqid('', true) . "." . $file_thumbnail->extension();
        $path_thumbnail = $file_thumbnail->storeAs('uploaded/', $filename_thumbnail, 'public');
        $profile->thumbnail_path = $path_thumbnail;

        $profile->text = $request->text;
        $profile->user_id = Auth::id();
        $profile->save();

        return response()->json([
            'path_header' => $path_header,
            'path_thumbnail' => $path_thumbnail,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profile = Profile::find($id)->first();

        if ($profile) {
            $profile->delete();
            return response()->json([
                'message' => 'update successfully'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'Article not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
