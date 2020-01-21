@extends('layouts.argon-dashboard')

@section('title','Niket - Edit Pengguna')
@section('subtitle','Edit Pengguna')

@section('content')
<div class="row">
<div class="col">
    <div class="card shadow">
    <div class="card-header border-0">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-0">Edit Pengguna</h3>
            </div>
            <div class="col-md-6">
                <div class="float-right">

                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ url('user/save') }}" method='POST'>
        @csrf
        <input type="hidden" name="_method" value="patch">
        <input type="hidden" name="id" value="{{ $data->id }}">
        <h6 class="heading-small text-muted mb-4">Informasi Pengguna</h6>

        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-air-baloon"></i></span>
            <span class="alert-inner--text">Apabila kamu tidak ingin mengganti kata sandi, cukup kosongkan kata sandi</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="name">Nama</label>
                    <input type="text" id="name" class="form-control form-control-alternative" name="name" value="{{ $data->name }}" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label" for="email">Email</label>
                    <label class="form-control-label text-red" id="email_verify" for="email"></label>
                    <input type="email" id="email" class="form-control form-control-alternative" onchange="checkEmailAvailbility('{{ $data->id }}')" value="{{ $data->email }}" name="email" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="password">Kata Sandi</label>
                    <label class="form-control-label text-red" id="password_verify_1" for="password"></label>
                    <input type="password" id="password" onkeyup="verifyPassword()" class="form-control form-control-alternative" name="password">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label" for="confirm_password">Konfirmasi Kata Sandi</label>
                    <label class="form-control-label text-red" id="password_verify_2" for="password"></label>
                    <input type="password" id="confirm_password" onkeyup="verifyPassword()" class="form-control form-control-alternative" name="confirm_password">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label" for="gender">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="form-control form-control-alternative" required>
                        <option value="">Pilih ...</option>
                        @if($data->gender == 'M')
                            <option value="M" selected>Laki-laki</option>
                        @else
                            <option value="M">Laki-laki</option>
                        @endif
                        @if($data->gender == 'F')
                            <option value="F" selected>Perempuan</option>
                        @else
                            <option value="F">Perempuan</option>
                        @endif
                    </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="phone">Nomor Telepon</label>
                    <input type="number" id="phone" class="form-control form-control-alternative" name="phone" value="{{ $data->phone }}" required>
                    </div>
                </div>
            </div>
            <button class="btn btn-icon btn-3 btn-primary" id="save_user_btn" type="submit" disabled>
                <span class="btn-inner--text">Simpan</span>
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
        verifyPassword();
        checkEmailAvailbility('{{ $data->id }}');
    });

    function verifyPassword() {
        var passwordInput = $('#password').val();
        var confirmPassword = $('#confirm_password').val();

        if (passwordInput != '' || confirmPassword != '') {
            if (passwordInput != confirmPassword) {
                $('#password_verify_1').text('Kata sandi tidak cocok');
                $('#password_verify_2').text('Kata sandi tidak cocok');
                $('#save_user_btn').attr('disabled','');
            } else {
                $('#password_verify_1').text('');
                $('#password_verify_2').text('');
                $('#save_user_btn').removeAttr('disabled');
            }
        } else {
            $('#save_user_btn').removeAttr('disabled');
        }
    }

    function checkEmailAvailbility(id) {
        var email = $('#email').val();
        $.ajax({
            url: "{{ url('user/check_email') }}",
            type: 'GET',
            data: {
                'email': email,
                'id': id,
            },
            success: function(result) {
                if (result > 0) {
                    $('#email_verify').text('Email sudah digunakan, mohon pakai email lain');
                    $('#save_user_btn').attr('disabled','');
                } else {
                    $('#email_verify').text('');
                    $('#save_user_btn').removeAttr('disabled');
                }
            },
            error: function(error) {
                console.log(error);
            }
        })
    }
</script>
@endsection
