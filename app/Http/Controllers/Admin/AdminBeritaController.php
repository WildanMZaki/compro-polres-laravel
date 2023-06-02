<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBeritaController extends Controller
{
    public function index()
    {
        $data['title'] = 'Semua Berita';
        $data['active'] = 'Berita';
        return view('admin/admin-berita', $data);
    }
}
