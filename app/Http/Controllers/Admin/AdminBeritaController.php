<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;
class AdminBeritaController extends Controller
{
    public function index()
    {
        $data['title'] = 'Semua Berita';
        $data['active'] = 'Berita';
        $data['header'] = 'Semua Berita';
        $data['breadcumbs'] = ['Berita'];
        // $data['styles'] = ['admin/satker-list'];
        $data['scripts'] = ['search', 'admin/berita'];
        $data['beritas'] = Berita::all();
        return view('admin/admin-berita', $data);
    }

    public function add()
    {
        $data['title'] = 'Berita Baru';
        $data['active'] = 'Berita';
        $data['header'] = 'Publish Berita Baru';
        $data['breadcumbs'] = [
            [
                'label' => 'Berita',
                'route' => 'admin-berita'
            ],
            'New'
        ];
        $data['styles'] = ['admin/additional'];
        return view('admin/form-berita', $data);
    }

    public function save_news(Request $request)
    {
        $file = $request->file('image');
        $filename = time() .'-'. str_shuffle(time()) . '.' . $file->getClientOriginalExtension();
        $img = Image::make($file);
        $img->save(public_path('img/berita/') . $filename);

        Berita::create([
            'title' => $request->title,
            'slug' => sluger($request->title),
            'image' => $filename,
            'content' => $request->content,
        ]);

        return Redirect::to('/Admin/Berita');
    }

    public function remove_news(Berita $berita)
    {
        $berita->delete();
        return Redirect::to('/Admin/Berita');
    }
}
