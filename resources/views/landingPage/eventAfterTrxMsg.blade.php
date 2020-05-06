@extends('layouts.plain-layout')

@section('plain-content')
<div class="card w-100" style="width: 18rem;margin-top: 50px">
  <div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <img class="card-img-top" style="width: 100%" src="{{ asset('public/asset/img/undraw_relaxation_1_wbr7.svg') }}" alt="Card image cap">
        </div>
        <div class="col-md-8">
            <h5 class="card-title">Siiip👍🏻 Pendaftaran selesai</h5>
            <p class="card-text">Kamu sekarang bisa santai sejenak menunggu acaranya dimulai. Sebagai informasi Meetevent sudah mengirim email detail acara ke email kamu</p>
            <a href="{{ url('user-event/event') }}/{{ $event->event_slug }}?user={{ Auth::user()->id }}" class="btn btn-default">Lihat Transaksi</a>
            <a href="{{ url('eventlist') }}" class="btn btn-default">Kembali</a>
        </div>
    </div>
  </div>
</div>
@endsection
