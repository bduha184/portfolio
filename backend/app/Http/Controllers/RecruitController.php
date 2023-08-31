<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecruitRequest;
use App\Http\Requests\UpdateRecruitRequest;
use App\Models\Recruit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RecruitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Recruit::latest()->get();
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
    public function store(Request $request,Recruit $recruit)
    {
        $file_header = $request->file('header_img');
        $filename_header = now()->format('YmdHis') . uniqid('', true) . "." . $file_header->extension();
        $path_header = $file_header->storeAs('uploaded/', $filename_header, 'public');
        $recruit->header_img_path = $path_header;

        $file_thumbnail = $request->file('thumbnail');
        $filename_thumbnail = now()->format('YmdHis') . uniqid('', true) . "." . $file_thumbnail->extension();
        $path_thumbnail = $file_thumbnail->storeAs('uploaded/', $filename_thumbnail, 'public');
        $recruit->thumbnail_path = $path_thumbnail;

        $recruit->title = $request->title;
        $recruit->text = $request->text;
        $recruit->user_id = Auth::id();
        $recruit->save();

        return response()->json([
            'itemId'=>$recruit->id,
            'path_header' => $path_header,
            'path_thumbnail' => $path_thumbnail,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $recruitItem = Recruit::where('id',$id)->first();

        return response()->json([
            'data'=>$recruitItem,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recruit $recruit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        $recruit  = Recruit::find($id)->first();

        $file_header = $request->file('header_img');
        $filename_header = now()->format('YmdHis') . uniqid('', true) . "." . $file_header->extension();
        $path_header = $file_header->storeAs('uploaded/', $filename_header, 'public');
        $recruit->header_img_path = $path_header;

        $file_thumbnail = $request->file('thumbnail');
        $filename_thumbnail = now()->format('YmdHis') . uniqid('', true) . "." . $file_thumbnail->extension();
        $path_thumbnail = $file_thumbnail->storeAs('uploaded/', $filename_thumbnail, 'public');
        $recruit->thumbnail_path = $path_thumbnail;

        $recruit->title = $request->title;
        $recruit->text = $request->text;
        $recruit->user_id = Auth::id();
        $recruit->save();

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
        $recruit = Recruit::find($id)->first();

        if ($recruit) {
            $recruit->delete();
            return response()->json([
                'message' => 'delete successfully'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'Article not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
