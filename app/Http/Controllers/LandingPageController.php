<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('layouts.content.landing-page', ['lapangan_tables' => Lapangan::orderBy('id', 'asc')->paginate(20)]);
    }
}
