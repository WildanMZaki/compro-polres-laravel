<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $data['title'] = 'Berita';
        $data['active'] = 'Berita';
        $data['styles'] = ['common', 'berita'];
        $data['scripts'] = ['search', 'berita'];
        return view('menu/berita', $data);
    }
}
