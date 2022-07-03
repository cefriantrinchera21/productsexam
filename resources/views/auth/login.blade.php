@extends('layouts.main')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group position-relative has-icon-left mb-4">
            <input id="email" name="email" type="email" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" name="password" class="form-control form-control-xl @error('password') is-invalid @enderror" required autocomplete="current-password" placeholder="Password">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

       
        <button type="submit" class="btn btn-block btn-lg shadow-lg" style="color:white; background-color: #ba1ca7;">
            {{ __('Log in') }}
        </button>

        <div class="text-center pt-2 text-lg fs-4">
            <p class="text-gray-600">Don't have an account or account problem? <br><span style="color:red; font-size:14px;">Please contact the Administrator</span></p>
        </div>

    </form>
@endsection
