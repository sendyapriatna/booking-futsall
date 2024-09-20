<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Landing Page</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="{{ url ('frontend/img/map.ico') }}">

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Leaflet Routing Machine -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">

    @stack('style')

    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="shortcut icon" href="{{ url ('frontend/img/map.ico') }}">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->

    <style>
        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }

        .legend {
            line-height: 18px;
            color: #555;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }

        /*Legend specific*/
        .legend {
            padding: 6px 8px;
            font: 14px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
            /*border-radius: 5px;*/
            line-height: 24px;
            color: #555;
        }

        .legend h4 {
            text-align: center;
            font-size: 16px;
            margin: 2px 12px 8px;
            color: #777;
        }

        .legend span {
            position: relative;
            bottom: 3px;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin: 0 8px 0 0;
            opacity: 0.7;
        }

        .legend i.icon {
            background-size: 18px;
            background-color: rgba(255, 255, 255, 1);
        }

        .center-cropped {

            height: 500px;
            background-position: center center;
            background-repeat: no-repeat;
        }

        input[type=checkbox] {
            outline: 1px auto red;
        }


        .card_custom:hover {
            outline: 1px auto blue;
        }

        div .card_custom {
            background-color: white;
        }

        div .card_custom:focus {
            background-color: red;
            color: red;
        }

        /* input[type=checkbox]:checked {} */
    </style>
    <title>Document</title>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <!-- <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li> -->
                        <!-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> -->
                    </ul>
                </form>

                <ul class="navbar-nav navbar-right">
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link btn btn-light" style="color: #787adc;" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="/storage/{{ Auth::user()->image }}" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="/dashboard/profil/{{ Auth::user()->id }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            @can('admin')
                            <a href="/dashboard" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Dashboard
                            </a>
                            @endcan
                            <a href="#" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </nav>
            <div class="navbar-bg shadow p-3 mb-5" style="height: 20vh;background-color:#787adc;"></div>
            <!-- Sidebar -->


            <!-- Content -->
            <div class="container-fluid">
                <div class="mt-5 mb-4">
                    <h2 class="section-title text-white py-3">Lapang Futsal Gor Amalia Indah</h2>
                    <!-- <p class="section-lead text-white px-5">Selamat Datang Di Website GIS Tsunami Pangandaran.</p> -->

                </div>
                <section class="section ">
                    <div class="mt-1 ">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="center-cropped">
                                        <img src="https://www.rumahaspal.com/wp-content/uploads/2022/02/kontraktor-lapangan-futsal.jpg" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- <h2 class="section-title" sty>Pilih Titik</h2> -->
                        <section class="card mt-4 py-3">
                            <form action="/lapang/coba" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="px-3">
                                        <label for="name" class="form-label mt-4 px-3">Pilih Tanggal Booking</label>
                                    </div>
                                    <div class="col-3 col-md-3 col-lg-3 col-12 p-3">
                                        <div class="p-3">
                                            <input type="hidden" name="id_lapang" value="{{$id_lapang}}">
                                            <input type="text" class="form-control datepicker" name="tanggal_booking" id="tanggal_booking" placeholder="DD-MM-YYYY" value="">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-1 col-md-1 col-lg-1 col-12 p-3">
                                        <div class="p-3">
                                            <button type="submit" style="border-radius: 0.5em; width:100%;" class="btn btn-primary p-2">Set</button>
                                        </div>
                                    </div>
                                    <div class="col-8 col-md-8 col-lg-8 col-12 p-3">
                                    </div>
                                </div>
                            </form>
                            <p class="px-3">Tap pada item slot dibawah untuk memilih <b>Jadwal Booking</b></p>
                            <form action="/dashboard/daftar_booking/add" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_lapang" value="{{$id_lapang}}">
                                <input type="hidden" name="tanggal_booking" value="{{$data2->tanggal_booking}}">
                                @csrf
                                <div class="row text-center">
                                    @foreach($jadwal_tables as $index => $item2)
                                    @if($item2->is_active =='Active' && $index >= $data2->total_jam)
                                    <div class="col-2 col-md-2 col-lg-2 col-12 ">
                                        <div class="form-check ">
                                            <div class="card card_custom border" style="border-radius: 2em; box-shadow: 0px 10px 15px rgba(0,0,0,0.2);">
                                                <label class="form-check-label" for="">
                                                    <div class="card-body">
                                                        <input class="form-check-input" type="checkbox" name="checkbox[]" value="{{$item2->id}}" id="">
                                                        <img class="my-3" style="height: 50px;" src="{{ asset('img/jam.png') }}" alt="">
                                                        <h6 class="card-title jdwl">{{$item2->jadwal}}</h6>
                                                        <h6 class="card-subtitle mb-2 text-primary">Available</h6>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif($item2->is_active=='Active' && $item2->id == $jadwal_decode[$index])
                                    <div class="col-2 col-md-2 col-lg-2 col-12 ">
                                        <div class="form-check ">
                                            <div class="card card_custom border" style="border-radius: 2em; box-shadow: 0px 10px 15px rgba(0,0,0,0.2);">
                                                <label class="form-check-label" for="">
                                                    <div class="card-body">
                                                        <input class="form-check-input" type="checkbox" name="checkbox[]" value="{{$item2->id}}" id="">
                                                        <img class="my-3" style="height: 50px;" src="{{ asset('img/jam.png') }}" alt="">
                                                        <h6 class="card-title jdwl">{{$item2->jadwal}}</h6>
                                                        <h6 class="card-subtitle mb-2 text-danger">Booked</h6>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="row p-3">
                                    <div class="col">
                                        <button type="submit" style="border-radius: 0.5em; width:100%;" class="btn btn-primary p-2">Bayar</button>
                                    </div>
                                </div>
                            </form>

                        </section>
                    </div>
                </section>
            </div>


            @include('layouts.components.footer')
        </div>
    </div>

    @include('sweetalert::alert')


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

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

        $('#buttontanggasl').on('click', function() {
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
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>