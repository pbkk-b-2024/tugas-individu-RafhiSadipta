<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function param1($param1 = '')
    {
        $data['param1'] = $param1;
        return view('Rute.param1', compact('data'));
    }
    
    public function param2($param1 = '', $param2 = '')
    {
        $data['param1'] = $param1;
        $data['param2'] = $param2;
        return view('Rute.param2', compact('data'));
    }
    
}
