@extends('layouts.app')

@section('content')
    <div class="all-wrapper menu-side with-pattern">
        <div class="auth-box-w">
            <div class="logo-w">
                <a href="index.html"><img alt="" src="img/logo-big.png"></a>
            </div>
            <h4 class="auth-header">
                Prijava
            </h4>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="">E-mail</label><input class="form-control @error('email') is-invalid @enderror" placeholder="Unesite e-mail" type="email" value="{{ old('email') }}" name="email">
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Lozinka</label><input class="form-control @error('password') is-invalid @enderror" placeholder="Unesite lozinku" type="password" name="password">
                    <div class="pre-icon os-icon os-icon-fingerprint"></div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
                    @enderror
                </div>
                <div class="buttons-w">
                    <button class="btn btn-primary">{{ __('Prijavite se') }}</button>
                    <div class="form-check-inline">
                        <label class="form-check-label"><input class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }}>Zapamti</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
