@extends('layouts.app4')

@section('title2', 'Reservasi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')

<head>
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <!-- SRC MASIH SANDBOX DI LINE 17-->
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{config('midtrans.client_key')}}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
</head>
<!-- Content -->
<div class="main-content2">
    <section class="section">
        <div class="section-header">
            <h1>Checkout</h1>
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- <h2 class="section-title" sty>Pilih Titik</h2> -->
            <section class="card mt-4 px-4 py-4">
                <p class=""><b>Detail Booking</b></p>
                <div class="row">
                    <div class="col mb-3">
                        <label for="name" class="form-label">Invoice</label>
                        <input type="text" style="border-radius: 0.5em;" class="form-control" name="name" value="{{$get_data_booking[0]->invoice}}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" style="border-radius: 0.5em;" class="form-control" name="name" value="{{$get_data_booking[0]->nama}}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="name" class="form-label">Tanggal Booking</label>
                        <input type="text" style="border-radius: 0.5em;" class="form-control" name="name" value="{{$get_data_booking[0]->tanggal_booking}}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="name" class="form-label">Lapangan</label>
                        <input type="text" style="border-radius: 0.5em;" class="form-control" name="name" value="{{$get_data_booking[0]->no_lapang}}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="name" class="form-label">Jadwal Jam</label>
                        @for ($i = 0; $i < $count_get_data_booking; $i++)
                            <input type="text" style="border-radius: 0.5em;" class="form-control mb-3" name="name" value="{{$get_data_jadwal[$i]->jadwal}}" disabled>
                            @endfor
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="name" class="form-label">Total Jam</label>
                        <input type="text" style="border-radius: 0.5em;" class="form-control" name="name" value="{{$count_get_data_booking}} Jam" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="name" class="form-label">Total Harga</label>
                        <input type="text" style="border-radius: 0.5em;" class="form-control" name="name" value="Rp.{{$grand_total}}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <button type="button" style="border-radius: 0.5em; width:100%;" id="pay-button" class="btn btn-primary p-2">Checkout</button>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
@endsection

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

@stack('scripts')

<!-- Template JS File -->
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{$snapToken}}', {
            onSuccess: function(result) {
                /* You may add your own implementation here */
                //alert("payment success!");
                window.location.href = 'finish_booking/{{$get_data_booking[0]->invoice}}'
                console.log(result);
            },
            onPending: function(result) {
                /* You may add your own implementation here */
                alert("wating your payment!");
                console.log(result);
            },
            onError: function(result) {
                /* You may add your own implementation here */
                alert("payment failed!");
                console.log(result);
            },
            onClose: function() {
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
            }
        })
    });

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