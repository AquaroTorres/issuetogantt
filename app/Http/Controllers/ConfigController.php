<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function create() 
    {
        return view('config.create');
    }
    
    public function store(Request $request) 
    {
        session(['gh_user'  => $request->input('gh_user')]);
        session(['gh_token' => $request->input('gh_token')]);
        session(['gh_repos' => $request->input('gh_repos')]);
        return redirect()->route('index');
    }

    public function delete(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('index');
    }
}
