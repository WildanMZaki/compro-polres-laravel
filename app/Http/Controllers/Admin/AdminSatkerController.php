<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Satker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        return view('admin/admin-satker', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Satuan Kerja';
        $data['active'] = 'Satuan Kerja';
        $data['header'] = 'Tambahkan Satuan Kerja';
        $data['breadcumbs'] = [
            [
                'label' => 'Satuan Kerja',
                'route' => 'admin-satker'
            ],
            'Tambah'
        ];
        $data['styles'] = ['admin/additional'];
        $data['scripts'] = ['admin/form-satker', 'admin/tambah-satker'];
        return view('admin/form-satker', $data);
    }

    public function save_satker(Request $request)
    {
        $misi_list = $request->misi_list_item;
        $misi_p = $request->misi_p;
        if ($request->misi_type === 'paragraf') {
            $misi_list = [];
        } elseif ($request->misi_type === 'list') {
            $misi_p = '';
        }
        $misi = json_encode([
            'p' => $misi_p,
            'list' => $misi_list
        ]);

        Satker::create([
            'name' => $request->name,
            'slug' => sluger($request->name),
            'image' => '',
            'deskripsi' => $request->deskripsi,
            'visi' => $request->visi,
            'misi' => $misi
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
        return view('admin/form-satker', $data);
    }

    public function update_satker(Request $request, Satker $satker)
    {
        $misi_list = $request->misi_list_item;
        $misi_p = $request->misi_p;
        if ($request->misi_type === 'paragraf') {
            $misi_list = [];
        } elseif ($request->misi_type === 'list') {
            $misi_p = '';
        }
        $misi = json_encode([
            'p' => $misi_p,
            'list' => $misi_list
        ]);

        $satker->name = $request->name;
        $satker->slug = sluger($request->name);
        $satker->deskripsi = $request->deskripsi;
        $satker->visi = $request->visi;
        $satker->misi = $misi;
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
        $satker->delete();
        return Redirect::to('/Admin/Satker');
    }
}
