<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satker;

class SatkerController extends Controller
{
    public function index()
    {
        $data['title'] = 'Satuan Kerja';
        $data['active'] = 'Satker';
        $data['styles'] = ['common', 'satker'];
        $data['scripts'] = ['search', 'satker'];
        $data['satkers'] = Satker::all();
        return view('menu/satker', $data);
    }

    public function detail_satker(Satker $satker)
    {
        $data['title'] = 'Detail Satuan Kerja';
        $data['active'] = 'Satker';
        $data['styles'] = ['common', 'satker'];
        $data['route_back'] = 'satker';
        $data['satker'] = $satker;
        return view('menu/detail-satker', $data);
    }
}
