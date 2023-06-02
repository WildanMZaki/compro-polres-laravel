<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data['title'] = 'Admin';
        $data['active'] = 'Admin';
        $data['header'] = 'Admin Dashboard';
        $data['breadcumbs'] = ['Admin'];
        return view('admin/dashboard', $data);
    }

    public function accounts()
    {
        $data['title'] = 'Admin List';
        $data['active'] = 'Accounts';
        return view('admin/accounts', $data);
    }

    public function reports()
    {
        $data['title'] = 'Reports';
        $data['active'] = 'Reports';
        return view('admin/reports', $data);
    }
}
