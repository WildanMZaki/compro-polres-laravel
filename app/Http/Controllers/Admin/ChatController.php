<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $data['title'] = 'Chats';
        $data['user'] = Auth::user();
        $data['active'] = 'Chats';
        $data['header'] = 'Live Chats';
        $data['breadcumbs'] = ['Chat'];
        return view('admin/chats', $data);
    }
}
