<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CropController extends Controller
{
    public function postGetView(Request $request){
        $data = $request->all();
        return view('inc.crop',compact('data'));
    }
}
