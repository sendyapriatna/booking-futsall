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
            <h1>Reservasi Lapang</h1>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reservasi</li>
            </ol>
        </nav>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form action="/dashboard/daftar_booking/add" method="post" enctype="multipart/form-data">
            @csrf
            <!-- <h2 class="section-title" sty>Pilih Titik</h2> -->
            <section class="card mt-4 p-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="nama" class="form-label">Name Penyewa</label>
                            <input type="text" style="border-radius: 0.5em;" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama')}}">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col p-3">
                            <label for="no_lapang" class="form-label">Nomor Lapangan</label>
                            <select class="custom-select" name="no_lapang" id="no_lapang" aria-label="Default select example">
                                <option disabled selected>Pilih Lapangan</option>
                                <option value="1">Lapangan 1</option>
                                <option value="2">Lapangan 2</option>
                                <option value="3">Lapangan 3</option>
                                <option value="4">Lapangan 4</option>
                            </select>
                        </div>
                        <div class="col p-3">
                            <label for="jam_mulai" class="form-label">Jam Bermain</label>
                            <select class="custom-select" name="pilih_jam" id="pilih_jam" aria-label="Default select example">
                                <option disabled selected>Pilih Jam</option>
                                <option value="1">07:00 - 08:00</option>
                                <option value="2">08:00 - 09:00</option>
                                <option value="3">09:00 - 10:00</option>
                                <option value="4">10:00 - 11:00</option>
                                <option value="5">11:00 - 12:00</option>
                                <option value="6">12:00 - 13:00</option>
                                <option value="7">13:00 - 14:00</option>
                                <option value="8">14:00 - 15:00</option>
                                <option value="9">15:00 - 16:00</option>
                                <option value="10">16:00 - 17:00</option>
                                <option value="11">17:00 - 18:00</option>
                                <option value="12">18:00 - 19:00</option>
                                <option value="13">19:00 - 20:00</option>
                                <option value="14">20:00 - 21:00</option>
                                <option value="15">21:00 - 22:00</option>
                                <option value="16">22:00 - 23:00</option>
                                <option value="17">23:00 - 24:00</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="total_jam" class="form-label">Total Jam</label>
                            <input type="number" id="Lattitude" style="border-radius: 0.5em;" class="form-control @error('total_jam') is-invalid @enderror" name="total_jam" value="1" disabled>
                            @error('total_jam')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col p-3">
                            <label for="total_harga" class="form-label">Total Harga</label>
                            <input type="number" id="total_harga" style="border-radius: 0.5em;" class="form-control @error('total_harga') is-invalid @enderror" name="total_harga" value="{{old('total_harga')}}">
                            @error('total_harga')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col p-3">
                            <label for="name" class="form-label">Tanggal Booking</label>
                            <input type="text" class="form-control datepicker" name="tanggal_booking" id="tanggal_booking" placeholder="DD-MM-YYYY" value="{{old('tanggal_booking')}}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="custom-select" name="status" id="status" aria-label="Default select example">
                                <option disabled selected>Pilih Status Booking</option>
                                <option class="p-3" value="On Progres">On Progress</option>
                                <option class="p-3" value="Pending">Pending</option>
                                <option class="p-3" value="Success">Success</option>
                            </select>
                        </div>
                        <!-- <div class="col p-3">
                            <label for="image" class="form-label @error('image') is-invalid @enderror">Post Image</label>
                            <img src="" alt="" class="img-preview img-fluid mb-3">
                            <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                            @error('image')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div> -->
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