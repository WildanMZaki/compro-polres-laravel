@extends('admin-layouts.master')

@section('content')

<!--begin::Page Vendor Stylesheets(used by this page)-->
<link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Page Vendor Stylesheets-->


<main class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-5">
                    <h2>Daftar Administrator</h2>
                    <div class="row mb-4">
                        <div class="d-flex justify-content-end col-12">
                            <button class="btn btn-success" data-kt-menu-dismiss="true" data-bs-toggle="modal" data-bs-target="#form_modal">
                                <i class="bx bx-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                    <table id="adminTable" class="table border text-center table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Edit</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($administrators as $i => $admin)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td id="admin_name_{{ $admin->id }}">{{ $admin->name }}</td>
                                    <td id="admin_email_{{ $admin->id }}">{{ $admin->email }}</td>
                                    <td id="admin_telepon_number_{{ $admin->id }}">{{ $admin->telepon_number }}</td>
                                    <td>
                                        <button class="btn btn-secondary text-center p-3" data-kt-menu-dismiss="true" data-bs-toggle="modal" data-bs-target="#update_modal" data-id="{{ $admin->id }}"  data-token="{{ csrf_token() }}">
                                            <i class="bx bx-edit fs-4"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger text-center p-3" data-kt-menu-dismiss="true" data-bs-toggle="modal" data-bs-target="#confirm_delete" data-id="{{ $admin->id }}" data-name="{{ $admin->name }}" {{ count($administrators) === 1? 'disabled': ''}}>
                                            <i class="bx bx-x fs-4 p-0 m-0"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

@if (\Session::has('progress_error'))
    <div id="progress_error" data-error="{!! \Session::get('progress_error') !!}"></div>
    @if (\Session::has('data_error'))
        <div id="data_error" data-error="{!! \Session::get('data_error') !!}"></div>
    @endif
@endif
@if (\Session::has('progress_success'))
    <div id="progress_success" data-error="{!! \Session::get('progress_success') !!}"></div>
@endif

<div class="modal fade" tabIndex={-1} id="confirm_delete" data-route="{{ route('hapus-akun', '#') }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apakah kamu yakin ingin menghapus admin "<span id="admin_name"></span>"</h5>
          <div
            class="btn btn-icon btn-sm btn-active-light-primary ms-2"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
          </div>
        </div>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Tidak
          </button>
          <form action="" method="post" id="deleteBeritaForm">
              @csrf @method('delete')
              <button type="submit" class="btn btn-danger">
                Ya, hapus
              </button>
          </form>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" tabIndex={-1} id="form_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('simpan-akun') }}" method="post" id="form_account">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambahkan administrator baru</h5>
          <div
            class="btn btn-icon btn-sm btn-active-light-primary ms-2"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
          </div>
        </div>

        <div class="modal-body">
            <input type="hidden" name="role" value="admin">
            <div class="form-floating mb-4">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Tuliskan nama anda" value="{{ old('name') }}">
                <label for="name">Nama</label>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-4">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                <label for="email">Email</label>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-4">
                <input type="number" class="form-control @error('telepon_number') is-invalid @enderror" id="no_telepon" name="telepon_number" placeholder="6281234567890" value="{{ old('telepon_number') }}">
                <label for="no_telepon">No. telepon</label>

                @error('telepon_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="pwd" name="password" placeholder="Password">
                <label for="pwd">Password</label>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="confirm_pwd" name="password_confirmation" placeholder="Konfirmasi Password">
                <label for="confirm_pwd">Konfirmasi Password</label>
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak jadi</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" tabIndex={-1} id="update_modal" data-route="{{ route('update-akun', '#') }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('update-akun', '#') }}" method="post" id="form_update">
        @csrf @method('patch')
        <input type="hidden" name="token" value="" id="tokenInput">
        <div class="modal-header">
          <h5 class="modal-title">Perbarui administrator "<span id="adminName"></span>"</h5>
          <div
            class="btn btn-icon btn-sm btn-active-light-primary ms-2"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
          </div>
        </div>

        <div class="modal-body">
            <div class="form-floating mb-4">
                <input type="text" class="form-control" id="name_update" name="name_update" placeholder="Tuliskan nama anda" value="{{ old('name_update') }}">
                <label for="name_update">Nama</label>

                <span class="invalid-feedback" role="alert" id="name_update_errors">

                </span>
            </div>
            <div class="form-floating mb-4">
                <input type="email" class="form-control" id="email_update" name="email_update" placeholder="name@example.com" value="{{ old('email_update') }}">
                <label for="email_update">Email</label>

                <span class="invalid-feedback" role="alert" id="email_update_errors">

                </span>
            </div>
            <div class="form-floating mb-4">
                <input type="number" class="form-control" id="telepon_number_update" name="telepon_number_update" placeholder="6281234567890" value="{{ old('telepon_number_update') }}">
                <label for="telepon_number_update">No. telepon</label>

                <span class="invalid-feedback" role="alert" id="telepon_number_update_errors">

                </span>
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak jadi</button>
          <button type="submit" class="btn btn-primary" id="submit_update">Perbarui</button>
        </div>
        </form>
      </div>
    </div>
</div>



@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $('#confirm_delete').on('show.bs.modal', e => {
        const data = e.relatedTarget.dataset;
        $('#admin_name').html(data.name);
        $('#deleteBeritaForm').attr('action', (e.target.dataset.route).replace('#', data.id));
    });

    $('#update_modal').on('show.bs.modal', e => {
        const data = e.relatedTarget.dataset;
        $('#adminName').html($(`#admin_name_${data.id}`).html());
        $('#tokenInput').val(data.token);
        $('#name_update').val($(`#admin_name_${data.id}`).html());
        $('#email_update').val($(`#admin_email_${data.id}`).html());
        $('#telepon_number_update').val($(`#admin_telepon_number_${data.id}`).html());
        $('#form_update').attr('action', (e.target.dataset.route).replace('#', data.id));
    });
    $('#update_modal').on('hidden.bs.modal', e => {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').html('');
    });

    function sendReq(url, method, token, data, success_cb, error_cb) {
        $.ajax({
            url: url,
            type: method,
            headers: {'X-CSRF-TOKEN': token},
            data: data,
            dataType: 'JSON',
            success: function (data) {
                // console.log(data);
                success_cb(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                error_cb(jqXHR, textStatus, errorThrown);
            },
        });
    }

    function err(p1, p2, p3) {
        console.log(p1);
        console.log(p2);
        console.log(p3);
    }

    $('#submit_update').click(e => {
        e.preventDefault();
        sendReq(
            $('#form_update').attr('action'),
            'PATCH',
            $('#tokenInput').val(),
            $('#form_update').serialize(),
            data => {
                console.log(data);
                $('#update_modal').modal('hide');
                toastr.success(`Admin ${data.admin_name} berhasil diperbarui`);
                $(`#admin_name_${data.id}`).html(data.admin_name);
                $(`#admin_email_${data.id}`).html(data.admin_email);
                $(`#admin_telepon_number_${data.id}`).html(data.admin_telepon_number);

                // Antisipasi ketika admin sedang aktif maka akan mengupdate user di sidebar juga
                if (data.is_online) {
                    $('.admin_active_name').html(data.admin_name);
                    $('.admin_active_email').html(data.admin_email);
                }
            },
            (jqXHR, textStatus, errorThrown) => {
                const errors = jqXHR.responseJSON.errors;
                for (const error in errors) {
                    const element = errors[error];
                    $(`#${error}`).addClass('is-invalid');
                    element.forEach(msg => {
                        $(`#${error}_errors`).append(`
                            <strong>${msg}</strong><br />
                        `);
                    });
                }
            }
        );
    });
</script>
<script>
    "use strict";

    // Class definition
    var KTDatatableDemo = function () {

        // Public methods
        return {
            init: function () {
            }
        }
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTDatatableDemo.init();
    });
    $(document).ready(function(){
        $('#adminTable').DataTable();
    });

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    document.addEventListener('DOMContentLoaded', () => {
        const progress_error = $('#progress_error').attr('data-error');
        const progress_success = $('#progress_success').attr('data-error');
        if (progress_error === 'create') {
            $('#form_modal').modal('show');
        }
        if (progress_success === 'create') {
            toastr.success("Admin baru telah ditambahkan");
        }
    });
</script>
@endpush
