<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
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
    public function store(Request $request,Team $team)
    {
        $team->fill($request->all())->save();

        return response()->json([
            'team'=>$team
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show($name)
    {

        $teams = Team::where('team_name',$name)->first();
        return response()->json([
            'team'=>$teams,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $team->fill($request->all())->save();

        return response()->json([
            'team'=>$team
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
