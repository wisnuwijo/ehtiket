@extends('layouts.argon-login')

@section('content')
<div class="card-body px-lg-5 py-lg-5">
    <form role="form" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group mb-3">
        <div class="input-group input-group-alternative">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
        </div>

        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="input-group input-group-alternative">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
        </div>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="custom-control custom-control-alternative custom-checkbox">
        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        {{-- <input class="custom-control-input" id=" customCheckLogin" type="checkbox"> --}}
        <label class="custom-control-label" for=" customCheckLogin">
        <span class="text-muted">Remember me</span>
        </label>
    </div>
    <div class="text-center">
        <input type="submit" class="btn btn-primary my-4" value="Masuk">
    </div>
    </form>
</div>
@endsection
