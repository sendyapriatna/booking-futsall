@extends('layouts.app2')

@section('title2', 'Reservasi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah User</h1>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/dashboard/user">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
            </ol>
        </nav>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form action="/dashboard/user/add" method="post" enctype="multipart/form-data">
            @csrf
            <!-- <h2 class="section-title" sty>Pilih Titik</h2> -->
            <section class="card mt-4 p-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" style="border-radius: 0.5em;" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col p-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" style="border-radius: 0.5em;" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username')}}">
                            @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col p-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" style="border-radius: 0.5em;" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
                            @error('email')
                            <div class=" invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="nohp" class="form-label">Whatsapp</label>
                            <input type="text" style="border-radius: 0.5em;" class="form-control @error('nohp') is-invalid @enderror" name="nohp" value="{{old('nohp')}}">
                            @error('nohp')
                            <div class=" invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col p-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group" id="show_hide_passwordnew">
                                <input id="password" style="border-radius: 0.5em;" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" value="{{old('password')}}">
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
                        <div class="col p-3">
                            <label for="password" class="form-label">Confirm Password</label>
                            <div class="input-group" id="show_hide_passwordconfirm">
                                <input id="password-confirm" style="border-radius: 0.5em;" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" value="{{old('password_confirmation')}}">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true" onMouseOver="this.style.cursor='pointer'"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="image" class="form-label @error('image') is-invalid @enderror">Foto Profil</label>
                            <img src="" alt="" class="img-preview img-fluid mb-3">
                            <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                            @error('image')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col p-3 mt-3">
                        <button type="submit" style="border-radius: 0.5em;" class="btn btn-success p-3 px-5 py-3">Submit</button>
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