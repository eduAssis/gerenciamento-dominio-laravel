<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userName = Auth::user()->name;

        return view('dashboard', ['userName' => $userName]);
    }
}
