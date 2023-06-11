<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

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
        $data['styles'] = ['common', 'profile'];
        $data['route_back'] = 'profile';
        $data['header'] = 'Edit Profile';
        $data['user'] = Auth::user();
        return view('menu/edit-profile', $data);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'telepon_number' => 'required|min:11',
        ], [
            'required' => 'Masih ada kolom yang berlum kamu isi',
            'string' => 'Input harus berupa teks',
            'email' => 'Email kamu belum valid',
            'max' => 'Karakter yang diizikan adalah 255 karakter',
            'min' => 'Tolong tuliskan setidaknya :min karakter',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telepon_number = $request->telepon_number;
        $user->save();

        return Redirect::to('Profile');
    }

    public function photo()
    {
        $data['title'] = 'Edit Foto Profile';
        $data['active'] = 'Profile';
        $data['styles'] = ['common', 'profile'];
        $data['route_back'] = 'edit-profile';
        $data['header'] = 'Edit Foto';
        $data['user'] = Auth::user();
        return view('menu/edit-foto', $data);
    }

    public function apply_photo(Request $request)
    {
        $rules = [
            'foto' => 'required|image|mimes:jpg,jpeg,png,gif',
        ];
        $messages = [
            'foto.required' => 'Maaf tolong pilih satu gambar utama',
            'foto.image' => 'Maaf tolong input gambar',
            'foto.mimes' => 'Maaf jenis gambar yang diizinkan adalah .jpg, .jpeg, .png, .gif',
        ];
        $this->validate($request, $rules, $messages);

        if (Auth::user()->image !== 'anonim.jpg') {
            File::delete(public_path('img/berita/'.Auth::user()->image));
        }

        $file = $request->file('foto');
        $filename = sluger(Auth::user()->name) . time() . '.' . $file->getClientOriginalExtension();
        $img = Image::make($file);
        $img->save(public_path('img/user/') . $filename);

        $user = User::find(Auth::id());
        $user->image = $filename;
        $user->save();
        return Redirect::back();
    }
}
