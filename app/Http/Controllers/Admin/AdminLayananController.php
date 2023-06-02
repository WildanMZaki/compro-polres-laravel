<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLayananController extends Controller
{
    public function sim()
    {
        $data['title'] = 'Layanan Pembuatan SIM';
        $data['active'] = 'SIM';
        return view('admin/layanan/sim', $data);
    }

    public function stnk()
    {
        $data['title'] = 'Layanan STNK';
        $data['active'] = 'STNK';
        return view('admin/layanan/stnk', $data);
    }

    public function skck()
    {
        $data['title'] = 'Layanan Pembuatan SKCK';
        $data['active'] = 'SKCK';
        return view('admin/layanan/skck', $data);
    }

    public function etilang()
    {
        $data['title'] = 'E-Tilang';
        $data['active'] = 'E-Tilang';
        return view('admin/layanan/etilang', $data);
    }
}
