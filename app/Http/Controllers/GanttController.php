<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GanttController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('gh_token') AND 
            $request->session()->has('gh_user') AND 
            $request->session()->has('gh_repos')) 
        {
            return view('gantt');
        }
        else 
        {
            return redirect()->route('config.create');
        }
    }
}