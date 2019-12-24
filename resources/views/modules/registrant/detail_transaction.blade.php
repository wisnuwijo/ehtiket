@extends('layouts.argon-dashboard')

@section('title','Niket - Detail Transaksi')
@section('subtitle','Detail Transaksi')

@section('css')
<style>
    .table-responsive {
        min-height: 400px;
    }

    .bg-gradient-primary {
        background: linear-gradient(87deg, #45a6c5 0, #45a6c5 100%) !important;
    }

    .remove-bold {
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
        <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
                <a href="#">
                <img src="https://demos.creative-tim.com/argon-dashboard/assets/img/theme/team-4-800x800.jpg" class="rounded-circle">
                </a>
            </div>
            </div>
        </div>
        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4"></div>
        <div class="card-body pt-0 pt-md-4">
            <div class="row">
            <div class="col">
                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                <div>
                    <span class="heading">22</span>
                    <span class="description">Friends</span>
                </div>
                <div>
                    <span class="heading">10</span>
                    <span class="description">Photos</span>
                </div>
                <div>
                    <span class="heading">89</span>
                    <span class="description">Comments</span>
                </div>
                </div>
            </div>
            </div>
            <div class="text-center">
            <h3>
                Jessica Jones<span class="font-weight-light">, 27</span>
            </h3>
            <div class="h5 font-weight-300">
                <i class="ni location_pin mr-2"></i>Bucharest, Romania
            </div>
            <div class="h5 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
            </div>
            <div>
                <i class="ni education_hat mr-2"></i>University of Computer Science
            </div>
            <hr class="my-4">
            <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.</p>
            <a href="#">Show more</a>
            </div>
        </div>
        </div>
    </div>
    <div class="col-xl-8 order-xl-1">
        <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">Detail Transaksi</h3>
                @if ($data->paid >= $data->price)
                    <div class="text-green">
                        Pembayaran Lunas <i class="ni ni-check-bold"></i>
                    </div>
                @else
                    <div class="text-red">
                        Pembayaran Belum Lunas <i class="ni ni-fat-delete"></i>
                    </div>
                @endif
            </div>
            <div class="col-4 text-right">
                @if ($data->paid >= $data->price)
                    <? $trxId = encrypt($_GET['trx_id']); ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="{{ url('events/ticket/'.$trxId) }}" class="btn btn-sm btn-primary" target="_blank">Cetak Tiket</a>
                        </div>
                    </div>
                    <div class="row" style="margin-top:5px">
                        <div class="col-xs-12">
                            <a href="{{ url('events/ticket/'.$trxId) }}" class="btn btn-sm btn-primary" target="_blank">Kirim Tiket Via Email</a>
                        </div>
                    </div>
                @endif
            </div>
            </div>
        </div>
        <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Informasi Pembeli</h6>
            <div class="pl-lg-4">
                <div class="row">
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="input-username">Nama</label>
                    <input type="text" class="form-control form-control-alternative" value="{{ $data->user_name }}" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label" for="input-email">Email address</label>
                    <input type="text" class="form-control form-control-alternative" value="{{ $data->email }}" readonly>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="input-first-name">Jenis Kelamin</label>
                    <?php
                        $jenisKelamin = '';
                        if ($data->gender == 'M') {
                            $jenisKelamin = 'Laki-laki';
                        } else {
                            $jenisKelamin = 'Perempuan';
                        }
                    ?>

                    <input type="text" class="form-control form-control-alternative" value="{{ $jenisKelamin }}" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="input-last-name">Jenis Identitas</label>
                    <input type="text" class="form-control form-control-alternative" value="{{ $data->identifier_type }}" readonly>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Nomor HP</label>
                        <input type="text" class="form-control form-control-alternative" value="{{ $data->phone }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">Institusi Asal</label>
                        <input type="text" class="form-control form-control-alternative" value="{{ $data->institution_name }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <!-- Address -->
            <h6 class="heading-small text-muted mb-4">Informasi Transaksi</h6>
            <div class="pl-lg-4">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Nama Acara</label>
                    <input type="text" class="form-control form-control-alternative" value="{{ $data->institution_name }}" readonly>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-lg-4">
                    <div class="form-group focused">
                    <label class="form-control-label" for="input-city">Tanggal Mulai Acara</label>
                    <input type="text" class="form-control form-control-alternative" value="{{ $data->event_start }}" readonly>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group focused">
                    <label class="form-control-label" for="input-country">Tanggal Selesai Acara</label>
                    <input type="text" class="form-control form-control-alternative" value="{{ $data->event_finish }}" readonly>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                    <label class="form-control-label" for="input-country">Lokasi Acara</label>
                    <input type="text" class="form-control form-control-alternative" value="{{ $data->event_place }}" readonly>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-lg-4">
                    <div class="form-group focused">
                    <label class="form-control-label" for="input-city">Jenis Tiket Yang Dibeli</label>
                    <input type="text" class="form-control form-control-alternative" value="{{ $data->ticket_type_name }}" readonly>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group focused">
                    <label class="form-control-label" for="input-country">Harga Tiket</label>
                    <input type="text" class="form-control form-control-alternative" value="{{ $data->price }}" readonly>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                    <label class="form-control-label" for="input-country">Pembayaran</label>
                    <input type="text" class="form-control form-control-alternative" value="{{ $data->paid }}" readonly>
                    </div>
                </div>
                </div>
                @if($data->paid_evidence != null)
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label class="form-control-label" for="input-country">Bukti Pembayaran</label>
                        <img src="{{ url('storage/app/'.$data->paid_evidence) }}" alt="">
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
