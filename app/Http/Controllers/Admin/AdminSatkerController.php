<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Satker;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminSatkerController extends Controller
{
    public function index()
    {
        $data['title'] = 'Daftar Satuan Kerja';
        $data['active'] = 'Satuan Kerja';
        $data['header'] = 'Daftar Satuan Kerja';
        $data['breadcumbs'] = ['Satuan Kerja'];
        $data['styles'] = ['admin/satker-list'];
        $data['scripts'] = ['search', 'admin/satker'];
        $data['satkers'] = Satker::all();
        $data['user'] = Auth::user();
        return view('admin/admin-satker', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Satuan Kerja';
        $data['active'] = 'Satuan Kerja';
        $data['header'] = 'Tambahkan Satuan Kerja';
        $data['route_back'] = 'admin-satker';
        $data['breadcumbs'] = [
            [
                'label' => 'Satuan Kerja',
                'route' => 'admin-satker'
            ],
            'Tambah'
        ];
        $data['styles'] = ['admin/additional'];
        $data['scripts'] = ['admin/form-satker', 'admin/tambah-satker'];
        $data['user'] = Auth::user();
        return view('admin/form-satker', $data);
    }

    public function save_satker(Request $request)
    {
        $rules = [
            'name' => 'required|max:100|unique:satkers',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
            'deskripsi' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'contacts' => 'required',
        ];
        $messages = [
            'image.required' => 'Maaf tolong pilih satu gambar utama',
            'image.image' => 'Maaf tolong input gambar',
            'image.mimes' => 'Maaf jenis gambar yang diizinkan adalah .jpg, .jpeg, .png, .gif',
            'contacts.required' => 'Setidaknya sertakan satu kontak',
            'required' => 'Maaf kolom ini harus diisikan',
            'name.unique' => 'Nama satuan kerja tersebut telah ada, tolong masukan nama yang lain',
            'name.max' => 'Maksimal karakter untuk nama karakter adalah 100 karakter'
        ];
        $this->validate($request, $rules, $messages);

        // $misi_list = $request->misi_list_item;
        // $misi_p = $request->misi_p;
        // if ($request->misi_type === 'paragraf') {
        //     $misi_list = [];
        // } elseif ($request->misi_type === 'list') {
        //     $misi_p = '';
        // }
        // $misi = json_encode([
        //     'p' => $misi_p,
        //     'list' => $misi_list
        // ]);

        $slug = sluger($request->name);
        if (count(Satker::where('slug', '==', $slug)->get())) { $slug .= time(); }

        $file = $request->file('image');
        $filename = $slug . '.' . $file->getClientOriginalExtension();
        $img = Image::make($file);
        $img->save(public_path('img/satker/') . $filename);

        Satker::create([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $filename,
            'deskripsi' => $request->deskripsi,
            'visi' => $request->visi,
            'misi' => $request->misi
        ]);

        $contacts = [];
        foreach ($request->contacts as $ind => $contact) {
            $contacts[] = [
                'type' => $request->contact_type[$ind],
                'contact' => $contact
            ];
        }
        $allSatker = collect(Satker::all());
        $satker = $allSatker->firstWhere('slug', '==', sluger($request->name));
        $s = Satker::find($satker->id);
        $s->satker_contacts()->createMany($contacts);

        return Redirect::to('/Admin/Satker');
    }

    public function edit_satker(Satker $satker)
    {
        $data['title'] = 'Edit Satuan Kerja';
        $data['active'] = 'Satuan Kerja';
        $data['route_back'] = 'admin-satker';
        $data['header'] = 'Edit Satuan Kerja';
        $data['breadcumbs'] = [
            [
                'label' => 'Satuan Kerja',
                'route' => 'admin-satker'
            ],
            'Edit'
        ];
        $data['styles'] = ['admin/additional'];
        $data['scripts'] = ['admin/form-satker', 'admin/edit-satker'];
        $data['satker'] = $satker;
        $data['contacts'] = $satker->satker_contacts;
        $data['user'] = Auth::user();
        return view('admin/form-satker', $data);
    }

    public function update_satker(Request $request, Satker $satker)
    {
        $rules = [
            'name' => 'required|max:100',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
            'deskripsi' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'contacts' => 'required',
        ];
        $messages = [
            'image.required' => 'Maaf tolong pilih satu gambar utama',
            'image.image' => 'Maaf tolong input gambar',
            'image.mimes' => 'Maaf jenis gambar yang diizinkan adalah .jpg, .jpeg, .png, .gif',
            'contacts.required' => 'Setidaknya sertakan satu kontak',
            'required' => 'Maaf kolom ini harus diisikan',
            'name.max' => 'Maksimal karakter untuk nama karakter adalah 100 karakter'
        ];
        $this->validate($request, $rules, $messages);

        // $misi_list = $request->misi_list_item;
        // $misi_p = $request->misi_p;
        // if ($request->misi_type === 'paragraf') {
        //     $misi_list = [];
        // } elseif ($request->misi_type === 'list') {
        //     $misi_p = '';
        // }
        // $misi = json_encode([
        //     'p' => $misi_p,
        //     'list' => $misi_list
        // ]);

        $slug = sluger($request->name);
        if (count(Satker::where('slug', '==', $slug)->get())) { $slug .= time(); }

        if ($request->hasFile('image')) {
            File::delete(public_path('img/satker/'.$satker->image));

            $file = $request->file('image');
            $filename = $slug . '.' . $file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->save(public_path('img/satker/') . $filename);
            $satker->image = $filename;
        }

        $satker->name = $request->name;
        $satker->slug = $slug;
        $satker->deskripsi = $request->deskripsi;
        $satker->visi = $request->visi;
        $satker->misi = $request->misi;
        $satker->save();

        $satker->satker_contacts()->where('satker_id', $satker->id)->delete();

        $contacts = [];
        foreach ($request->contacts as $ind => $contact) {
            $contacts[] = [
                'type' => $request->contact_type[$ind],
                'contact' => $contact
            ];
        }
        $satker->satker_contacts()->createMany($contacts);

        return Redirect::to('/Admin/Satker');
    }

    public function remove_satker(Satker $satker)
    {
        File::delete(public_path('img/satker/'.$satker->image));
        $satker->delete();
        return Redirect::to('/Admin/Satker');
    }
}
