@extends('layouts.argon-dashboard')

@section('title','Niket - Daftar Pengguna')
@section('subtitle','Daftar Pengguna')

@section('css')
<style>
    .table-responsive {
        min-height: 400px;
    }

    .bg-gradient-primary {
        background: linear-gradient(87deg, #45a6c5 0, #45a6c5 100%) !important;
    }
</style>
@endsection

@section('content')
<div class="row">
<div class="col">
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row">
            <div class="col-md-6">
                <h3 class="mb-0">Daftar Pengguna</h3>
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    <button class="btn btn-icon btn-3 btn-primary" type="button" onclick="window.location.href = '{{ url('user/add') }}';">
                        <span class="btn-inner--text">Tambah Pengguna</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        @if($msg = Session::get('success'))
            <div <div class="alert alert-secondary" role="alert">
                <strong>{{ $msg }}</strong>
            </div>
        @endif
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">No. HP</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $dt)
                <tr>
                    <th scope="row">
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ $dt->name }}</span>
                        </div>
                    </th>
                    <td>
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ $dt->email }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ $dt->role_name }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="media-body">
                            <span class="mb-0 text-sm">
                                @if($dt->gender == 'M')
                                    Laki-laki
                                @else
                                    Perempuan
                                @endif
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ $dt->phone }}</span>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="{{ url('user/edit/'.$dt->id) }}">Edit</a>
                            <a class="dropdown-item" href="#" onclick="showDeleteModal({{ $dt->id }},'{{ $dt->name }}')">Hapus</a>
                        </div>
                        </div>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @include('modules.user.modal')
    </div>
    <div class="card-footer py-4">
        {{ $data->links() }}
    </div>
    </div>
</div>
</div>
@endsection

@section('js')
<script>
    function showDeleteModal(id, name) {
        $('#modal-notification').modal('show');
        $('#modal_event_id').val(id);
        $('#warning_title').text('Kamu yakin hapus '+name+'?');
    }

    function deleteEvent() {
        var id = $('#modal_event_id').val();
        window.location.href = "{{ url('user/delete/') }}/"+id;
    }
</script>
@endsection
