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
            <h1>Tambah Admin</h1>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/dashboard/admin">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Admin</li>
            </ol>
        </nav>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form action="/dashboard/lapangan/add" method="post" enctype="multipart/form-data">
            @csrf
            <!-- <h2 class="section-title" sty>Pilih Titik</h2> -->
            <section class="card mt-4 p-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="panjang" class="form-label">Panjang Lapangan (m)</label>
                            <input type="number" style="border-radius: 0.5em;" class="form-control @error('panjang') is-invalid @enderror" name="panjang" value="{{old('panjang')}}">
                            @error('panjang')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="lebar" class="form-label">Lebar Lapangan (m)</label>
                            <input type="number" style="border-radius: 0.5em;" class="form-control @error('lebar') is-invalid @enderror" name="lebar" value="{{old('lebar')}}">
                            @error('lebar')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="jarijari" class="form-label">Jari-Jari Lingkaran Tengah (m)</label>
                            <input type="number" style="border-radius: 0.5em;" class="form-control @error('jarijari') is-invalid @enderror" name="jarijari" value="{{old('jarijari')}}">
                            @error('jarijari')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="material" class="form-label">Material Lapangan</label>
                            <input type="text" style="border-radius: 0.5em;" class="form-control @error('material') is-invalid @enderror" name="material" value="{{old('material')}}">
                            @error('material')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="harga" class="form-label">Harga Perjam</label>
                            <input type="number" style="border-radius: 0.5em;" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{old('harga')}}">
                            @error('harga')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
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
                <div class="row">
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" style="border-radius: 0.5em;" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{old('deskripsi')}}">
                            @error('deskripsi')
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