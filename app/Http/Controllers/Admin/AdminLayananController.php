<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class AdminLayananController extends Controller
{
    public function index()  {
        $data['title'] = 'Layanan';
        $data['active'] = 'Layanan';
        $data['header'] = 'Daftar Layanan';
        $data['breadcumbs'] = ['Layanan'];
        $data['scripts'] = ['search'];
        $data['user'] = Auth::user();
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
        return view('admin/admin-layanan', $data);
    }

    public function add() {
        $data['title'] = 'Tambah Layanan';
        $data['active'] = 'Layanan';
        $data['header'] = 'Tambahkan Layanan';
        $data['route_back'] = 'admin-layanan';
        $data['breadcumbs'] = [
            [
                'label' => 'Layanan',
                'route' => 'admin-layanan'
            ],
            'Tambah'
        ];
        $data['user'] = Auth::user();
        return view('admin/form-layanan', $data);
    }

    public function save(Request $request) {
        $rules = [
            'name' => 'required|max:50',
            'icon' => 'required|image|mimes:jpg,jpeg,png,gif',
            'link' => 'required'
        ];
        $messages = [
            'icon.required' => 'Maaf tolong pilih sebuah icon untuk layanan',
            'icon.image' => 'Maaf tolong input gambar',
            'icon.mimes' => 'Maaf jenis gambar yang diizinkan adalah .jpg, .jpeg, .png, .gif',
            'required' => 'Maaf kolom ini harus diisi',
            'name.max' => 'Maksimal karakter untuk judul adalah :max karakter'
        ];
        $this->validate($request, $rules, $messages);

        $file = $request->file('icon');
        $filename = str_shuffle(time()).date('d-m-Y_H--i--s'). '.' . $file->getClientOriginalExtension();
        $save_path = public_path('img/layanan/');
        if (!file_exists($save_path)) {
            mkdir($save_path, 775, true);
        }
        Image::make($file->getRealPath())
            ->resize(null, 512, function ($constraint) { $constraint->aspectRatio(); })
            ->save($save_path.$filename);

        $slug = sluger($request->name);
        if (count(Layanan::where('slug', '==', $slug)->get())) { $slug .= time(); }

        Layanan::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'slug' => $slug,
            'icon' => $filename,
            'link' => $request->link,
        ]);

        return Redirect::to('/Admin/Layanan');
    }

    public function edit(Layanan $layanan) {
        $data['title'] = 'Edit Layanan';
        $data['active'] = 'Layanan';
        $data['header'] = 'Edit Layanan';
        $data['route_back'] = 'admin-layanan';
        $data['breadcumbs'] = [
            [
                'label' => 'Layanan',
                'route' => 'admin-layanan'
            ],
            'Edit'
        ];
        $data['user'] = Auth::user();
        $data['layanan'] = $layanan;
        return view('admin/form-layanan', $data);
    }

    public function update(Request $request, Layanan $layanan) {
        $rules = [
            'name' => 'required|max:50',
            'icon' => 'image|mimes:jpg,jpeg,png,gif',
            'link' => 'required'
        ];
        $messages = [
            'icon.image' => 'Maaf tolong input gambar',
            'icon.mimes' => 'Maaf jenis gambar yang diizinkan adalah .jpg, .jpeg, .png, .gif',
            'required' => 'Maaf kolom ini harus diisi',
            'name.max' => 'Maksimal karakter untuk judul adalah :max karakter'
        ];
        $this->validate($request, $rules, $messages);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = str_shuffle(time()).date('d-m-Y_H--i--s'). '.' . $file->getClientOriginalExtension();
            $save_path = public_path('img/layanan/');
            if (!file_exists($save_path)) {
                mkdir($save_path, 775, true);
            }
            Image::make($file->getRealPath())
                ->resize(null, 512, function ($constraint) { $constraint->aspectRatio(); })
                ->save($save_path.$filename);
            $layanan->icon = $filename;
        }

        $slug = sluger($request->name);
        if (count(Layanan::where('slug', '==', $slug)->get())) { $slug .= time(); }

        $layanan->name = $request->name;
        $layanan->slug = $slug;
        $layanan->deskripsi = $request->deskripsi;
        $layanan->link = $request->link;
        $layanan->save();

        return Redirect::to('/Admin/Layanan');
    }

    public function delete(Layanan $layanan)
    {
        File::delete(public_path('img/layanan/'.$layanan->icon));
        $layanan->delete();
        return Redirect::to('/Admin/Layanan');
    }
}
