@extends('layouts.app4')

@section('title2', 'Landing Page')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="main-content2">
    <section class="section">
        <div class="section-header">
            <h1>Lapang Futsal Gor Amalia Indah</h1>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
            </ol>
        </nav>
        <div class="card p-3">
            <div class="card-body p-0">
                <div class="row d-flex justify-content-center text-center">
                    @foreach($lapangan_tables as $index => $item2)
                    @php $path = Storage::url('public/'.$item2->image); @endphp
                    <div class="col-5 col-md-5 col-lg-5 col-12 my-4 mx-2">
                        <img class="img-fluid" src="{{ url($path) }}" alt="">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Lapangan {{$index+1}}</h5>
                            <h3>Harga</h3>
                            <p>Rp. {{$item2->harga}} / jam</p>
                            <a href="/lapang/{{$item2->id}}"><button type="submit" style="border-radius: 0.5em;" class="btn btn-light p-2 px-4">Pilih</button></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
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