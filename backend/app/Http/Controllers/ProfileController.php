<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecruitRequest;
use App\Http\Requests\UpdateRecruitRequest;
use App\Models\Profile;
use App\Models\Team;
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
        $profiles = Profile::latest()->get();
        if($profiles){
            return response()->json([
                'profiles'=>$profiles,
            ]);
        }

        return response()->json([
            'message' => 'Profiles not found'
        ], Response::HTTP_NOT_FOUND);
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
    public function store(Request $request, Profile $profile)
    {
        if($request){
            $file_header = $request->file('header_img');
            if($file_header) {
                $filename_header = now()->format('YmdHis') . uniqid('', true) . "." . $file_header->extension();
                $path_header = $file_header->storeAs('uploaded/', $filename_header, 'public');
                $profile->header_img_path = $path_header;
            }

            $file_thumbnail = $request->file('thumbnail');
            if($file_thumbnail){
                $filename_thumbnail = now()->format('YmdHis') . uniqid('', true) . "." . $file_thumbnail->extension();
                $path_thumbnail = $file_thumbnail->storeAs('uploaded/', $filename_thumbnail, 'public');
                $profile->thumbnail_path = $path_thumbnail;
            }

            $profile->introduction = $request->introduction;
            $profile->user_id = Auth::id();
            $profile->save();

            return response()->json([
                'path_header' => $path_header,
                'path_thumbnail' => $path_thumbnail,
                'item_id' => $profile->id,
            ]);
        }

        return response()->json([
            'message' => 'Data not found'
        ], Response::HTTP_NOT_FOUND);
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $recruitItem = Profile::where('user_id',$id)->with(['user'])->first();

        return response()->json([
            'data' => $recruitItem,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $auth_id = Auth::id();
        $profile  = Profile::where('user_id', $id)->first();

        if ($profile) {
                if($request->file()){
                    $file_header = $request->file('header_img');
                    $filename_header = now()->format('YmdHis') . uniqid('', true) . "." . $file_header->extension();
                    $path_header = $file_header->storeAs('uploaded/', $filename_header, 'public');
                    $profile->header_img_path = $path_header;

                    $file_thumbnail = $request->file('thumbnail');
                    $filename_thumbnail = now()->format('YmdHis') . uniqid('', true) . "." . $file_thumbnail->extension();
                    $path_thumbnail = $file_thumbnail->storeAs('uploaded/', $filename_thumbnail, 'public');
                    $profile->thumbnail_path = $path_thumbnail;
                }

                if($request->introduction){
                    $profile->introduction = $request->introduction;
                }

                $profile->request_flg = $request->request_flg;
                $profile->save();

                if($id != $auth_id) {
                    $teams = Team::where('user_id',$auth_id)->first();
                    $profile->teams()->attach($teams->id);
                }

                return response()->json([
                    'message' => 'register successfully'
                ], Response::HTTP_OK);

            }
            return response()->json([
                'message' => 'Profile not found'
            ], Response::HTTP_NOT_FOUND);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profile = Profile::find($id);

        if ($profile) {
            $profile->delete();
            return response()->json([
                'message' => 'delete successfully'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'Profile not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
