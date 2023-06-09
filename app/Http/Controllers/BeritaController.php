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
        $data['styles'] = ['common'];
        $data['route_back'] = 'berita';
        $data['header'] = 'Baca Berita';
        $data['berita'] = $berita;
        $data['comments'] = $berita->comments;
        $data['scripts'] = ['baca-berita'];
        if (Auth::check()) {
            $data['user'] = Auth::user();
        }
        $berita->visitor += 1;
        $berita->save();

        $data['other_news'] = Berita::orderBy('created_at', 'DESC')
            ->orderBy('visitor', 'DESC')
            ->get()->take(4);

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

    public function delete_comment(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }

    public function comment_like(Comment $comment)
    {
        $like = $comment->likes()->where('user_id', '=', Auth::id());
        if (!count($like->get())) {
            $comment->likes()->create([
                'user_id' => Auth::id()
            ]);
            $like_status = true;
            $dislike = $comment->dislikes()->where('user_id', '=', Auth::id());
            if (count($dislike->get())) {
                $dislike->delete();
            }
        } else {
            $like->delete();
            $like_status = false;
        }

        return response()->json([
            'message' => 'success',
            'like_status' => $like_status,
            'likes' => count($comment->likes),
            'dislikes' => count($comment->dislikes),
        ]);
    }

    public function comment_dislike(Comment $comment)
    {
        $dislike = $comment->dislikes()->where('user_id', '=', Auth::id());
        if (!count($dislike->get())) {
            $comment->dislikes()->create([
                'user_id' => Auth::id()
            ]);
            $dislike_status = true;
            $like = $comment->likes()->where('user_id', '=', Auth::id());
            if (count($like->get())) {
                $like->delete();
            }
        } else {
            $dislike->delete();
            $dislike_status = false;
        }

        return response()->json([
            'message' => 'success',
            'dislike_status' => $dislike_status,
            'likes' => count($comment->likes),
            'dislikes' => count($comment->dislikes),
        ]);
    }

    public function test()
    {
        return response()->json(['status' => 'success']);
    }
}
