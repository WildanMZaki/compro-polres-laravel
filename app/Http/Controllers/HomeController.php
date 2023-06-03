<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Satker;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['title'] = 'Polres Subang';
        $data['active'] = 'Home';
        $data['styles'] = ['common', '../module/slick/slick', '../module/slick/slick-theme', 'home'];
        $data['scripts'] = ['../module/slick/slick', 'home'];
        $data['satkers'] = Satker::all();
        $allNews = collect(Berita::all());
        return view('menu/home', $data);
    }
}
