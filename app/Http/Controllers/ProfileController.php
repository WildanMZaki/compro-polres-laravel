<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['active'] = 'Profile';
        $data['styles'] = ['common'];
        $data['route_back'] = 'profile';
        $data['header'] = 'Edit Profile';
        $data['user'] = Auth::user();
        return view('menu/edit-profile', $data);
    }

    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telepon_number = $request->telepon_number;
        $user->save();

        return Redirect::to('Profile');
    }
}
