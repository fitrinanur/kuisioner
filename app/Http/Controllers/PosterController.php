<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosterController extends Controller
{
    public function index(Request $request) {
       
        $type = $request->type;
        $id = $request->id;

    	return view('poster', compact('type','id'));
    }
}
