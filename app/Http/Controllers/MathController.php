<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MathController extends Controller
{
    public function timesTable()
    {
        return view('math.timesTable');
    }
}
