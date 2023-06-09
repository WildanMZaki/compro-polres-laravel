<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\NewsImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class AdminBeritaController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Semua Berita';
        $data['active'] = 'Berita';
        $data['header'] = 'Semua Berita';
        $data['breadcumbs'] = ['Berita'];
        $data['scripts'] = ['search', 'admin/berita'];
        $sort = (!isset($request->sort)) ? 'created_at' : $request->sort ;
        $data['beritas'] = ($sort === 'title') ? Berita::all()->sortBy($sort) : Berita::all()->sortByDesc($sort) ;
        $data['sort'] = $sort;
        $data['user'] = Auth::user();
        return view('admin/admin-berita', $data);
    }

    public function preview(Berita $berita)
    {
        $data['title'] = 'Baca Berita';
        $data['active'] = 'Berita';
        $data['header'] = 'Baca Berita';
        $data['route_back'] = 'admin-berita';
        $data['breadcumbs'] = [
            [
                'label' => 'Berita',
                'route' => 'admin-berita'
            ],
            $berita->title
        ];
        $data['user'] = Auth::user();
        $data['berita'] = $berita;
        return view('admin/baca-berita', $data);
    }

    public function add()
    {
        $data['title'] = 'Berita Baru';
        $data['active'] = 'Berita';
        $data['header'] = 'Publish Berita Baru';
        $data['route_back'] = 'admin-berita';
        $data['breadcumbs'] = [
            [
                'label' => 'Berita',
                'route' => 'admin-berita'
            ],
            'New'
        ];
        $data['user'] = Auth::user();
        $data['images'] = NewsImage::all();
        return view('admin/form-berita', $data);
    }

    public function save_news(Request $request)
    {
        $rules = [
            'title' => 'required|max:250|unique:beritas',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
            'content' => 'required'
        ];
        $messages = [
            'image.required' => 'Maaf tolong pilih satu gambar utama',
            'image.image' => 'Maaf tolong input gambar',
            'image.mimes' => 'Maaf jenis gambar yang diizinkan adalah .jpg, .jpeg, .png, .gif',
            'required' => 'Maaf kolom ini harus diisikan',
            'title.unique' => 'Judul tersebut telah ada, tolong masukan judul yang lain',
            'title.max' => 'Maksimal karakter untuk judul adalah 250 karakter'
        ];
        $this->validate($request, $rules, $messages);

        $file = $request->file('image');
        $filename = time() .'-'. str_shuffle(time()) . '.' . $file->getClientOriginalExtension();
        $img = Image::make($file);
        $img->save(public_path('img/berita/') . $filename);

        $slug = sluger($request->title);
        if (count(Berita::where('slug', '==', $slug)->get())) { $slug .= time(); }

        Berita::create([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $filename,
            'content' => $request->content,
        ]);

        return Redirect::to('/Admin/Berita');
    }

    public function edit_news(Berita $berita)
    {
        $data['title'] = 'Edit Baru';
        $data['active'] = 'Berita';
        $data['header'] = 'Edit Berita';
        $data['route_back'] = 'admin-berita';
        $data['breadcumbs'] = [
            [
                'label' => 'Berita',
                'route' => 'admin-berita'
            ],
            'Edit'
        ];
        $data['user'] = Auth::user();
        $data['berita'] = $berita;
        return view('admin/form-berita', $data);
    }

    public function update_news(Request $request, Berita $berita)
    {
        $rules = [
            'title' => 'required|max:250',
            'image' => 'image|mimes:jpg,jpeg,png,gif',
            'content' => 'required'
        ];
        $messages = [
            'required' => 'Maaf kolom ini harus diisikan',
            'image.image' => 'Maaf tolong input gambar',
            'image.mimes' => 'Maaf jenis gambar yang diizinkan adalah .jpg, .jpeg, .png, .gif',
            'title.max' => 'Maksimal karakter untuk judul adalah 250 karakter'
        ];
        $this->validate($request, $rules, $messages);

        if ($request->hasFile('image')) {
            File::delete(public_path('img/berita/'.$berita->image));

            $file = $request->file('image');
            $filename = time() .'-'. str_shuffle(time()) . '.' . $file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->save(public_path('img/berita/') . $filename);
            $berita->image = $filename;
        }

        $slug = sluger($request->title);
        if (count(Berita::where('slug', '==', $slug)->get())) { $slug .= time(); }
        $berita->title = $request->title;
        $berita->slug = $slug;
        $berita->content = $request->content;
        $berita->save();

        return Redirect::to('/Admin/Berita');
    }

    public function remove_news(Berita $berita)
    {
        File::delete(public_path('img/berita/'.$berita->image));
        $berita->delete();
        return Redirect::to('/Admin/Berita');
    }

    public function save_news_images(Request $request)
    {
        $this->validate($request, [
            'gambar_berita' => 'required',
            'gambar_berita.*' => 'image',
            'gambar_berita.*' => 'mimes:jpg,jpeg,png'
        ], [
            'gambar_berita.required' => 'Tolong input setidaknya satu gambar',
            'gambar_berita.image' => 'Tolong inputkan gambar',
            'gambar_berita.mimes' => 'Ekstensi yang diizinkan adalah .jpg, .jpeg, dan .png'
        ]);
        $files = [];
        foreach ($request->file('gambar_berita') as $file) {
            $filename = time().'-'.$file->getClientOriginalName();
            $img = Image::make($file);
            $img->save(public_path('img/berita/') . $filename);
            $files[] = [
                'name' => $filename,
            ];
        }
        NewsImage::insert($files);

        return redirect()->back()->withInput();
    }
}
