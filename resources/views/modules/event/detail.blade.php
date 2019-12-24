@extends('layouts.argon-dashboard')

@section('title','Niket - Detail Acara')
@section('subtitle','Detail Acara')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
        <div class="card-header border-0">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mb-0">Detail Acara</h3>
                </div>
                <div class="col-md-6">
                    <div class="float-right">

                    </div>
                </div>
            </div>
        </div>
            <div class="card-body">
                <h6 class="heading-small text-muted mb-1">Nama Acara</h6>
                <h6 class="form-control-label mb-3">{{ $event->event_name }}</h6>

                <h6 class="heading-small text-muted mb-1">Tempat, tanggal</h6>
                <h6 class="form-control-label mb-3">{{ $event->event_place.', '.$event->event_date }}</h6>

                <h6 class="heading-small text-muted mb-1">Tanggal selesai</h6>
                <h6 class="form-control-label mb-3">{{ $event->event_finish }}</h6>

                <h6 class="heading-small text-muted mb-1">Keterangan</h6>
                <h6 class="form-control-label mb-3">{{ $event->event_info }}</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow">
        <div class="card-header border-0">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="mb-0">Tiket Acara</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            @foreach ($ticket as $tk)
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="form-control-label mb-3">{{ $tk->name }}</h6>
                    </div>
                    <div class="col-md-6">
                        <h6 class="form-control-label mb-3">Rp. {{ $tk->price }}</h6>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
