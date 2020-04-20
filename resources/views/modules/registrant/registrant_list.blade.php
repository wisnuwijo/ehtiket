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
<div class="col">
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row">
            <div class="col-md-12">
                <h3 class="mb-0">Daftar Pendaftar ({{ count($events) }})</h3>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        @if($msg = Session::get('success'))
            <div <div class="alert alert-secondary" role="alert">
                <strong>{{ $msg }}</strong>
            </div>
        @endif

        @if($event_category == 2)
            <!-- event category => LOMBA -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        @foreach($columns as $col)
                            <th scope="col">{{ $col }}</th>
                        @endforeach
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($events) > 0 && $events[0] != null)
                        @foreach($events as $dt)
                        <tr>
                            <?php $decodeForm = json_decode($dt->custom_form_value); ?>
                            @for($df = 0; $df < count($decodeForm); $df++)
                                <th scope="row">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">{{ $decodeForm[$df]->data }}</span>
                                    </div>
                                </th>
                            @endfor
                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="{{ url('registrant/detail_transaction?trx_id='.$dt->id) }}">Detail Transaksi</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                <div class="media-body">
                                    <span class="mb-0 text-sm">
                                        <center>Pendaftar kosong</center>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @else
            <!-- other event except lomba -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">Nama Pendaftar</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Tanda Pengenal</th>
                    <th scope="col">Jenis Tiket</th>
                    <th scope="col">Pembayaran</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @if(count($events) > 0 && $events[0] != null)
                    @foreach($events as $ev)
                    <tr>
                        <th scope="row">
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{ $ev->name }}</span>
                            </div>
                        </th>
                        <td>
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{ $ev->email }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{ $ev->phone }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{ $ev->identifier_type }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{ $ev->ticket_name }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="media-body">
                                <?php
                                    $paymentStatus = 'Belum Lunas';
                                    if ($ev->paid >= $ev->ticket_price) {
                                        $paymentStatus = 'Lunas';
                                    }
                                ?>
                                <span class="mb-0 text-sm">
                                    @if($paymentStatus == 'Lunas')
                                        <p style="color:green;font-weight:bold">Rp.{{ $ev->paid }} {{ $paymentStatus }}</p>
                                    @else
                                        <p style="color:red;font-weight:bold">Rp.{{ $ev->paid }} {{ $paymentStatus }}</p>
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td class="text-right">
                            <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                @if($paymentStatus == 'Belum Lunas')
                                    <a class="dropdown-item" onclick=showConfirmPaymentModal({{ $ev->trx_id }})>Konfirmasi Pembayaran</a>
                                @endif
                                <a class="dropdown-item" href="{{ url('registrant/detail_transaction?trx_id='.$ev->trx_id) }}">Detail Transaksi</a>
                            </div>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">
                            <div class="media-body">
                                <span class="mb-0 text-sm">
                                    <center>Pendaftar kosong</center>
                                </span>
                            </div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        @endif
    </div>
    <div class="card-footer py-4"></div>
    </div>
</div>
</div>
@include('modules.registrant.modal')
@endsection

@section('js')
<script>
    function showConfirmPaymentModal(id) {
        console.log('isi id => '+id);
        $('#confirm_payment').modal('show');
        $('#transaction_id').val(id);
    }

    function deleteEvent() {
        var id = $('#modal_event_id').val();
        window.location.href = "{{ url('events/delete') }}/"+id;
    }
</script>
@endsection
