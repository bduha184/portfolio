<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Ride;
use App\Models\Area;
use App\Models\Day;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,Team $team,Area $area)
    {

        $page = $request->page;
        $keywords = $request->keywords;
        $tab = $request->tab;
        $target = 'updated_at';
        if ($tab == 'member') $target = 'profiles_count';
        $tables = ['areas','days','rides'];

        if (!empty($keywords)) {
            $teams =  Team::whereHas('areas', function ($query) use ($keywords) {
                $query->where(function($q) use ($keywords){
                    foreach($keywords as $keyword){
                        $q->orWhere('name','like','%'.$keyword.'%');
                    }
                });
            })->whereHas('days', function ($query) use ($keywords) {
                $query->where(function($q) use ($keywords){
                    foreach($keywords as $keyword){
                        $q->orWhere('name','like','%'.$keyword.'%');
                    }
                });
            })->whereHas('rides', function ($query) use ($keywords) {
                $query->where(function($q) use ($keywords){
                    foreach($keywords as $keyword){
                        $q->orWhere('name','like','%'.$keyword.'%');
                    }
                });
            })
            ->orWhere(function ($query) use ($keywords) {
                    foreach($keywords as $keyword){
                        $query->orWhere('team_name','like','%'.$keyword.'%');
                    }
            })
            // $teams = Team::where(function ($query) use ($keywords,$tables) {
            //         foreach($tables as $table){
            //             $query
            //             ->whereHas($table, function ($tableQuery) use ($keywords) {
            //                 $tableQuery->where(function ($tableNameQuery) use ($keywords) {
            //                     foreach ($keywords as $keyword) {
            //                         $tableNameQuery->orWhere('name', 'like', '%' . $keyword . '%');
            //                     }
            //                 });
            //             });
            //         }
            //     })
                ->withCount('profiles')
                ->with(['rides', 'areas', 'days',  'user' => function ($query) {
                    $query->with('profile')->get();
                }])
                ->offset($page * 10)
                ->limit(10)
                ->orderBy($target, 'desc')
                ->get();

            if ($teams) {
                return response()->json([
                    'tab' => $tab,
                    'keywords' => $keywords,
                    'teams' => $teams,
                ]);
            }
            return response()->json([
                'message' => 'Teams not found'
            ], Response::HTTP_NOT_FOUND);
        } else {
            $teams = Team::withCount('profiles')
                ->with([
                    'rides', 'areas', 'days', 'user' => function ($query) {
                        $query->with('profile')->get();
                    }
                ])
                ->orderBy($target, 'desc')
                ->offset($page * 10)
                ->limit(10)
                ->get();

            if ($teams) {
                return response()->json([
                    'target' => $target,
                    'tab' => $tab,
                    'teams' => $teams,
                ]);
            }
            return response()->json([
                'message' => 'Teams not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function get_my_team()
    {
        $auth_id = Auth::id();
        $user = User::find($auth_id);

        if ($user) {
            $user_team = $user->teams()
                ->with(['rides', 'areas', 'days', 'profiles'=> function ($query) {
                    $query->with('user')->get();
                }])
                ->withCount('profiles')
                ->first();
            return response()->json([
                'team_info' => $user_team,
            ]);
        }

        return response()->json([
            'message' => 'Team not found'
        ], Response::HTTP_NOT_FOUND);
    }

    public function select_team()
    {
        $auth_id = Auth::id();
        $auth_profile = Profile::where('user_id', $auth_id)->first();

        if ($auth_profile) {
            $teams = $auth_profile->teams()
                ->withCount('profiles')
                ->with(['rides', 'areas', 'days', 'profiles', 'user' => function ($query) {
                    $query->with('profile')->get();
                }])
                ->get();
            $affiliations = $teams->filter(fn ($team) => $team->user_id != $auth_id);
            return response()->json([
                'profile' => $auth_profile,
                'affiliations' => $affiliations
            ]);
        }

        return response()->json([
            'message' => 'Teams not found'
        ], Response::HTTP_NOT_FOUND);
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

        collect($request->rides)->each(function ($rideName) use ($team) {
            $team->rides()->firstOrCreate(['name' => $rideName]);
        });

        collect($request->areas)->each(function ($areaName) use ($team) {
            $team->areas()->firstOrCreate(['name' => $areaName]);
        });

        collect($request->days)->each(function ($dayName) use ($team) {
            $team->days()->firstOrCreate(['name' => $dayName]);
        });

        return response()->json([
            'itemId' => $team->id,
            'path_header' => $path_header,
            'path_thumbnail' => $path_thumbnail,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $user_id = Team::find($id)->user_id;

        $teamInfo = Team::withCount('profiles')
            ->with([
                'rides:name',
                'areas:name',
                'days:name',
                'profiles' => function ($q) use ($user_id) {
                    $q->where('user_id', $user_id)->first();
                }
            ])
            ->find($id);

        if (Auth::id() == $id) {
            $teamInfo = Team::where('user_id', $id)
                ->withCount('profiles')
                ->with([
                    'rides:name',
                    'areas:name',
                    'days:name',
                    'profiles' => function ($q) use ($id) {
                        $q->where('user_id', $id)->first();
                    }
                ])->first();
        }

        return response()->json([
            'teamInfo' => $teamInfo,
            // 'team'=>$team
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $team  = Team::where('user_id', $id)->first();

        if ($team) {

            $file_header = $request->file('header_img');
            if ($file_header) {
                $filename_header = now()->format('YmdHis') . uniqid('', true) . "." . $file_header->extension();
                $path_header = $file_header->storeAs('uploaded/', $filename_header, 'public');
                $team->header_img_path = $path_header;
            }

            $file_thumbnail = $request->file('thumbnail');
            if ($file_thumbnail) {
                $filename_thumbnail = now()->format('YmdHis') . uniqid('', true) . "." . $file_thumbnail->extension();
                $path_thumbnail = $file_thumbnail->storeAs('uploaded/', $filename_thumbnail, 'public');
                $team->thumbnail_path = $path_thumbnail;
            }


            $team->fill($request->all());
            $team->user_id = Auth::id();
            $team->save();

            $team->rides()->delete();
            collect($request->rides)->each(function ($rideName) use ($team) {
                Ride::updateOrCreate(['name' => $rideName, 'team_id' => $team->id]);
            });

            $team->areas()->delete();
            collect($request->areas)->each(function ($areaName) use ($team) {
                Area::updateOrCreate(['name' => $areaName, 'team_id' => $team->id]);
            });

            $team->days()->delete();
            collect($request->days)->each(function ($dayName) use ($team) {
                Day::updateOrCreate(['name' => $dayName, 'team_id' => $team->id]);
            });

            return response()->json([
                'message' => 'updated successfully'
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'Team not found'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $team = Team::find($id);

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
