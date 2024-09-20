<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });




Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// DASHBOARD
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
Route::get('/dashboard/admin', [App\Http\Controllers\DashboardController::class, 'admin']);
Route::get('/dashboard/admin/create', [App\Http\Controllers\DashboardController::class, 'createAdmin']);
Route::post('/dashboard/admin/add', [App\Http\Controllers\DashboardController::class, 'addAdmin']);
Route::get('/dashboard/admin/edit/{id}', [App\Http\Controllers\DashboardController::class, 'updateAdmin']);
Route::post('/dashboard/admin/updated', [App\Http\Controllers\DashboardController::class, 'updatedAdmin']);
Route::post('/dashboard/admin/updated2', [App\Http\Controllers\DashboardController::class, 'updatedAdmin2']);
Route::get('/dashboard/admin/delete/{id}', [App\Http\Controllers\DashboardController::class, 'deleteAdmin']);
Route::post('/dashboard/admin/cari', [App\Http\Controllers\DashboardController::class, 'cariAdmin']);

Route::get('/dashboard/user', [App\Http\Controllers\DashboardController::class, 'user']);
Route::get('/dashboard/user/create', [App\Http\Controllers\DashboardController::class, 'createUser']);
Route::post('/dashboard/user/add', [App\Http\Controllers\DashboardController::class, 'addUser']);
Route::get('/dashboard/user/edit/{id}', [App\Http\Controllers\DashboardController::class, 'updateUser']);
Route::post('/dashboard/user/updated', [App\Http\Controllers\DashboardController::class, 'updatedUser']);
Route::post('/dashboard/user/updated2', [App\Http\Controllers\DashboardController::class, 'updatedUser2']);
Route::get('/dashboard/user/delete/{id}', [App\Http\Controllers\DashboardController::class, 'deleteUser']);
Route::post('/dashboard/user/cari', [App\Http\Controllers\DashboardController::class, 'cariUser']);

Route::get('/dashboard/lapangan', [App\Http\Controllers\DashboardController::class, 'lapangan']);
Route::get('/dashboard/lapangan/create', [App\Http\Controllers\DashboardController::class, 'createLapangan']);
Route::post('/dashboard/lapangan/add', [App\Http\Controllers\DashboardController::class, 'addLapangan']);
Route::get('/dashboard/lapangan/edit/{id}', [App\Http\Controllers\DashboardController::class, 'updateLapangan']);
Route::post('/dashboard/lapangan/updated', [App\Http\Controllers\DashboardController::class, 'updatedLapangan']);
Route::post('/dashboard/lapangan/updated2', [App\Http\Controllers\DashboardController::class, 'updatedLapangan2']);
Route::get('/dashboard/lapangan/delete/{id}', [App\Http\Controllers\DashboardController::class, 'deleteLapangan']);


Route::get('/dashboard/lapangan', [App\Http\Controllers\DashboardController::class, 'lapangan']);
Route::get('/dashboard/jadwal', [App\Http\Controllers\DashboardController::class, 'jadwal']);
Route::get('/dashboard/jadwal/status/{id}', [App\Http\Controllers\DashboardController::class, 'updatedJadwal']);

// BOOKING
Route::get('/dashboard/daftar_booking', [App\Http\Controllers\BookingController::class, 'index']);
Route::get('/dashboard/daftar_booking/create', [App\Http\Controllers\BookingController::class, 'index2']);
Route::post('/dashboard/daftar_booking/add', [App\Http\Controllers\BookingController::class, 'store']);
Route::get('/dashboard/daftar_booking/edit/{id}', [App\Http\Controllers\BookingController::class, 'update']);
Route::post('/dashboard/daftar_booking/update', [App\Http\Controllers\BookingController::class, 'updated']);
Route::get('/dashboard/daftar_booking/delete/{id}', [App\Http\Controllers\BookingController::class, 'delete']);
Route::post('/dashboard/daftar_booking/cari', [App\Http\Controllers\BookingController::class, 'cari']);


Route::post('/lapang/setcoba', [App\Http\Controllers\BookingController::class, 'cektgl']);


// LAPANG
Route::get('/lapang/{id}', [App\Http\Controllers\LapangController::class, 'lapang1']);
Route::post('/lapang/store', [App\Http\Controllers\LapangController::class, 'lapang2'])->middleware('auth');
// Route::post('/lapang/setcoba', [App\Http\Controllers\BookingController::class, 'cek']);
Route::post('/lapang/setdate', [App\Http\Controllers\LapangController::class, 'cektgl']);

// USER PROFILE
Route::get('/landingpage/profil/{id}', [App\Http\Controllers\DashboardController::class, 'indexProfile'])->middleware('auth');
Route::post('/landingpage/profil/updated', [App\Http\Controllers\DashboardController::class, 'updatedProfile'])->middleware('auth');
Route::post('/landingpage/profil/updated2', [App\Http\Controllers\DashboardController::class, 'updatedProfile2'])->middleware('auth');
