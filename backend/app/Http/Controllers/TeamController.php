<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Tag;
use App\Models\Profile;
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

        $teams = Team::latest()->get();

        if ($teams) {
            return response()->json([
                'teams' => $teams,
            ]);
        }

        return response()->json([
            'message' => 'Teams not found'
        ], Response::HTTP_NOT_FOUND);
    }

    public function select_team()
    {
        $auth_id = Auth::id();
        $auth_profile = Profile::where('user_id', $auth_id)->first();

        if ($auth_profile) {
            $affiliations = $auth_profile->teams()->get();
            return response()->json([
                'affiliations' => $affiliations
            ]);
        }


        return response()->json([
            'message' => 'Teams not found'
        ], Response::HTTP_NOT_FOUND);
    }

    /**˝
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Team $team)
    {
        $file_header = $request->file('header_img');
        $filename_header = now()->format('YmdHis') . uniqid('', true) . "." . $file_header->extension();
        $path_header = $file_header->storeAs('uploaded/', $filename_header, 'public');
        $team->header_img_path = $path_header;

        $file_thumbnail = $request->file('thumbnail');
        $filename_thumbnail = now()->format('YmdHis') . uniqid('', true) . "." . $file_thumbnail->extension();
        $path_thumbnail = $file_thumbnail->storeAs('uploaded/', $filename_thumbnail, 'public');
        $team->thumbnail_path = $path_thumbnail;

        $team->fill($request->all());
        $team->user_id = Auth::id();
        $team->save();


        collect($request->tags)->each(function ($tagName) use ($team) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $team->tags()->attach($tag);
        });

        return response()->json([
            'itemId' => $team->id,
            'path_header' => $path_header,
            'path_thumbnail' => $path_thumbnail,
        ]);

        // return response()->json([
        //     'tags'=>$request->tags
        // ]);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Auth::id() == $id) {
            $teamItem = Team::where('user_id', $id)->first();
        } else {
            $teamItem = Team::find($id)->first();
        }
        $members = $teamItem->profiles()->get();
        $tags = $teamItem->tags()->get();

        return response()->json([
            'teamItem' => $teamItem,
            'members' => $members,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $team  = Team::where('user_id', $id)->first();

        $file_header = $request->file('header_img');
        $filename_header = now()->format('YmdHis') . uniqid('', true) . "." . $file_header->extension();
        $path_header = $file_header->storeAs('uploaded/', $filename_header, 'public');
        $team->header_img_path = $path_header;

        $file_thumbnail = $request->file('thumbnail');
        $filename_thumbnail = now()->format('YmdHis') . uniqid('', true) . "." . $file_thumbnail->extension();
        $path_thumbnail = $file_thumbnail->storeAs('uploaded/', $filename_thumbnail, 'public');
        $team->thumbnail_path = $path_thumbnail;

        $team->fill($request->all());
        $team->user_id = Auth::id();
        $team->save();

        collect($request->tag)->each(function ($tagName) use ($team) {
            $tag = Tag::updateOrCreate(['name' => $tagName]);
            $team->tags()->attach($tag);
        });


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
        $team = Team::where('id', $id)->first();

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
