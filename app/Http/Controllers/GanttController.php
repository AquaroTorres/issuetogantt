<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GanttController extends Controller
{
    public function indexByProject(Request $request)
    {
        if ($request->session()->has('gh_token') AND 
            $request->session()->has('gh_user') AND 
            $request->session()->has('gh_repos')) 
        {
            return view('gantt_by_project');
        }
        else 
        {
            return redirect()->route('config.create');
        }
    }

    public function indexByUser(Request $request)
    {
        if ($request->session()->has('gh_token') AND 
            $request->session()->has('gh_user') AND 
            $request->session()->has('gh_repos')) 
        {
            return view('gantt_by_user');
        }
        else 
        {
            return redirect()->route('config.create');
        }
    }
}