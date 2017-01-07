<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends BaseController
{

    public function __construct(Request $request)
    {
        $this->controller = 'index';
        parent::__construct($request);
    }

    public function index()
    {
        $this->title = trans('app.dashboard');
        //\Auth::logout();
        return view('index.index');
    }
}
