<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CropController extends Controller
{
    public function postGetView(Request $request){
        $data = $request->all();
        return view('inc.crop',compact('data'));
    }
}
