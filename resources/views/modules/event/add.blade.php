@extends('layouts.argon-dashboard')

@section('title','Niket - Tambah Acara')
@section('subtitle','Tambah Acara')

@section('content')
<div class="row">
<div class="col">
    <div class="card shadow">
    <div class="card-header border-0">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-0">Tambah Acara</h3>
            </div>
            <div class="col-md-6">
                <div class="float-right">

                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ url('events/add') }}" method='POST'>
        @csrf
        <h6 class="heading-small text-muted mb-4">Informasi Acara</h6>
        <div class="pl-lg-4">
            <div class="row">
            <div class="col-lg-6">
                <div class="form-group focused">
                <label class="form-control-label" for="event_name">Nama Acara</label>
                <input type="text" id="event_name" class="form-control form-control-alternative" name="event_name" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                <label class="form-control-label" for="event_date">Tanggal Acara</label>
                <input type="date" id="event_date" class="form-control form-control-alternative" name="event_date" required>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="event_finish">Tanggal Berakhir Acara</label>
                    <input type="date" id="event_finish" class="form-control form-control-alternative" name="event_finish" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="event_place">Tempat</label>
                    <input type="text" id="event_place" class="form-control form-control-alternative" name="event_place" required>
                    </div>
                </div>
            </div>
            <div class="form-group focused">
            <label>Keterangan</label>
            <textarea rows="4" class="form-control form-control-alternative" name="event_info"></textarea>
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
