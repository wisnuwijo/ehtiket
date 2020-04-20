@extends('layouts.event-detail')

@section('custom-css')
    <style>
        @if($event->event_background != null && $event->event_background != '')
            .site-blocks-cover {
                background: url('{{ url($event->event_background) }}');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: top;
                background-position: center center;
            }
        @endif
    </style>
@endsection

@section('event-title', $event->event_name)
@section('event-host', $event->institution_name)
@section('event-createdAt', $event->created_at)

@section('event-ticket-class')
<div style="margin-top:30px">
    @if($event->event_category == '1' && $event->event_subscription == 'paid')
        @for($i = 0; $i < count($ticketType); $i++)
            <a href="{{ url('join') }}/{{ $event->event_slug }}?ticketType={{ $ticketType[$i]->id }}" style="margin-bottom:10px" class="btn btn-primary">Beli {{ $ticketType[$i]->name }} Rp. {{ $ticketType[$i]->price }}</a>
        @endfor
    @else
        <a href="{{ url('register') }}/{{ $event->event_slug }}" class="btn btn-primary">Daftar</a>
    @endif
</div>
@endsection

@section('js')
<script>
    $(function() {
        console.log("ready");
        console.log("{{ Auth::check() }}");
    });
</script>
@endsection
