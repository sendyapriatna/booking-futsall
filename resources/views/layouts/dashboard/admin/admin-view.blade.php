@extends('layouts.app2')

@section('title2', 'Booking')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Daftar Admin</h1>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Admin</li>
            </ol>
        </nav>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card mt-2">
                    <div class="row">
                        <div class="col m-3">
                            <div class="d-flex justify-content-end">
                                <form action="/dashboard/admin/cari" class="form-inline" method="post">
                                    @csrf
                                    <input class="form-control" type="text" name="cari" placeholder="Search" aria-label="Search" value="{{ old('cari') }}">
                                    <button class="btn btn-success m-1" type="submit">Search</button>
                                    <a href="{{ url('/dashboard/admin/create') }}" class="btn btn-primary">Add Data</a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">

                            <table class="table-striped mb-0 table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Hp</th>
                                        <th>Tgl Dibuat</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $index => $item2)
                                    @php $path = Storage::url('public/'.$item2->image); @endphp
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td><img style="max-width: 50px;" src="{{ url($path) }}" alt=""></td>
                                        <td>{{$item2->name}}</td>
                                        <td>{{$item2->username}}</td>
                                        <th>+{{$item2->nohp}}</th>
                                        <td>{{date('d-m-Y', strtotime($item2->created_at))}}</td>
                                        <td>
                                            <div class=" row">
                                                <!-- <a href="/dashboard/daftar_booking/detail/{{ $item2->id}}" style="border-radius: 0.5em;" class="btn btn-primary mr-1"><i class="fa-solid fa-circle-info"></i></a> -->
                                                <a href="/dashboard/admin/edit/{{ $item2->id}}" style="border-radius: 0.5em;" class="btn btn-warning mr-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="/dashboard/admin/delete/{{ $item2->id}}" style="border-radius: 0.5em;" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
                                        <!-- <td>
                                            <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                        </td> -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                <h6 class="m-3">{{ $users->links('pagination::bootstrap-4') }}</h4>
                            </div>
                        </div>
                    </div>
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