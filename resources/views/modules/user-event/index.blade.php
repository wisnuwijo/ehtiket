@extends('layouts.argon-dashboard')

@section('title','Niket - Daftar Acara')
@section('subtitle','Daftar Acara')

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
            <div class="col-md-12">
                <h3 class="mb-0">Daftar Acara</h3>
                <p>Lihat daftar acara yang kamu ikuti</p>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        @if($msg = Session::get('success'))
            <div <div class="alert alert-secondary" role="alert">
                <strong>{{ $msg }}</strong>
            </div>
        @endif
        @if(count($events) > 0)
            @foreach($events as $ev)
                <div class="card w-100" style="width: 18rem;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset($ev->event->event_logo) }}" width="100%" alt="">
                            </div>
                            <div class="col-md-10">
                                <h4 class="card-title">{{ $ev->event->event_name }}</h4>
                                <p class="card-text" style="font-size:15px">
                                    {{ formatDate($ev->event->event_date) }} <br>
                                    {{ $ev->event->event_info }}
                                </p>
                                <a href="{{ url('user-event/event') }}/{{ $ev->event->event_slug }}?user={{ Auth::user()->id }}" class="btn btn-primary">Lihat Acara</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="card-footer py-4">
        {{ $events->links() }}
    </div>
    </div>
</div>
</div>
@endsection
