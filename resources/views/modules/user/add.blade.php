@extends('layouts.argon-dashboard')

@section('title','Niket - Tambah Pengguna')
@section('subtitle','Tambah Pengguna')

@section('content')
<div class="row">
<div class="col">
    <div class="card shadow">
    <div class="card-header border-0">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-0">Tambah Pengguna</h3>
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
        <h6 class="heading-small text-muted mb-4">Informasi Pengguna</h6>
        <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="name">Nama</label>
                    <input type="text" id="name" class="form-control form-control-alternative" name="name" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label" for="email">Email</label>
                    <label class="form-control-label text-red" id="email_verify" for="email"></label>
                    <input type="email" id="email" class="form-control form-control-alternative" onchange="checkEmailAvailbility()" name="email" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="password">Kata Sandi</label>
                    <label class="form-control-label text-red" id="password_verify_1" for="password"></label>
                    <input type="password" id="password" onkeyup="verifyPassword()" class="form-control form-control-alternative" name="password" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label" for="confirm_password">Konfirmasi Kata Sandi</label>
                    <label class="form-control-label text-red" id="password_verify_2" for="password"></label>
                    <input type="password" id="confirm_password" onkeyup="verifyPassword()" class="form-control form-control-alternative" name="confirm_password" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label" for="gender">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="form-control form-control-alternative" required>
                        <option value="">Pilih ...</option>
                        <option value="M">Laki-laki</option>
                        <option value="F">Perempuan</option>
                    </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group focused">
                    <label class="form-control-label" for="phone">Nomor Telepon</label>
                    <input type="number" id="phone" class="form-control form-control-alternative" name="phone" required>
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
    function verifyPassword() {
        var passwordInput = $('#password').val();
        var confirmPassword = $('#confirm_password').val();

        if (passwordInput != confirmPassword) {
            $('#password_verify_1').text('Kata sandi tidak cocok');
            $('#password_verify_2').text('Kata sandi tidak cocok');
            $('#save_user_btn').attr('disabled','');
        } else {
            $('#password_verify_1').text('');
            $('#password_verify_2').text('');
            $('#save_user_btn').removeAttr('disabled');
        }
    }

    function checkEmailAvailbility() {
        console.log(email);
        var email = $('#email').val();
        $.ajax({
            url: "{{ url('user/check_email') }}",
            type: 'GET',
            data: {
                'email': email
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
        });
    }
</script>
@endsection
