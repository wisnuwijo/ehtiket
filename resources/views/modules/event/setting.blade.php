@extends('layouts.argon-dashboard')

@section('title','Niket - Pengaturan Acara')
@section('subtitle','Pengaturan Acara')

@section('content')
<div class="row">
<div class="col">
    <div class="card shadow">
    <div class="card-header border-0">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-0">Pengaturan Acara</h3>
            </div>
            <div class="col-md-6">
                <div class="float-right">

                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($msg = Session::get('success'))
            <div <div class="alert alert-secondary" role="alert">
                <strong>{{ $msg }}</strong>
            </div>
        @endif
        <form action="{{ url('events/setting/save') }}" method='POST'>
        @csrf
        <h6 class="heading-small text-muted mb-4">Informasi Acara</h6>
        <input type="hidden" value="{{ $eventId }}" name="event_id">
        <div class="pl-lg-4">
            <div class="row">
                @if($event->event_subscription == 'paid')
                    <div class="col-lg-6">
                        <div class="form-group focused">
                            <label class="form-control-label" for="max_ticket_per_transaction">Maksimal Tiket Per Transaksi</label>
                            <input type="number" value="1" id="max_ticket_per_transaction" class="form-control form-control-alternative" name="max_ticket_per_transaction" required>
                        </div>
                    </div>
                    <div class="col-lg-6" id="registration_cost_input">
                        <div class="form-group focused">
                            <label class="form-control-label" for="registration_cost">Biaya Pendaftaran</label>
                            <input type="number" id="registration_cost" class="form-control form-control-alternative" name="registration_cost" required>
                        </div>
                    </div>
                @endif
                @if(isset($event))
                    @if($event->event_category == '2')
                    {{--  jika event lomba  --}}
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="participant_type">Jenis Peserta</label>
                                <select name="participant_type" id="participant_type" class="form-control form-control-alternative" required>
                                    <option value="">Pilih Jenis Peserta</option>
                                    <option value="team">Kelompok</option>
                                    <option value="individu">Individu</option>
                                    <option value="hybrid">Kelompok & Individu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6" id="min_team_member_input" hidden>
                            <div class="form-group focused">
                                <label class="form-control-label" for="min_team_member">Anggota Minimal Kelompok</label>
                                <input type="number" id="min_team_member" class="form-control form-control-alternative" name="min_team_member">
                            </div>
                        </div>
                        <div class="col-lg-6" id="max_team_member_input" hidden>
                            <div class="form-group focused">
                                <label class="form-control-label" for="max_team_member">Anggota Maksimal Kelompok</label>
                                <input type="number" id="max_team_member" class="form-control form-control-alternative" name="max_team_member">
                            </div>
                        </div>
                        <div class="col-lg-6" id="point_team_lead_input" hidden>
                            <div class="form-group focused">
                                <label class="form-control-label" for="point_team_lead">Wajibkan Penunjukkan Ketua Kelompok</label>
                                <select name="point_team_lead" id="point_team_lead" class="form-control form-control-alternative">
                                    <option value="">Pilih</option>
                                    <option value="1">Wajib</option>
                                    <option value="0">Tidak Wajib</option>
                                </select>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <h6 class="heading-small text-muted mb-4">
            Buat Form Pendaftaran Untuk Acara Kamu
        </h6>
        <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <table style="width:100%" id="createForm">
                        {{--  raw hidden input to be copied --}}
                        <tr id="rawInput" style="display:none">
                            <td style="padding:10px">
                                <div class="rawInput-form-name">
                                    <input type="text" id="form_name" class="form-control form-control-alternative" placeholder="Nama bidang input">
                                </div>
                                <div class="rawInput-drop-down-val text-center" hidden>
                                    <label class="form-control-label" for="max_ticket_per_transaction" style="margin-top:10px" id="option-title-">Opsi</label>
                                    <input type="text" style="margin-top:10px" id="option" class="form-control form-control-alternative" placeholder="Tulis Opsi">
                                    <input type="text" style="margin-top:10px" id="option_raw" class="form-control form-control-alternative" placeholder="Tulis Opsi" hidden>
                                    <button style="margin-top:10px" class="btn btn-sm btn-icon btn-light" type="button" id="addOption">
                                        <span class="fa fa-plus"></span> Tambah Opsi
                                    </button>
                                </div>
                            </td>
                            <td style="padding:10px">
                                <select id="form_type" class="form-control form-control-alternative">
                                    <option value="">Pilih Jenis Input</option>
                                    <option value="text">Teks</option>
                                    <option value="number">Angka</option>
                                    <option value="file">File</option>
                                    <option value="date">Tanggal</option>
                                    <option value="drop-down">Drop-down</option>
                                </select>
                            </td>
                            <td style="padding:10px">
                                <input type="radio" id="mandatory" value="1" checked>
                                <label for="mandatory">Wajib diisi</label><br>
                                <input type="radio" id="not_mandatory" value="0">
                                <label for="not_mandatory">Tidak wajib diisi</label>
                            </td>
                            <td style="padding:10px">
                                <button class="btn btn-icon btn-danger" type="button" id="deleteForm" onclick="deleteCurrentForm()">
                                    <span class="fa fa-times"></span>
                                </button>
                            </td>
                        </tr>

                        {{--  first input displayed --}}
                        <tr id="formInput" style="border-top: 2px solid #adb5bd;">
                            <td style="padding:10px">
                                <div class="form-name">
                                    <input type="text" id="form_name" class="form-control form-control-alternative" name="form_name[0]" placeholder="Nama bidang input" required>
                                </div>
                                <div class="rawInput-drop-down-val text-center" id="rawInput-drop-down-val-0" hidden>
                                    <label class="form-control-label" for="max_ticket_per_transaction" style="margin-top:10px" id="option-title-0">Opsi</label>
                                    <input type="text" style="margin-top:10px" id="option-0-0" class="form-control form-control-alternative" name="option[0][0]" placeholder="Tulis Opsi">
                                    <input type="text" style="margin-top:10px" id="option_raw_main" class="form-control form-control-alternative" placeholder="Tulis Opsi" hidden>
                                    <button style="margin-top:10px" class="btn btn-sm btn-icon btn-light" type="button" id="addOption" onclick="addOptionList(0)">
                                        <span class="fa fa-plus"></span> Tambah Opsi
                                    </button>
                                </div>
                            </td>
                            <td style="padding:10px">
                                <select name="form_type[0]" id="form_type" class="form-control form-control-alternative" onchange="detectChange(0)" required>
                                    <option value="">Pilih Jenis Data Input</option>
                                    <option value="text">Teks</option>
                                    <option value="number">Angka</option>
                                    <option value="file">File</option>
                                    <option value="date">Tanggal</option>
                                    <option value="drop-down">Drop-down</option>
                                </select>
                            </td>
                            <td style="padding:10px">
                                <input type="radio" id="mandatory" name="mandatory[0]" value="1" checked required>
                                <label for="mandatory">Wajib diisi</label><br>
                                <input type="radio" id="not_mandatory" name="mandatory[0]" value="0" required>
                                <label for="not_mandatory">Tidak wajib diisi</label>
                            </td>
                            <td style="padding:10px">
                                <button class="btn btn-icon btn-light" type="button" id="addForm">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

            <button class="btn btn-icon btn-3 btn-primary" type="submit">
                <span class="btn-inner--text">Simpan</span>
            </button>
        </form>
    </div>
    <div class="card-footer py-4"></div>
    </div>
</div>
</div>
@endsection

@section('js')
<script>
    /// error ketika
    /// 1. ketika input pertama belum dipilih jenis inputnya kemudian di klik + input dan di inputan pertama di ubah jenisnya menjadi dropdown tidak bisa
    /// 2. ketika menambahkan 2 inputan baru sekaligus tanpa memasukkan jenis inputnya, ketika diubah jenisnya tidak merespon
    var addedForm = 0;
    var addedOption = [[0]];

    function deleteCurrentForm(id) {
        var getId = 'rawInput'+id;
        $('#'+getId).remove();
    }

    function addOptionList(id) {
        console.log(id);
        console.log(addedOption[id]);
        if (id > 0) {
            // option list
            var firstArrLength = addedOption[id].length + 1;
            addedOption[id].push(firstArrLength);

            var optionRawId = '#option_raw_'+id;
            var optionRawParent = '#rawInput-drop-down-val-'+id;
            $('#option_raw_'+id).clone()
                .insertAfter('#option-title-'+id)
                .removeAttr('hidden')
                .removeAttr('id')
                .attr('name','option['+id+']['+firstArrLength+']');
        } else {
            // first list
            var firstArrLength = addedOption[0].length;
            addedOption[0].push(firstArrLength);

            $('#option_raw_main').clone()
                .insertAfter('#option-title-0')
                .removeAttr('hidden')
                .removeAttr('id')
                .attr('name','option[0]['+firstArrLength+']');
        }
    }

    function detectChange(formNumber) {
        var inputId = 'form_type['+formNumber+']';
        var value = $('select[name="'+inputId+'"]').find(":selected").val();
        console.log('value => '+value);

        var textFormNameId = '#rawInput-form-name-'+formNumber;
        var optionFormId = '#rawInput-drop-down-val-'+formNumber;
        if (value == 'drop-down') {
            console.log('drop-down activated');
            $(optionFormId).removeAttr('hidden');

            // find child element of optionFormId with type input to rename its name attribute
            $(optionFormId).find("input").each(function() {
                var getInputName = $(this).attr("temp-name");
                console.log('getInputName = '+getInputName);

                if (typeof getInputName != 'undefined') {
                    $(this).attr('name',getInputName);
                    $(this).removeAttr('temp-name');

                    // remove first to prevent duplicate attribute
                    $(this).removeAttr('required');
                    $(this).attr('required','');
                }
            });
        } else {
            console.log('drop-down inactive');
            $(optionFormId).attr('hidden','');

            // find child element of optionFormId with type input to rename its name attribute
            $(optionFormId).find("input").each(function() {
                var getInputName = $(this).attr("name");
                console.log('getInputName = '+getInputName);

                if (typeof getInputName != 'undefined') {
                    $(this).attr('temp-name',getInputName);
                    $(this).removeAttr('name');
                    $(this).removeAttr('required');
                }
            });
        }
    }

    $('#participant_type').change(function(e) {
        var participantType = $(this).val();

        if (participantType != 'individu') {
            $('#min_team_member_input').removeAttr('hidden');
            $('#min_team_member').attr('required','');

            $('#max_team_member_input').removeAttr('hidden');
            $('#max_team_member').attr('required','');

            $('#point_team_lead_input').removeAttr('hidden');
            $('#point_team_lead').attr('required','');
        } else {
            $('#min_team_member_input').attr('hidden','');
            $('#min_team_member').removeAttr('required');

            $('#max_team_member_input').attr('hidden','');
            $('#max_team_member').removeAttr('required');

            $('#point_team_lead_input').attr('hidden','');
            $('#point_team_lead').removeAttr('required');
        }
    });

    $(document).ready(function(){

        $('#addOption').click(function() {
            var lastIndex = 0;
            // if value exist in addedOption
            if (typeof addedOption[addedForm] != 'undefined') {
                var getMaxVal = Math.max.apply(Math,addedOption[addedForm]);
                console.log('max arr val => '+getMaxVal);
                var newIndex = getMaxVal + 1;
                var lastIndex = newIndex;

                addedOption[addedForm].push(newIndex);
            } else {
                addedOption[addedForm] = [lastIndex];
            }

            $('#option_raw').clone()
                .prependTo('.rawInput-drop-down-val-0')
                .removeAttr('hidden')
                .attr('name','option['+addedForm+']['+lastIndex+']');
        });

        $('select[name="form_type[0]"]').change(function() {
            var value = $(this).find(":selected").val();

            if (value == 'drop-down') {
                $('.rawInput-drop-down-val-0').removeAttr('hidden','');
                // $('.form-name').attr('hidden','');
            } else {
                $('.rawInput-drop-down-val-0').attr('hidden','');
                // $('.form-name').removeAttr('hidden','');
            }
        });

        $("#addForm").click(function(){
            addedForm += 1;
            addedOption[addedForm] = [];

            $("#rawInput").clone().prependTo("#createForm");

            var newId = 'rawInput'+addedForm;
            var newDeleteId = 'deleteForm'+addedForm;
            var newMandatoryName = 'mandatory['+addedForm+']';
            var newFormName = 'form_name['+addedForm+']';
            var newFormType = 'form_type['+addedForm+']';

            $('#mandatory').attr('name', newMandatoryName);
            $('#not_mandatory').attr('name', newMandatoryName);
            $('#mandatory').attr('required', '');
            $('#not_mandatory').attr('required', '');

            $('#form_name').attr('required','');
            $('#form_type').attr('required','');
            $('#form_name').attr('name', newFormName);
            $('#form_type').attr('name', newFormType);
            $('#form_type').attr('onchange', 'detectChange('+addedForm+')');
            $('.rawInput-form-name').attr('id','rawInput-form-name-'+addedForm);
            $('.rawInput-drop-down-val').attr('id','rawInput-drop-down-val-'+addedForm);

            // rename id on option
            $('#option_raw').attr('id','option_raw_'+addedForm);
            $('#option').removeAttr('id')
                .attr('name','option['+addedForm+'][0]');
            // rename id and add onclick attribute
            $('#addOption')
                .attr('id','addOption-'+addedForm)
                .attr('onclick','addOptionList('+addedForm+')');
            // rename option title id
            $('#option-title-').attr('id','option-title-'+addedForm);

            $('#rawInput').attr('id',newId);
            $('#'+newId).removeAttr('style');
            $('#'+newId).attr('style','border-top: 2px solid #adb5bd;');

            $('#deleteForm').attr('id', newDeleteId);
            $('#'+newDeleteId).attr('onclick', 'deleteCurrentForm('+addedForm+')');
        });
    });

</script>
@endsection
