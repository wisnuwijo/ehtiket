@extends('layouts.argon-dashboard')

@section('title','Niket - Detail Acara')
@section('subtitle','Detail Acara')

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
                        {{ $event->institution_name }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Tanggal Mulai</label><br>
                        {{ $event->event_start }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Tanggal Selesai</label><br>
                        {{ $event->event_finish }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Kategori Acara</label><br>
                        {{ $event->event_category }}
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
                        <label class="form-control-label" for="event_name">Lampiran File</label><br>
                        {{ asset($event->attachments) }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Tanggal Pembuatan Acara</label><br>
                        {{ $event->created_at }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Jumlah Maksimal Tiket Per Transaksi</label><br>
                        {{ $event->max_ticket_per_transaction }} tiket
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Jenis Peserta</label><br>
                        @if($event->participant_type == 'team')
                            Kelompok
                        @elseif($event->participant_type == 'individu')
                            Individu
                        @else
                            Kelompok & Individu
                        @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Jumlah Minimal Anggota Kelompok</label><br>
                        {{ $event->min_team_member }} orang
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Jumlah Minimal Anggota Kelompok</label><br>
                        {{ $event->max_team_member }} orang
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Penunjukkan ketua kelompok</label><br>
                        @if($event->point_team_lead == 1)
                            Wajib
                        @else
                            Tidak Wajib
                        @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="event_name">Biaya Pendaftaran</label><br>
                        {{ $event->registration_cost }}
                        </div>
                    </div>
                </div>
                <h6 class="heading-small text-muted mb-4">Form Registrasi</h6>
                <div class="row">
                    @if(count($regForm) > 0)
                        @foreach($regForm as $rf)
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label class="form-control-label" for="{{ $rf->name }}">{{ $rf->name }}</label><br>
                                <input type="{{ $rf->type }}" class="form-control form-control-alternative" name="{{ $rf->name }}" {{ $rf->required == '1' ? 'required' : '' }}>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <h6 class="heading-small text-muted mb-4">Daftar Tiket</h6>
                @if(count($ticket) == '0')
                    <h6 class="form-control-label mb-3">Belum ada tiket yang dibuat</h6>
                @endif
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
        <div class="card shadow" style="margin-top:20px">
            <div class="card-header border-0">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="mb-0">Peta</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="float-right">

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <iframe src="https://maps.google.com/maps?q={{ $event->event_latitude }},{{ $event->event_longitude }}&hl=id&z=18&amp;output=embed" frameborder="0" style="width:100%;height:400px"></iframe>
            </div>
        </div>
    </div>
    <div class="col-xl-4 order-xl-2">
        <div class="card card-profile">
            <img src="{{ asset($event->event_background) }}" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                    <a href="#">
                    <img src="{{ asset($event->event_logo) }}" class="rounded-circle" style="width:200%">
                    </a>
                </div>
                </div>
            </div>
            <div class="card-body pt-0" style="margin-top:120px">
                <div class="text-center">
                    <h5 class="h3">
                        {{ $event->event_name }}
                    </h5>
                    <div class="h5 font-weight-300">
                        <i class="ni location_pin mr-2"></i>{{ $event->event_place }}, {{ $event->event_start }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
