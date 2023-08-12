<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecruitRequest;
use App\Http\Requests\UpdateRecruitRequest;
use App\Models\Recruit;

class RecruitController extends Controller
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
    public function store(StoreRecruitRequest $request,Recruit $recruit)
    {

        $recruit->fill($request->all())-save();

        // $dir = 'uploads';

        // // sampleディレクトリに画像を保存
        // $request->file('image')->store('public/' . $dir);
        return response()->json([
            'request'=>$request
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recruit $recruit)
    {
        //
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
    public function update(UpdateRecruitRequest $request, Recruit $recruit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recruit $recruit)
    {
        //
    }
}
