@extends('layouts.argon-dashboard')

@section('title','Niket - Daftar Pendaftar')
@section('subtitle','Daftar Pendaftar')

@section('content')
<div class="row">
<div class="col">
    <div class="card shadow">
    <div class="card-header border-0">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-0">Daftar Pendaftar</h3>
            </div>
            <div class="col-md-6">
                <div class="float-right">

                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                <th scope="col">Nama Acara</th>
                <th scope="col">Mulai</th>
                <th scope="col">Selesai</th>
                <th scope="col">Tempat</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr>
                    <th scope="row">
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ $d->event_name }}</span>
                        </div>
                    </th>
                    <td>
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ $d->event_start }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ $d->event_finish }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ $d->event_place }}</span>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="{{ url('events/detail/'.$d->id) }}">Tampilkan Detail</a>
                            <a class="dropdown-item" href="{{ url('events/create_ticket?event_id='.$d->id) }}">Buat Tiket</a>
                            <a class="dropdown-item" href="{{ url('events/edit/'.$d->id) }}">Edit</a>
                            <a class="dropdown-item" href="#" onclick="showDeleteModal({{ $d->id }})">Hapus</a>
                        </div>
                        </div>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer py-4"></div>
    </div>
</div>
</div>
@endsection
