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
@if($event->event_category == 2)
    <!-- for competition onlye -->
    @include('modules.registrant.include.detail_trx_competition')
@else
    @include('modules.registrant.include.detail_trx_non_competition')
@endif
@endsection
