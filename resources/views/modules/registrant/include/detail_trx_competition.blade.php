<div class="row">
    <div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">Detail Transaksi</h3>
                <div class="text-green">
                    Pembayaran Lunas <i class="ni ni-check-bold"></i>
                </div>
                <div class="text-red">
                    Pembayaran Belum Lunas <i class="ni ni-fat-delete"></i>
                </div>
            </div>
            <div class="col-4 text-right">
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
            </div>
            </div>
        </div>
        <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Informasi Lomba</h6>
            <div class="pl-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Nama Lomba</label>
                        <input type="text" class="form-control form-control-alternative" value="{{ $event->event_name }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Jenis Peserta</label>
                        <input type="text" class="form-control form-control-alternative" value="{{ $event->participant_type }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Maksimal Tiket Per Transaksi</label>
                        <input type="text" class="form-control form-control-alternative" value="{{ $event->max_ticket_per_transaction }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Biaya Pendaftaran</label>
                        <input type="text" class="form-control form-control-alternative" value="{{ $event->registration_cost }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Anggota Minimal Kelompok</label>
                        <input type="text" class="form-control form-control-alternative" value="{{ $event->min_team_member }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Anggota Maksimal Kelompok</label>
                        <input type="text" class="form-control form-control-alternative" value="{{ $event->max_team_member }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <!-- Address -->
            <h6 class="heading-small text-muted mb-4">Informasi Peserta</h6>
            <div class="pl-lg-4">
                <div class="row">
                    @for($i=0;$i < count($data);$i++)
                        <div class="col-md-6">
                            <div class="form-group focused">
                            <label class="form-control-label" for="input-address">{{ $data[$i]->name }}</label>
                            <input type="text" class="form-control form-control-alternative" value="{{ $data[$i]->data }}" readonly>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label class="form-control-label" for="input-country">Bukti Pembayaran</label>
                        <img src="#" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
