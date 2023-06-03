<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $data['title'] = 'Profile';
        $data['active'] = 'Profile';
        $data['styles'] = ['common', 'profile'];
        $data['scripts'] = ['profile'];
        $data['user'] = Auth::user();
        return view('menu/profile', $data);
    }
}
