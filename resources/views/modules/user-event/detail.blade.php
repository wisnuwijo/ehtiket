@extends('layouts.argon-dashboard')

@section('title','Niket - Detail Acara')
@section('subtitle','Detail Acara')

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
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4">Acara</h6>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Nama Acara</label><br>
                        {{ $event->event_name }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Penyelenggara Acara</label><br>
                        {{ $event->institution->institution_name }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Lokasi Acara</label><br>
                        {{ $event->event_place }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Tanggal Mulai</label><br>
                        {{ formatDate($event->event_start) }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Tanggal Selesai</label><br>
                        {{ formatDate($event->event_finish) }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Kategori Acara</label><br>
                        {{ $event->eventcategory->event_category }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Jenis Acara</label><br>
                        {{ $event->event_subscription }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="event_name">Deskrisi Acara</label><br>
                            {{ $event->event_info }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow" style="margin-top:20px">
            <div class="card-header border-0">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="heading-small text-muted mb-4">Peta Lokasi Acara</h6>
                    </div>
                    <div class="col-md-6">
                        <div class="float-right">

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <iframe src="https://maps.google.com/maps?q={{ $event->event_latitude }},{{ $event->event_longitude }}&amp;hl=id&amp;z=18&amp;output=embed" frameborder="0" style="width:100%;height:400px"></iframe>
            </div>
        </div>
    </div>
    @if($event->event_subscription != 'free' && $event->event_category != 2)
        <div class="col-xl-4 order-xl-2">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                            <h6 class="heading-small text-muted mb-4">Pembelian Tiket</h6>
                                @foreach($trx as $t)
                                    <div class="card">
                                        <h5 class="card-title">{{ $t->tickettype->name }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Rp. {{ $t->tickettype->price }}. Tanggal pesan : {{ formatDate($t->created_at) }}</h6>
                                        <p class="card-text">{{ $t->tickettype->info }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
