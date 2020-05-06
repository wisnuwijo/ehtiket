@extends('layouts.argon-dashboard')

@section('title','Niket - Acara')
@section('subtitle','Acara')

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
                <h3 class="mb-0">Daftar Acara</h3>
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    <button class="btn btn-icon btn-3 btn-primary" type="button" onclick="window.location.href = '{{ url('events/add') }}';">
                        <span class="btn-inner--text">Tambah Acara</span>
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
                <th scope="col">Nama Acara</th>
                <th scope="col">Mulai</th>
                <th scope="col">Selesai</th>
                <th scope="col">Tempat</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $ev)
                <tr>
                    <th scope="row">
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ $ev->event_name }}</span>
                        </div>
                    </th>
                    <td>
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ formatDate($ev->event_start) }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ formatDate($ev->event_finish) }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ $ev->event_place }}</span>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="{{ url('events/detail/'.$ev->id) }}">Tampilkan Detail</a>
                            <a class="dropdown-item" href="{{ url('events/create_ticket?event_id='.$ev->id) }}">Buat Tiket</a>
                            <a class="dropdown-item" href="{{ url('events/edit/'.$ev->id) }}">Edit</a>
                            <a class="dropdown-item" href="#" onclick="showDeleteModal({{ $ev->id }})">Hapus</a>
                        </div>
                        </div>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @include('modules.event.modal')
    </div>
    <div class="card-footer py-4">
        {{ $events->links() }}
    </div>
    </div>
</div>
</div>
@endsection

@section('js')
<script>
    function showDeleteModal(id) {
        console.log('isi id => '+id);
        $('#modal-notification').modal('show');
        $('#modal_event_id').val(id);
    }

    function deleteEvent() {
        var id = $('#modal_event_id').val();
        window.location.href = "{{ url('events/delete') }}/"+id;
    }
</script>
@endsection
