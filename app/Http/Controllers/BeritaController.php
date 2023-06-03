<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
class BeritaController extends Controller
{
    public function index()
    {
        $data['title'] = 'Berita';
        $data['active'] = 'Berita';
        $data['styles'] = ['common', 'berita'];
        $data['beritas'] = Berita::all();
        $data['scripts'] = ['search', 'berita'];
        return view('menu/berita', $data);
    }

    public function show(Berita $berita)
    {
        $data['title'] = 'Baca Berita';
        $data['active'] = 'Berita';
        $data['styles'] = ['common', 'berita'];
        $data['route_back'] = 'berita';
        $data['header'] = 'Baca Berita';
        $data['berita'] = $berita;
        $data['comments'] = $berita->comments;
        return view('menu/baca-berita', $data);
    }

    public function store_comment(Request $request)
    {

    }
}
