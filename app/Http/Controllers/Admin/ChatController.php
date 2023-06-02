<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $data['title'] = 'Chats';
        $data['active'] = 'Chats';
        return view('admin/chats', $data);
    }
}
