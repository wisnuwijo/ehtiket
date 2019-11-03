@extends('layouts.argon-dashboard')

@section('title','Niket - Buat Tiket')
@section('subtitle','Buat Tiket')

@section('content')
<div class="row">
<div class="col">
    <div class="card shadow">
    <div class="card-header border-0">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-0">Buat Tiket</h3>
            </div>
            <div class="col-md-6">
                <div class="float-right">

                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ url('events/create_ticket') }}" method='POST'>
        @csrf
        <h6 class="heading-small text-muted mb-4">Informasi Tiket</h6>
        <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="name">Nama Tiket</label>
                    <input type="text" id="name" class="form-control form-control-alternative" name="name" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="price">Harga Tiket</label>
                    <input type="number" id="price" class="form-control form-control-alternative" name="price" required>
                    <input type="hidden" id="event_id" class="form-control form-control-alternative" name="event_id" value="{{ Request::get('event_id') }}">
                    </div>
                </div>
            </div>
            <div class="form-group focused">
            <label>Keterangan</label>
            <textarea rows="4" class="form-control form-control-alternative" name="info"></textarea>
            </div>
            <button class="btn btn-icon btn-3 btn-primary" type="submit">
                <span class="btn-inner--text">Simpan</span>
            </button>
        </div>
        </form>
    </div>
    <div class="card-footer py-4"></div>
    </div>
</div>
</div>
@endsection
