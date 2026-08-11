<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function clocks()
    {
        $clocks = [];

        return view('clocks', compact(
            "clocks",
        ));
    }
}
