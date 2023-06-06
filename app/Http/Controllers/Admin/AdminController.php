<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Satker;
use App\Models\Berita;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        foreach (Berita::all() as $b) {
            $reader += $b->visitor;
        }
        $data['user'] = Auth::user();
        $data['reader'] = $reader;
        return view('admin/dashboard', $data);
    }

    public function accounts()
    {
        $data['title'] = 'Admin List';
        $data['user'] = Auth::user();
        $data['active'] = 'Accounts';
        return view('admin/accounts', $data);
    }

    public function reports()
    {
        $data['title'] = 'Reports';
        $data['active'] = 'Reports';
        $data['user'] = Auth::user();
        return view('admin/reports', $data);
    }
}
