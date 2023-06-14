<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Layanan;
use App\Models\Satker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

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
        return view('opening');
    }

    public function main()
    {
        $data['title'] = 'Polres Subang';
        $data['active'] = 'Home';
        $data['styles'] = ['common', '../module/slick/slick', '../module/slick/slick-theme', 'home'];
        $data['scripts'] = ['../module/slick/slick', 'home'];
        $data['satkers'] = Satker::all();
        $data['beritas'] = Berita::all()->sortByDesc('created_at')->take(3);
        $data['layanans'] = Layanan::all()->sortByDesc('visited')->take(4);
        return view('menu/home', $data);
    }
}
