<?php

namespace App\Http\Controllers;

use App\Models\DaftarBooking;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $this->authorize('admin');
        $booking = DB::table('booking_tables')->count();
        return view('layouts.booking.booking', ['booking_tables' => DaftarBooking::orderBy('id', 'asc')->paginate(10)], compact('booking'));
    }

    public function index2()
    {
        $this->authorize('admin');
        return view('layouts.booking.booking-create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $user = Auth::user();

        $invoice = 'INV' . rand(100000, 999999);

        $post = DB::table('booking_tables')->insert([
            'invoice' => $invoice,
            'nama' => $user->name,
            'tanggal_booking' => $request->tanggal_booking,
            'no_lapang' => $request->no_lapang,
            'total_jam' => 1,
            'total_harga' => $request->total_harga,
            'booked' => '1',
            'status' => 'On Progress',
            'jadwal_array' => $request->pilih_jam,
        ]);

        if ($post) {
            // return redirect('lapang/' . $request->id_lapang)->with('toast_success', 'Task Created Successfully!');
            return redirect('dashboard/daftar_booking')->with('toast_success', 'Task Created Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }
    public function update($id)
    {
        $this->authorize('admin');
        $data = DB::table('booking_tables')->where('id', $id)->first();
        // dd($data->jadwal_array);
        // dd($hitung);

        return view('layouts.booking.booking-edit', ['data' => $data]);
    }
    public function updated(Request $request)
    {


        $post = DB::table('booking_tables')->where('id', $request->id)->update([
            'nama' => $request->nama,
            'no_lapang' => $request->no_lapang,
            // 'total_jam' => $request->total_jam,
            'total_harga' => $request->total_harga,
            'status' => $request->status,
            'tanggal_booking' => $request->tanggal_booking
        ]);

        if ($post) {
            return redirect('/dashboard/daftar_booking')->with('toast_success', 'Task Updated Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }
    public function delete($id)
    {
        $this->authorize('admin');
        $post = DB::table('booking_tables')->where('id', $id)->delete();
        if ($post) {
            return redirect('/dashboard/daftar_booking')->with('toast_success', 'Task Deleted Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }

    public function cari(Request $request)
    {

        $this->authorize('admin');
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $booking = DB::table('booking_tables')
            ->where('nama', 'like', "%" . $cari . "%")
            ->paginate(10);

        // mengirim data booking ke view index
        return view('layouts.booking.booking', ['booking_tables' => $booking], compact('booking'));
    }
    // public function cektgl(Request $request)
    // {
    //     // dd($request);
    //     $this->authorize('admin');
    //     $data = DB::table('booking_tables')->where('tanggal_booking', $request->tanggal_booking)->get();
    //     dd($data);
    //     // return view('layouts.lapang.lapang-1', ['data2' => $data2]);
    //     // return response()->json($data2);
    // }
}
