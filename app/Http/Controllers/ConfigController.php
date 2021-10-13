<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ConfigController extends Controller
{
    public function create() 
    {
        return view('config.create');
    }
    
    public function store(Request $request) 
    {
        Cache::forever('gh_user', $request->input('gh_user'));
        Cache::forever('gh_token', $request->input('gh_token'));
        Cache::forever('gh_repos', $request->input('gh_repos'));
        return redirect()->route('index');
    }

    public function delete()
    {
        Cache::forget('gh_user');
        Cache::forget('gh_token');
        Cache::forget('gh_repos');
        return redirect()->route('index');
    }
}
