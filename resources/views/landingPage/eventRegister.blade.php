@extends('layouts.plain-layout')

@section('plain-content')

<?php
    $form = json_decode($event->registration_form);
    $enctype = '';
    foreach ($form as $i) {
        if ($i->type == 'file') {
            $enctype = 'enctype="multipart/form-data"';
        }
    }
?>

<form action="{{ url('event/register') }}" method="POST" class="bg-white" style="margin-top: 100px" id="purchaseForm" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="event_id" value="{{ $event->id }}">
    <input type="hidden" name="event_category_id" value="{{ $event->eventCategoryId }}">
    <input type="hidden" name="event_category" value="{{ $event->event_category }}">
    <input type="hidden" name="ticket_type" value="{{ $_GET['ticketType'] }}">
    <h2 class="font-weight-light text-primary" id="formTitle">Registrasi</h2>
    <div class="row form-group">
        @foreach($form as $fm)
            <?php
                $req = '';
                if ($fm->required == 1) {
                    $req = 'required';
                }
            ?>

            <div class="col-md-6 mb-3 mb-md-0" style="padding-top: 10px;">
                <label class="text-black" for="{{ $fm->id }}">{{ $fm->name }}</label>
                @if($fm->type != 'drop-down')
                    <input type="{{ $fm->type }}" id="{{ $fm->id }}" name="{{ $fm->id }}" class="form-control" {{ $req }}>
                @else
                    <select name="{{ $fm->id }}" id="{{ $fm->id }}" class="form-control" {{ $req }}>
                        @foreach($fm->values as $vl)
                            <option value="{{ $vl }}">{{ $vl }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
        @endforeach
    </div>
    <div class="row form-group">
        <div class="col-md-12">
            <input type="submit" value="Lanjutkan" class="btn btn-primary btn-md text-white">
        </div>
    </div>
</form>
@endsection
