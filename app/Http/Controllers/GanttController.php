<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GanttController extends Controller
{
    public function index()
    {
        if (Cache::has('gh_token') AND Cache::has('gh_user') AND Cache::has('gh_repos')) {
            return view('gantt');
        }
        else {
            return redirect()->route('config.create');
        }
    }
}