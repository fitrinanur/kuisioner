<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request) {
       
        $type = $request->type;
        $id = $request->id;

    	return view('video', compact('type','id'));
    }
}
