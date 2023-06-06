@extends('admin-layouts.master')

@section('content')

@php
    $isEdit = isset($satker);
    // if ($isEdit) {
    //     $misi = json_decode($satker->misi);
    // }
@endphp

<form action="{{ route(!$isEdit? 'simpan-satker': 'perbarui-satker', $isEdit? $satker->slug: null) }}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($isEdit)
        @method('patch')
    @endif
<div class="row g-5 g-xl-8 mb-5">
    <div class="col-xl-10 offset-xl-1">
        <div class="mb-6">
            <label class="form-label fw-bold fs-3" for="satkerName">Nama Satuan Kerja</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Tuliskan Nama Satker" id="satkerName" value="{{ $isEdit? $satker->name: '' }}" />

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-6">
            <label class="form-label fw-bold fs-3" for="satkerImg">Upload Logo Satuan Kerja</label>
            <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" id="satkerImg" />

            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-6">
            <label class="form-label fw-bold fs-3" for="satkerDescription">Deskripsi</label> <br>
            <textarea name="deskripsi" id="satkerDescription" rows="4" class="w-100 rounded-1 border p-4 @error('deskripsi') is-invalid @enderror" placeholder="Tambahkan Deskripsi">{{ $isEdit? $satker->deskripsi: '' }}</textarea>

            @error('deskripsi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-6">
            <label class="form-label fw-bold fs-3" for="satkerVision">Visi</label> <br>
            <textarea name="visi" id="satkerVision" rows="4" class="w-100 rounded-1 border p-4  @error('visi') is-invalid @enderror" placeholder="Tambahkan Visi">{{ $isEdit? $satker->visi: '' }}</textarea>

            @error('visi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="satkerMission" class="form-label fw-bold fs-3">Misi</label>
            <textarea name="misi" id="my-editor" cols="30" rows="10" class="my-editor form-control @error('misi') is-invalid @enderror">{{ $isEdit? $satker->misi: '' }}</textarea>

            @error('misi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            {{-- <input type="hidden" name="misi_type">

            <div class="mission-templates row {{ $isEdit? 'd-none': ''}}" >
                <p>Pilih Template</p>
                <div class="col-xl-4 mb-5">
                    <div class="misi-template card card-custom cursor-pointer shadow-h" data-type="1">
                        <div class="card-header">
                            <div class="card-title">
                                <h6 class="p-0 m-0">Hanya Paragraf</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="">
                                Misi kami adalah untuk selalu menjadi yang terdepan dalam hal pelayanan kepada masyarakat dengan cara yang modern, cepat, dan efisien.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-5">
                    <div class="misi-template card card-custom cursor-pointer shadow-h" data-type="2">
                        <div class="card-header">
                            <div class="card-title">
                                <h6 class="p-0 m-0">List</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <ol>
                                <li>Melayani sepenuh hati</li>
                                <li>Selalu siap siaga</li>
                                <li>Selalu mengayomi masyarakat</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-5">
                    <div class="misi-template card card-custom cursor-pointer shadow-h" data-type="3">
                        <div class="card-header">
                            <div class="card-title">
                                <h6 class="p-0 m-0">Paragraf + List</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="">
                                Demi mewujudkan visi tersebut, kami berkomitmen untuk:
                            </p>
                            <ol>
                                <li>Melaksanakan tugas sepenuh hati</li>
                                <li>Selalu menjadi teladan</li>
                                <li>Menjaga keamanan dan ketenangan masyarakat</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-end mb-4 {{ $isEdit? '': 'd-none' }}">
                <div class="col-xl-3">
                    <button id="change-template" type="button" class="btn btn-secondary"><i class="bx bx-"></i> Ubah template</button>
                </div>
            </div>
            <div class="row">
                <div id="misi_t1" class="mb-5 {{ ($isEdit && $misi->p)? '': 'd-none' }}">
                    <textarea name="misi_p" id="satkerMission" rows="4" class="w-100 rounded-1 border p-4" placeholder="Tambahkan Misi">{{ (($isEdit && $misi->p)? $misi->p: '')}}</textarea>
                </div>
                <div id="misi_t2" class="{{ ($isEdit && count($misi->list))? '': 'd-none' }}">
                    <div class="d-flex flex-column w-100" id="mission-list">
                        @if (!$isEdit)
                            <div class="rmission d-flex align-items-center w-100 flex-stretch mb-3" id="rmission1">
                                <div class="p-4 row-number-mission-item">1.</div>
                                <div class="w-100 me-3">
                                    <input type="text" name="misi_list_item[]" class="form-control w-100">
                                </div>
                                <div>
                                    <button type="button" class="remove-mission-item btn btn-danger" data-count="1"><span class="d-flex align-items-center"><i class="bx bx-x"></i> Hapus</span></button>
                                </div>
                            </div>
                        @else
                            @if (count($misi->list))
                                @foreach ($misi->list as $key => $item)
                                    <div class="rmission d-flex align-items-center w-100 flex-stretch mb-3" id="rmission{{ $key+1 }}">
                                        <div class="p-4 row-number-mission-item">1.</div>
                                        <div class="w-100 me-3">
                                            <input type="text" name="misi_list_item[]" class="form-control w-100" value="{{ $item }}">
                                        </div>
                                        <div>
                                            <button type="button" class="remove-mission-item btn btn-danger" data-count="{{ $key+1 }}"><span class="d-flex align-items-center"><i class="bx bx-x"></i> Hapus</span></button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="rmission d-flex align-items-center w-100 flex-stretch mb-3" id="rmission1">
                                    <div class="p-4 row-number-mission-item">1.</div>
                                    <div class="w-100 me-3">
                                        <input type="text" name="misi_list_item[]" class="form-control w-100">
                                    </div>
                                    <div>
                                        <button type="button" class="remove-mission-item btn btn-danger" data-count="1"><span class="d-flex align-items-center"><i class="bx bx-x"></i> Hapus</span></button>
                                    </div>
                                </div>
                            @endif
                        @endif

                    </div>
                    <div>
                        <p id="errorMsg" class="text-center text-danger"></p>
                        <button type="button" class="btn btn-success ms-10" id="addMissionListItem"><i class="bx bx-plus"></i> Tambah</button>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="mb-5">
            <label for="" class="form-label fw-bold fs-3">HotLinks</label>
            <div id="contacts">
                @if (!$isEdit)
                    <div class="form-control d-flex contact" id="contact1">
                        <select name="contact_type[]" id="" class="form-control w-25">
                            <option value="instagram">Instagram</option>
                            <option value="email">Email</option>
                            <option value="facebook">Facebook</option>
                            <option value="whatsapp">Whatsapp</option>
                            <option value="twitter">Twitter</option>
                            <option value="tik-tok">Tik tok</option>
                        </select>
                        <input type="text" class="form-control" name="contacts[]">
                        <button type="button" class="btn btn-danger m-1 p-3 remove-contact" title="Hapus Contact" data-num="1"><i class="bx bx-x fs-3 m-2"></i></button>
                    </div>
                @else
                    @if (count($contacts))
                        @foreach ($contacts as $k => $contact)
                            <div class="form-control d-flex contact" id="contact{{ $k+1}}">
                                <select name="contact_type[]" id="" class="form-control w-25">
                                    <option {{ $contact->type === 'instagram'? 'selected': '' }} value="instagram">Instagram</option>
                                    <option {{ $contact->type === 'email'? 'selected': '' }} value="email">Email</option>
                                    <option {{ $contact->type === 'facebook'? 'selected': '' }} value="facebook">Facebook</option>
                                    <option {{ $contact->type === 'whatsapp'? 'selected': '' }} value="whatsapp">Whatsapp</option>
                                    <option {{ $contact->type === 'twitter'? 'selected': '' }} value="twitter">Twitter</option>
                                    <option {{ $contact->type === 'tik-tok'? 'selected': '' }} value="tik-tok">Tik tok</option>
                                </select>
                                <input type="text" class="form-control" name="contacts[]" value="{{ $contact->contact }}">
                                <button type="button" class="btn btn-danger m-1 p-3 remove-contact" title="Hapus Contact" data-num="{{ $k+1 }}"><i class="bx bx-x fs-3 m-2"></i></button>
                            </div>
                        @endforeach
                    @else

                    @endif
                @endif
            </div>
            <div>
                <p id="errorContactMsg" class="text-center text-danger"></p>
                <button type="button" class="btn btn-success ms-10" id="addContact"><i class="bx bx-plus"></i> Tambah Kontak</button>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <button type="submit" class="btn btn-primary">Simpan <i class="bx bx-save"></i></button>
    </div>
</div>
</form>

@endsection

@push('scripts')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('my-editor');
    </script>

@endpush
