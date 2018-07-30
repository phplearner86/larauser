<?php

namespace App\Http\Controllers;

use App\Day;
use App\DayProfile;
use App\Http\Requests\DaysRequest;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function home()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function test($userId)
    {
        $user = User::find($userId);
        return view('test', compact('user'));
    }

    
}
