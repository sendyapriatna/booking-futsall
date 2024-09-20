@extends('layouts.app4')

@section('title2', 'Profile')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="main-content2">
    <section class="section">
        <div class="section-header">
            <h1>Edit User Profile</h1>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
        </nav>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form action="/landingpage/profil/updated" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
            <input type="hidden" id="id" name="id" value="{{ $data->id}}" class="form-control select2">
            <h2 class="section-title" sty>Change Information Profile</h2>
            <!-- <p class="section-lead">Pilih titik pada map dibawah</p> -->
            <div class="row">
                <div class="col-md-4">
                    @if($data->image)
                    <div class=" text-center"><img class="img-fluid" style="height: 50vh; width: 50vh;" src="/storage/{{$data->image}}"></div>
                    @else
                    <div class=" text-center"><img class="img-fluid" style="height: 50vh; width: 50vh;" src="{{ asset('img/avatar/avatar-1.png') }}"></div>
                    @endif
                </div>
                <div class="col">
                    <section class="card px-5 py-5">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Username</label>
                                    <input type="text" style="border-radius: 0.5em;" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$data->name}}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" style="border-radius: 0.5em;" class="form-control @error('username') is-invalid @enderror" name="username" value="{{$data->username}}">
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="text" style="border-radius: 0.5em;" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$data->email}}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Whatsapp</label>
                                    <input type="text" style="border-radius: 0.5em;" class="form-control @error('nohp') is-invalid @enderror" name="nohp" value="{{$data->nohp}}">
                                    @error('nohp')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label @error('image') is-invalid @enderror">Foto Profil</label>
                                    <input type="hidden" name="oldImage" value="{{$data->image}}">
                                    <img src="" alt="" class="img-preview img-fluid col p-3">
                                    <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col p-3 mt-2">
                                <button type="submit" style="border-radius: 0.5em;" class="btn btn-success p-3 px-5 py-3">Simpan</button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </form>
        <form action="/landingpage/profil/updated2" method="post">
            @csrf
            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
            <input type="hidden" id="id2" name="id2" value="{{ $data->id}}" class="form-control select2">
            <section class="card px-5 py-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <!-- <input type="hidden" style="border-radius: 0.5em;" class="form-control" name="oldpassword" value="{{$data->password}}"> -->
                            <label for="password" class="form-label">Old Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input id="oldpassword" style="border-radius: 0.5em;" type="password" class="form-control" name="oldpasswordInput" autocomplete="new-password">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true" onMouseOver="this.style.cursor='pointer'"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <div class="input-group" id="show_hide_passwordnew">
                                <input id="password" style="border-radius: 0.5em;" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true" onMouseOver="this.style.cursor='pointer'"></i></span>
                                </div>
                                @error('password')
                                <div class=" invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm Password</label>
                            <div class="input-group" id="show_hide_passwordconfirm">
                                <input id="password-confirm" style="border-radius: 0.5em;" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true" onMouseOver="this.style.cursor='pointer'"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col p-3 mt-3">
                        <button type="submit" style="border-radius: 0.5em;" class="btn btn-success p-3 px-5 py-3">Reset Password</button>
                    </div>
                </div>
            </section>
        </form>
    </section>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $("#show_hide_password span").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });

        $("#show_hide_passwordnew span").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_passwordnew input').attr("type") == "text") {
                $('#show_hide_passwordnew input').attr('type', 'password');
                $('#show_hide_passwordnew i').addClass("fa-eye-slash");
                $('#show_hide_passwordnew i').removeClass("fa-eye");
            } else if ($('#show_hide_passwordnew input').attr("type") == "password") {
                $('#show_hide_passwordnew input').attr('type', 'text');
                $('#show_hide_passwordnew i').removeClass("fa-eye-slash");
                $('#show_hide_passwordnew i').addClass("fa-eye");
            }
        });

        $("#show_hide_passwordconfirm span").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_passwordconfirm input').attr("type") == "text") {
                $('#show_hide_passwordconfirm input').attr('type', 'password');
                $('#show_hide_passwordconfirm i').addClass("fa-eye-slash");
                $('#show_hide_passwordconfirm i').removeClass("fa-eye");
            } else if ($('#show_hide_passwordconfirm input').attr("type") == "password") {
                $('#show_hide_passwordconfirm input').attr('type', 'text');
                $('#show_hide_passwordconfirm i').removeClass("fa-eye-slash");
                $('#show_hide_passwordconfirm i').addClass("fa-eye");
            }
        });
    });

    // IMAGE PREVIEW
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
<!-- JS Libraies -->
<script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush