@extends('layouts.argon-dashboard')

@section('title','Niket - Daftar Pendaftar')
@section('subtitle','Daftar Pendaftar')

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
    @foreach($events as $event)
        <div class="col-md-4">
            <div class="card">
                <!-- <img class="card-img-top" src="https://demos.creative-tim.com/argon-dashboard/assets/img/theme/team-1-800x800.jpg" alt="Card image cap"> -->
                <div class="card-body">
                    <h4 class="card-title">{{$event->event_name }}</h4>
                    <h5 class="remove-bold">
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fas fa-map-marker-alt"></i> {{ $event->event_place }} <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fas fa-map-marker-alt"></i> {{ $event->registrant_qty }} pendaftar<br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fas fa-calendar-alt"></i> {{ $event->event_start }} <br>
                            </div>
                        </div>
                    </h5>
                    <p class="card-text">{{ $event->event_info }}</p>
                    <a href="{{ url('registrant/list') }}/{{ $event->id }}" class="btn btn-primary">Rincian Pendaftar</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
