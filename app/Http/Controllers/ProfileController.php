<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data['title'] = 'Profile';
        $data['active'] = 'Profile';
        $data['styles'] = ['common', 'profile'];
        $data['scripts'] = ['profile'];
        return view('menu/profile', $data);
    }
}
