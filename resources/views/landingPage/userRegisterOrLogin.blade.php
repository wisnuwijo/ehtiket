@extends('layouts.plain-layout')

@section('plain-content')
{{--  login form  --}}
<form action="{{ url('user/register_or_login') }}" method="POST" style="margin-top: 100px;display:none" id="loginForm">
    <h3>Masuk untuk melanjutkan</h3>
    <div class="alert alert-light" role="alert">
        Belum punya akun? <button id="showRegisterBtn" onclick="hideLoginShowRegister()" class="btn btn-primary-outline alert-link">Daftar disini</button>
    </div>
    @csrf

    <div class="row form-group">
        <div class="col-md-12" style="margin-top:10px">
            <label class="text-black" for="email">Email</label>
            <input type="hidden" name="action" value="login">
            <input type="hidden" name="fromUrl" value="{{ url()->full() }}">
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-12" style="margin-top:10px">
            <label class="text-black" for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-12">
            <input type="submit" value="Masuk" class="btn btn-primary btn-md text-white">
        </div>
    </div>
</form>

{{--  register form  --}}
<form action="{{ url('user/register_or_login') }}" method="POST" class="bg-white" style="margin-top: 100px" id="registerForm">
    <h3>Daftar untuk melanjutkan</h3>
    <div class="alert alert-light" role="alert">
        Sudah punya akun? <button id="showLoginBtn" onclick="hideRegisterShowLogin()" class="btn btn-primary-outline alert-link">Login</a>
    </div>
    @csrf
    <div class="row form-group">
        <div class="col-md-6" style="margin-top:10px">
            <label class="text-black" for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control" required>
            <input type="hidden" name="action" value="register">
        </div>
        <div class="col-md-6" style="margin-top:10px">
            <label class="text-black" for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-6" style="margin-top:10px">
            <label class="text-black" for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="col-md-6" style="margin-top:10px">
            <label class="text-black" for="confirm_password">Konfirmasi Kata Sandi</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3 mb-md-0" style="margin-top:10px">
            <label class="text-black" for="gender">Jenis Kelamin</label>
            <select name="gender" id="gender" class="form-control" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="M">Laki-laki</option>
                <option value="F">Perempuan</option>
            </select>
        </div>
        <div class="col-md-6" style="margin-top:10px">
            <label class="text-black" for="phone">Nomor Telepon</label>
            <input type="number" id="phone" name="phone" class="form-control" required>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-12">
            <input type="submit" value="Daftar" class="btn btn-primary btn-md text-white">
        </div>
    </div>
</form>
@endsection

@section('js')
<script>
    function hideRegisterShowLogin() {
        $('#registerForm').hide();
        $('#loginForm').show();
    }

    function hideLoginShowRegister() {
        $('#loginForm').hide();
        $('#registerForm').show();
    }
</script>
@endsection
