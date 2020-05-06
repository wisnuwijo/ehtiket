@extends('layouts.argon-dashboard')

@section('title','Niket - Tambah Acara')
@section('subtitle','Tambah Acara')

@section('content')
<div class="row">
<div class="col">
    <div class="card shadow">
    <div class="card-header border-0">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-0">Tambah Acara</h3>
            </div>
            <div class="col-md-6">
                <div class="float-right">

                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ url('events/add') }}" method='POST' enctype="multipart/form-data">
        @csrf
        <h6 class="heading-small text-muted mb-4">Informasi Acara</h6>
        <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="event_name">Nama Acara</label>
                    <input type="text" id="event_name" class="form-control form-control-alternative" name="event_name" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label" for="event_category">Kategori Acara</label>
                    <select name="event_category" class="form-control form-control-alternative" required>
                        <option value="">Pilih Kategori Acara</option>
                        @foreach($category as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->event_category }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="event_date">Tanggal & Waktu Mulai Acara</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="date" id="event_date" class="form-control form-control-alternative" name="event_date" required>
                            </div>
                            <div class="col-md-6">
                            <input type="time" id="event_start_time" class="form-control form-control-alternative" name="event_start_time" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="event_finish">Tanggal & Waktu Akhir Acara</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="date" id="event_finish" class="form-control form-control-alternative" name="event_finish" required>
                            </div>
                            <div class="col-md-6">
                            <input type="time" id="event_finish_time" class="form-control form-control-alternative" name="event_finish_time" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label" for="event_subscription">Jenis Acara</label>
                    <select name="event_subscription" id="subs_type" class="form-control form-control-alternative" required>
                        <option value="">Pilih Jenis Acara</option>
                        <option value="free">Gratis</option>
                        <option value="paid">Berbayar</option>
                    </select>
                    </div>
                </div>
            </div>
            <div id="payment_title" hidden>
                <hr width="100%" height="10px">
                <h6 class="heading-small text-muted mb-4">Informasi Pembayaran</h6>
            </div>
            <div class="row">
                <div class="col-lg-6" id="select_bank" hidden>
                    <div class="form-group">
                    <label class="form-control-label" for="select_bank_form">Pilih Bank</label>
                    <select name="event_bank_name" class="form-control form-control-alternative" id="select_bank_form" required>
                        <option value="">Pilih Bank</option>
                        <option value="BCA">BCA</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="BRI">BRI</option>
                        <option value="BNI">BNI</option>
                        <option value="CIMB Niaga">CIMB Niaga</option>
                        <option value="BTN">BTN</option>
                        <option value="Bank Mega">Bank Mega</option>
                    </select>
                    </div>
                </div>
                <div class="col-lg-6" id="bank_account_owner_name" hidden>
                    <div class="form-group focused">
                    <label class="form-control-label" for="bank_account_owner_name_form">Nama Pemilik Rekening</label>
                    <input type="text" id="bank_account_owner_name_form" class="form-control form-control-alternative" name="event_bank_owner" required>
                    </div>
                </div>
                <div class="col-lg-6" id="bank_account" hidden>
                    <div class="form-group focused">
                    <label class="form-control-label" for="bank_account_form">Nomor Rekening</label>
                    <input type="number" id="bank_account_form" class="form-control form-control-alternative" name="event_bank_number" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="event_logo">Logo Acara</label>
                        <input type="file" id="event_logo" class="form-control form-control-alternative" name="event_logo" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="event_background">Latar Belakang Acara</label>
                        <input type="file" id="event_background" class="form-control form-control-alternative" name="event_background" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="attachment">Lampiran Berkas</label>
                        <input type="file" id="attachment" class="form-control form-control-alternative" name="attachment" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="event_place">Tempat</label>
                    <input type="text" id="event_place" class="form-control form-control-alternative" name="event_place" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="event_latitude">Latitude</label>
                    <input type="number" step="any" id="event_latitude" class="form-control form-control-alternative" name="event_latitude">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="event_longitude">Longitude</label>
                    <input type="number" step="any" id="event_longitude" class="form-control form-control-alternative" name="event_longitude">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group focused">
                    <label class="form-control-label" for="event_slug">Alamat Acara</label>
                    {{ url('/') }}<input type="text" id="event_slug" class="form-control form-control-alternative" name="event_slug" required>
                    </div>
                </div>
            </div>
            <div class="form-group focused">
            <label>Deskripsi</label>
            <textarea rows="4" class="form-control form-control-alternative" name="event_info"></textarea>
            </div>
            <button class="btn btn-icon btn-3 btn-primary" type="submit">
                <span class="btn-inner--text">Selanjutnya</span>
            </button>
        </div>
        </form>
    </div>
    <div class="card-footer py-4"></div>
    </div>
</div>
</div>
@endsection

@section('js')
<script>
    $(function() {
        $('#subs_type').on('change', function () {
            var value = $(this).find(":selected").val();
            if (value == 'paid') {
                $('#payment_title').removeAttr('hidden');

                $('#select_bank').removeAttr('hidden');
                $('#select_bank_form').attr('required','');

                $('#bank_account_owner_name').removeAttr('hidden');
                $('#bank_account_owner_name_form').attr('required','');

                $('#bank_account').removeAttr('hidden');
                $('#bank_account_form').attr('required','');
            } else {
                $('#payment_title').attr('hidden','');

                $('#select_bank').attr('hidden','');
                $('#select_bank_form').removeAttr('required');

                $('#bank_account_owner_name').attr('hidden','');
                $('#bank_account_owner_name_form').removeAttr('required');

                $('#bank_account').attr('hidden','');
                $('#bank_account_form').removeAttr('required');
            }
        });

    })

    function showBankInformationInput(val) {
        alert(val);
    }
</script>
@endsection
