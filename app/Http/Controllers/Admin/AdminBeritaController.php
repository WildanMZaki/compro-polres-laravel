<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\NewsImage;
use App\Models\User;
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
        $data['scripts'] = ['search'];
        $sort = (!isset($request->sort)) ? 'created_at' : $request->sort ;
        if (Auth::user()->role === 'admin') {
            $data['beritas'] = ($sort === 'title') ? Berita::all()->sortBy($sort) : Berita::all()->sortByDesc($sort) ;
        } else {
            $data['beritas'] = ($sort === 'title') ? Berita::where('user_id', '=', Auth::id())->get()->sortBy($sort) : Berita::where('user_id', '=', Auth::id())->get()->sortByDesc($sort) ;
        }
        foreach ($data['beritas'] as $b) {
            $reporter = (User::where('id', '=', $b->user_id)->get())[0]->name;
            $b->reporter = $reporter;
        }
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
        $save_path = public_path('img/berita/');
        if (!file_exists($save_path)) {
            mkdir($save_path, 775, true);
        }
        Image::make($file->getRealPath())->save($save_path.$filename);

        $slug = sluger($request->title);
        if (count(Berita::where('slug', '==', $slug)->get())) { $slug .= time(); }

        Berita::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => $slug,
            'image' => $filename,
            'content' => $request->content,
        ]);

        return Redirect::to('/Admin/Berita');
    }

    public function edit_news(Berita $berita)
    {
        if (Auth::user()->role === 'admin-berita') {
            if ($berita->user_id !== Auth::id()) {
                return redirect('/Admin/Berita');
            }
        }
        $data['title'] = 'Edit Berita';
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
        $data['images'] = NewsImage::all();
        return view('admin/form-berita', $data);
    }

    public function update_news(Request $request, Berita $berita)
    {
        if (Auth::user()->role !== 'admin') {
            if ($berita->user_id !== Auth::id()) {
                return abort(403);
            }
        }
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
        if (Auth::user()->role !== 'admin') {
            if ($berita->user_id !== Auth::id()) {
                return abort(403);
            }
        }
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
