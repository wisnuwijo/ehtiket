<div class="row">
    <div class="col-xl-12 order-xl-1">
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
