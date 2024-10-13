@extends('layouts.app')

@section('content')
<div class="container">
    <section class="section shadow-lg p-3 mb-5 bg-body rounded" style="margin-top: 15vh;">
        <div class="row justify-content-center">
            <div class="col-md-7" style="min-height: 550px;">
                <img class="img-fluid" src="{{ asset('img/login.png') }}" alt="" style="margin-top: 5vh;">
            </div>
            <div class="col-md-5">
                <div class="col-md p-4 mt-4 text-center justify-content-center">
                    <h5 style="color: #787adc;"><b>SELAMAT DATANG</b></h5>
                    <h5 style="color: #787adc;"><b>DI GOR AMALIA INDAH</b></h5>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row mb-3 justify-content-center">
                        <!-- <label for="email" class="col-md-10 col-form-label text-md-end"><i class="fa-solid fa-user"></i></label> -->
                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center">
                        <!-- <label for="email" class="col-md-10 col-form-label text-md-end"><i class="fa-solid fa-user"></i></label> -->
                        <div class="col-md-8">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="usernamename" autofocus placeholder="Username">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center">
                        <!-- <label for="email" class="col-md-8 col-form-label text-md-end"><i class="fa-solid fa-user"></i></label> -->
                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center">
                        <!-- <label for="email" class="col-md-8 col-form-label text-md-end"><i class="fa-solid fa-user"></i></label> -->
                        <div class="col-md-8">
                            <input id="nohp" type="nohp" class="form-control @error('nohp') is-invalid @enderror" name="nohp" value="{{ old('nohp') }}" required autocomplete="nohp" autofocus placeholder="Nomor Telepon">
                            @error('nohp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center">
                        <!-- <label for="password" class="col-md-8 col-form-label text-md-end"><i class="fa-solid fa-lock"></i></label> -->
                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center">
                        <!-- <label for="password" class="col-md-8 col-form-label text-md-end"><i class="fa-solid fa-lock"></i></label> -->
                        <div class="col-md-8">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center pb-3">
                        <div class="col-md-8">
                            <button type="submit" style="width: 100%; background-color: #787adc;" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection