<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GraphqlController extends Controller
{
    //


    public function index(){
        $users = User::latest()->get();
        return $users;
    }

}
