@extends('layouts.app2')

@section('title2', 'Reservasi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Reservasi</h1>
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
        <form action="/dashboard/daftar_booking/update" method="post" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" value="{{ $data->id}}" class="form-control select2">
            @csrf
            <!-- <h2 class="section-title" sty>Pilih Titik</h2> -->
            <section class="card mt-4 p-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="invoice" class="form-label">Invoice</label>
                            <input type="text" style="border-radius: 0.5em;" disabled class="form-control @error('invoice') is-invalid @enderror" name="invoice" value="{{$data->invoice}}">
                            @error('invoice')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col p-3">
                            <label for="nama" class="form-label">Nama Penyewa</label>
                            <input type="text" style="border-radius: 0.5em;" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{$data->nama}}">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col p-3">
                            <label for="no_lapang" class="form-label">Nomor Lapangan</label>
                            <input type="text" style="border-radius: 0.5em;" class="form-control @error('no_lapang') is-invalid @enderror" name="no_lapang" value="{{$data->no_lapang}}">
                            @error('no_lapang')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="total_jam" class="form-label">Total Jam</label>
                            <input type="number" id="" style="border-radius: 0.5em;" disabled class="form-control @error('total_jam') is-invalid @enderror" name="total_jam" value="{{$data->total_jam}}">
                            @error('total_jam')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col p-3">
                            <label for="total_harga" class="form-label">Total Harga</label>
                            <input type="number" id="total_harga" style="border-radius: 0.5em;" class="form-control @error('total_harga') is-invalid @enderror" name="total_harga" value="{{$data->total_harga}}">
                            @error('total_harga')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col p-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="hidden" name="status" value="{{$data->status}}">
                            <select class="custom-select" name="status" id="status" aria-label="Default select example">
                                <option disabled selected>{{$data->status}}</option>
                                <option class="p-3" value="On Progress">On Progress</option>
                                <option class="p-3" value="Pending">Pending</option>
                                <option class="p-3" value="Success">Success</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col p-3">
                            <label for="name" class="form-label">Tanggal Booking</label>
                            <input type="text" class="form-control datepicker2  @error('tanggal_booking') is-invalid @enderror" name="tanggal_booking" id="tanggal_booking" placeholder="DD-MM-YYYY" value="{{$data->tanggal_booking}}">
                            @error('tanggal_booking')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col p-3">
                            <label for="status" class="form-label">Detail Jam Booking</label>
                            <input type="text" class="form-control @error('jadwal_array') is-invalid @enderror" name="jadwal_array" id="jadwal_array" value="{{$data->jadwal_array}}">
                            @error('jadwal_array')
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
<!-- JS Libraies -->
<script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<!-- Page Specific JS File -->
<!-- Template JS File -->
<script>
    $('.datepicker2').datepicker({
        language: "es",
        autoclose: true,
        format: "dd-MM-yyyy",
        // endDate: '0d',
        startDate: '0d'
    });
</script>
<script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush