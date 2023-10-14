<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Team::latest()->get();
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
    public function store(Request $request,Team $team)
    {
        $file_header = $request->file('header_img');
        $filename_header = now()->format('YmdHis') . uniqid('', true) . "." . $file_header->extension();
        $path_header = $file_header->storeAs('uploaded/', $filename_header, 'public');
        $team->header_img_path = $path_header;

        $file_thumbnail = $request->file('thumbnail');
        $filename_thumbnail = now()->format('YmdHis') . uniqid('', true) . "." . $file_thumbnail->extension();
        $path_thumbnail = $file_thumbnail->storeAs('uploaded/', $filename_thumbnail, 'public');
        $team->thumbnail_path = $path_thumbnail;

        $team->team_name = $request->team_name;
        $team->introduction = $request->introduction;
        $team->activities = $request->activities;
        $team->user_id = Auth::id();
        $team->save();

        return response()->json([
            'itemId'=>$team->id,
            'path_header' => $path_header,
            'path_thumbnail' => $path_thumbnail,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(Auth::id() == $id){
            $teamItem = Team::where('user_id',$id)->first();
        }else{
            $teamItem = Team::find($id)->first();

        }

        return response()->json([
            'data'=>$teamItem,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recruit $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        $team  = Team::where('user_id',$id)->first();

        $file_header = $request->file('header_img');
        $filename_header = now()->format('YmdHis') . uniqid('', true) . "." . $file_header->extension();
        $path_header = $file_header->storeAs('uploaded/', $filename_header, 'public');
        $team->header_img_path = $path_header;

        $file_thumbnail = $request->file('thumbnail');
        $filename_thumbnail = now()->format('YmdHis') . uniqid('', true) . "." . $file_thumbnail->extension();
        $path_thumbnail = $file_thumbnail->storeAs('uploaded/', $filename_thumbnail, 'public');
        $team->thumbnail_path = $path_thumbnail;

        $team->introduction = $request->introduction;

        $request->teams = Team::firstOrCreate(['team_name'=>$request->team_name]);


        $team->user_id = Auth::id();
        $team->save();

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
        $team = Team::where('id',$id)->first();

        if ($team) {
            $team->delete();
            return response()->json([
                'message' => 'delete successfully'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'Article not found'
            ], Response::HTTP_NOT_FOUND);
        }

        // return response()->json([
        //     'item'=>$team
        // ]);
    }
}
