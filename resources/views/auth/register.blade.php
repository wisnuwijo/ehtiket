@extends('layouts.argon-register')

@section('content')
<div class="card-body px-lg-5 py-lg-5">
    <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('text') }}" required autocomplete="text" autofocus placeholder="Nama">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" required>
            <option value="">Pilih Gender</option>
            <option value="M">Laki-laki</option>
            <option value="F">Perempuan</option>
        </select>
        @error('gender')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('text') }}" required autocomplete="text" autofocus placeholder="Email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <input id="institution_name" type="text" class="form-control @error('institution_name') is-invalid @enderror" name="institution_name" value="{{ old('text') }}" required autocomplete="text" autofocus placeholder="Nama Institusi Asal">
        @error('origin_institution')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <input id="institution_address" type="text" class="form-control @error('institution_address') is-invalid @enderror" name="institution_address" value="{{ old('text') }}" required autocomplete="text" autofocus placeholder="Alamat Institusi Asal">
        @error('origin_institution')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('text') }}" required autocomplete="text" autofocus placeholder="No. HP">
        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('text') }}" required autocomplete="text" autofocus placeholder="Kata Sandi">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" value="{{ old('text') }}" required autocomplete="new-password" autofocus placeholder="Konfirmasi Sandi">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="text-center">
        <input type="submit" class="btn btn-primary my-4" value="Daftar">
    </div>
    </form>
</div>
@endsection
