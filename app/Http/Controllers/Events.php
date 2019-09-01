<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class Events extends Controller
{
    public function getLoggedInUser(){
        return Auth::user()->id;
    }
}