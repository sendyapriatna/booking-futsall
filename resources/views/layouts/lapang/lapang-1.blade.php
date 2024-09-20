@extends('layouts.app4')

@section('title2', 'Reservasi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<!-- Content -->
<div class="main-content2">
    <section class="section">
        <div class="section-header">
            <h1>Reservasi</h1>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lapang</li>
            </ol>
        </nav>
        <div class="mt-1 ">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="center-cropped">
                            @php $path = Storage::url('public/post-image-profile/banner'); @endphp
                            <img src="{{ url($path) }}.jpg" class="d-block w-100" alt="...">
                            <!-- <img src="/storage/{{$data->image}}" class="d-block w-100" alt="..."> -->
                        </div>
                    </div>
                </div>
            </div>
            <form action="/lapang/setdate" method="post" enctype="multipart/form-data">
                @csrf
                <!-- <h2 class="section-title" sty>Pilih Titik</h2> -->
                <section class="card mt-4">
                    <div class="row">
                        <div class="col-6">
                            <div class="ml-4  pt-4 pb-2">
                                <label for="name" class="form-label"><b>Pilih Tanggal Booking</b></label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="ml-4 pl-3 pt-4 pb-2">
                                <label for="name" class="form-label"><b>Deskripsi</b></label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="ml-4 pl-3 pt-4 pb-2">
                                <label for="name" class="form-label"><b>Panjang Lapangan : </b>{{$data->panjang}} m</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6 col-md-6 col-lg-6 col-12">
                                    <div class="ml-4 mb-4">
                                        <input type="hidden" name="id_lapang" value="{{$id_lapang}}">
                                        <input type="text" class="form-control datepicker" name="tanggal_booking" id="tanggal_booking" placeholder="DD-MM-YYYY" value="{{$tanggal}}" required>
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2 col-md-2 col-lg-2 col-12">
                                    <div class="mb-4">
                                        <button type="submit" style="border-radius: 0.5em; width:100%;" class="btn btn-primary p-2">Set</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="ml-4 pl-3 pb-2">
                                <label for="name" class="form-label">{{$data->deskripsi}}</label>
                            </div>
                            <div class="ml-4 pl-3 pb-2">
                                <label for="name" class="form-label"><b>Material Lapangan : </b>{{$data->material}}</label>
                            </div>
                            <div class="ml-4 pl-3 pb-4">
                                <label for="name" class="form-label"><b>Harga Lapangan : </b>Rp.{{$data->harga}} Perjam</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="ml-4 pl-3 pb-2">
                                <label for="name" class="form-label"><b>Lebar Lapangan : </b>{{$data->lebar}} m</label>
                            </div>
                            <div class="ml-4 pl-3 pb-4">
                                <label for="name" class="form-label"><b>Jari-Jari Lingkaran Tengah : </b>{{$data->jarijari}} m</label>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
            <form action="/lapang/store" method="post" enctype="multipart/form-data">
                @csrf
                <!-- <h2 class="section-title" sty>Pilih Titik</h2> -->
                <section class="card mt-4 px-4 py-4">
                    <p class="">Tap pada item slot dibawah untuk memilih <b>Jadwal Booking</b></p>
                    <div class="container-fluid">
                        <div class="row text-center">
                            @foreach($jadwal_tables as $index => $item1)
                            <div class="col-2 col-md-2 col-lg-2 col-12">
                                <div class="card card_custom border" style="border-radius: 2em; box-shadow: 0px 10px 15px rgba(0,0,0,0.2);">
                                    <label class="form-check-label" for="">
                                        <div class="card-body">
                                            <input type="hidden" name="id_lapang" value="{{$id_lapang}}">
                                            <input type="hidden" name="tanggal_booking" value="{{$tanggal}}">
                                            <input class="form-check-input @error('jadwal_array') is-invalid @enderror" type="checkbox" name="checkbox[]" value="{{$item1->id}}" id="">
                                            @error('jadwal_array')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <img class="my-3" style="height: 50px;" src="{{ asset('img/jam.png') }}" alt="">
                                            <h6 class="card-title jdwl">{{$item1->jadwal}}</h6>
                                            <h6 class="card-subtitle mb-2 text-primary">Available</h6>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                            @foreach($jadwal_tables2 as $index => $item2)
                            <div class="col-2 col-md-2 col-lg-2 col-12 ">
                                <div class="card card_custom border" style="border-radius: 2em; box-shadow: 0px 10px 15px rgba(0,0,0,0.2);background-color: #e6e6e6;">
                                    <label class="form-check-label" for="">
                                        <div class="card-body">
                                            <!-- <input class="form-check-input" type="checkbox" name="checkbox[]" value="{{$item1->id}}" id="" disabled> -->
                                            <img class="my-3" style="height: 50px;" src="{{ asset('img/jam.png') }}" alt="">
                                            <h6 class="card-title jdwl">{{$item2->jadwal}}</h6>
                                            <h6 class="card-subtitle mb-2 text-danger">Booked</h6>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <button type="submit" style="border-radius: 0.5em; width:100%;" class="btn btn-primary p-2">Bayar</button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </section>
</div>

@endsection

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

@stack('scripts')

<!-- Template JS File -->
<script>
    $('.datepicker').datepicker({
        language: "es",
        autoclose: true,
        format: "dd-MM-yyyy",
        // endDate: '0d',
        startDate: '0d'
    });

    $('#buttontanggal').on('click', function() {
        event.preventDefault()
        setTanggal()
    })

    function setTanggal() {
        // var segitiga = $('bintang').val
        var tgl = $('#tanggal_booking').val()
        // console.log(tgl)
        $.ajax({
            url: '/lapang/coba',
            type: 'POST',
            // dataType: 'html',
            data: {
                'tanggal_booking': tgl,
                "_token": "{{ csrf_token() }}"
            },
            success: function(msg) {
                var coba = jQuery.parseJSON(msg.jadwal_array)
                console.log(coba);
            },
            error: function(msg) {
                alert('msg');
            }
        });
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