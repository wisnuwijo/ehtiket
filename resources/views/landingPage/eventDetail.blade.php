@extends('layouts.event-detail')

@section('event-title', $event->event_name)
@section('event-host', $event->institution_name)
@section('event-createdAt', $event->created_at)
@section('event-info', $event->event_info)
@section('event-start', $event->event_start)
@section('event-finish', $event->event_finish)
@section('event-place', $event->event_place)
@section('event-host-address', $event->institution_address)

@section('event-ticket-class')
<div style="margin-top:30px">
    @for($i = 0; $i < count($ticketType); $i++)
        <button onclick="buyTicket('{{ $ticketType[$i]->name }}','{{ $ticketType[$i]->id }}')" class="btn btn-info">Beli {{ $ticketType[$i]->name }} Rp. {{ $ticketType[$i]->price }}</button>
    @endfor
</div>
@endsection

@section('js')
<script>
    function buyTicket(ticketType, ticketId) {
        $('#purchaseForm').removeAttr('hidden');
        $('#ticket_type_id').val(ticketId);
        $('#formTitle').text('Beli '+ticketType);
    }
</script>
@endsection
