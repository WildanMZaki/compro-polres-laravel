<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LayananController extends Controller
{
    public function index()
    {
        $data['title'] = 'Layanan';
        $data['active'] = 'Layanan';
        $data['styles'] = ['common', 'layanan'];
        $data['scripts'] = ['layanan'];
        $allService = Layanan::all();
        $withDesc = [];
        $noDesc = [];
        foreach ($allService as $service) {
            if ($service->deskripsi) {
                $withDesc[] = $service;
            } else {
                $noDesc[] = $service;
            }
        }
        $data['layanans'] = array_merge($withDesc, $noDesc);
        return view('menu/layanan', $data);
    }

    public function get(Layanan $layanan) {
        $layanan->visited += 1;
        $layanan->save();

        return Redirect::to($layanan->link);
    }
}
