<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $data['title'] = 'Layanan';
        $data['active'] = 'Layanan';
        $data['styles'] = ['common', 'layanan'];
        $data['scripts'] = ['layanan'];
        return view('menu/layanan', $data);
    }
}
