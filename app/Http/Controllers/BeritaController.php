<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Berita';
        $data['active'] = 'Berita';
        $data['styles'] = ['common', 'berita'];
        $sort = (!isset($request->sort)) ? 'created_at' : $request->sort ;
        $data['beritas'] = ($sort === 'title') ? Berita::all()->sortBy($sort) : Berita::all()->sortByDesc($sort) ;
        $data['sort'] = $sort;
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

        $berita->visitor += 1;
        $berita->save();

        return view('menu/baca-berita', $data);
    }

    public function store_comment(Request $request, Berita $berita)
    {
        $berita->comments()->create([
            'comment' => $request->comment,
            'user_id' => Auth::user()->id
        ]);

        return Redirect::back();
    }

    public function comment_like(Comment $comment)
    {
        $like = $comment->likes()->where('user_id', '=', Auth::id());
        if (!count($like->get())) {
            $comment->likes()->create([
                'user_id' => Auth::id()
            ]);
            $like_status = true;
        } else {
            $like->delete();
            $like_status = false;
        }

        return response()->json(['message' => 'success', 'like_status' => $like_status]);
    }

    public function comment_dislike(Comment $comment)
    {
        $comment->likes()->create([
            'user_id' => Auth::id()
        ]);

        return response()->json(['message' => 'success']);
    }
}
