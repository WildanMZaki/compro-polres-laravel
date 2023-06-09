<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Satker;
use App\Models\Berita;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $data['title'] = 'Admin';
        $data['active'] = 'Admin';
        $data['header'] = 'Admin Dashboard';
        $data['breadcumbs'] = ['Admin'];
        // Page data:
        $data['satker_total'] = count(Satker::all());
        $data['berita_total'] = count(Berita::all());
        $data['berita_terbaru'] = Berita::all()->sortByDesc('created_at')->take(4);
        $reader = 0;
        foreach ($data['berita_terbaru'] as $b) {
            $reader += $b->visitor;
            $reporter = (User::find($b->user_id)->where('id', '=', $b->user_id)->get())[0]->name;
            $b->reporter = $reporter === Auth::user()->name? 'Saya': $reporter;
        }
        $data['user'] = Auth::user();
        $data['reader'] = $reader;
        if (Auth::user()->role === 'admin-berita') {
            $berita_saya = Berita::where('user_id', '=', Auth::id())->get();
            $data['my_news'] = $berita_saya;
            $data['berita_saya'] = count($berita_saya);
            $reader_saya = 0;
            foreach ($berita_saya as $bs) {
                $reader_saya += $bs->visitor;
            }
            $data['reader_saya'] = $reader_saya;
        }
        return view('admin/dashboard', $data);
    }

    public function accounts()
    {
        $data['title'] = 'Admin List';
        $data['user'] = Auth::user();
        $data['active'] = 'Accounts';
        $data['header'] = 'Daftar Akun Administrator';
        $data['breadcumbs'] = ['Akun'];
        $data['administrators'] = User::where('role', '=', 'admin-berita')->get();
        return view('admin/accounts', $data);
    }

    public function save_account(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telepon_number' => 'required|min:11',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'required' => 'Masih ada kolom yang belum kamu isi',
            'unique' => 'Email sudah digunakan',
            'string' => 'Input harus berupa teks',
            'email' => 'Email kamu belum valid',
            'max' => 'Karakter yang diizikan adalah 255 karakter',
            'min' => 'Tolong tuliskan setidaknya :min karakter',
            'confirmed' => 'Password tidak sesuai dengan konfirmasi'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('progress_error', 'create');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telepon_number' => $request->telepon_number,
            'role' => 'admin-berita',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('progress_success', 'create');
    }

    public function update_account(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name_update' => 'required|string|max:255',
            'email_update' => 'required|string|email|max:255',
            'telepon_number_update' => 'required|min:11',
        ], [
            'required' => 'Masih ada kolom yang belum kamu isi',
            'string' => 'Input harus berupa teks',
            'email' => 'Email kamu belum valid',
            'max' => 'Karakter yang diizikan adalah 255 karakter',
            'min' => 'Tolong tuliskan setidaknya :min karakter',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        $user->name = $request->name_update;
        $user->email = $request->email_update;
        $user->telepon_number = $request->telepon_number_update;
        $user->save();

        return response()->json([
            'status' => 'success',
            'id' => $user->id,
            'admin_name' => $request->name_update,
            'admin_email' => $request->email_update,
            'admin_telepon_number' => $request->telepon_number_update,
            'is_online' => Auth::id() === $user->id
        ]);
    }

    public function remove_account(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
