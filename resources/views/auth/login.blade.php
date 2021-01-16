@extends('layouts.app')


@section('content')
<div class="container-center d-flex align-items-center justify-content-center" id="cadastro-container">
    <form class="form-login" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="title-login d-flex flex-column align-items-center justify-content-around">
            <div class="logo"></div>
        </div>
        <div id="form-login" class="form-group col-12">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <div class="input-div d-flex justify-content-center align-items-center">
                <i id="icon-login" class="fas fa-user-alt"></i>
                <input id="email-login" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div id="form-login" class="form-group col-12">
            <label for="password">{{ __('Password') }}</label>
            <div class="input-div d-flex justify-content-center align-items-center">
                <i id="icon-login" class="fas fa-key"></i>
                <input id="password-login" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center align-content-center">
            <button class="btn btn-entrar" id="entrar-btn" type="submit" name="entrar-btn" value="entrar">
                {{ __('Login') }}</button>
            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
        </div>
    </form>
</div>
@endsection