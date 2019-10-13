{{--  'name' => $data['name'],
'email' => $data['email'],
'role_id' => $data['role_id'],
'identifier_type' => $data['identifier_type'],
'identifier_file' => $data['identifier_file'],
'origin_institution' => $data['origin_institution'],
'phone' => $data['phone'],
'password' => Hash::make($data['password'])  --}}

@extends('layouts.argon-register')

@section('content')
<div class="card-body px-lg-5 py-lg-5">
    <form method="POST" action="{{ route('register') }}">
    @csrf
    {{--  <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>  --}}


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

        <input id="role_id" type="text" class="form-control @error('role_id') is-invalid @enderror" name="role_id" value="{{ old('text') }}" required autocomplete="text" autofocus placeholder="Role">
        @error('role_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <input id="identifier_type" type="text" class="form-control @error('identifier_type') is-invalid @enderror" name="identifier_type" value="{{ old('text') }}" required autocomplete="text" autofocus placeholder="Identifier Type">
        @error('identifier_type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <input id="identifier_file" type="text" class="form-control @error('identifier_file') is-invalid @enderror" name="identifier_file" value="{{ old('text') }}" required autocomplete="text" autofocus placeholder="Identifier File">
        @error('identifier_file')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <input id="origin_institution" type="text" class="form-control @error('origin_institution') is-invalid @enderror" name="origin_institution" value="{{ old('text') }}" required autocomplete="text" autofocus placeholder="Identifier Institution">
        @error('origin_institution')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('text') }}" required autocomplete="text" autofocus placeholder="Phone">
        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('text') }}" required autocomplete="text" autofocus placeholder="Password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">

        <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" value="{{ old('text') }}" required autocomplete="new-password" autofocus placeholder="Confirm Password">
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
