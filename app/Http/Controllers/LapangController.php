<?php

namespace App\Http\Controllers;

use App\Models\DaftarBooking;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class LapangController extends Controller
{
    public function lapang1($request)
    {
        // $this->authorize('admin');
        $datalapang = DB::table('lapangan_tables')->where('id', $request)->first();

        $id_lapang = $request;
        $user = Auth::user();
        $tanggal = Carbon::today();

        $data = Db::table('jadwal_tables as j')
            ->select('j.*', 'bt.*')
            ->leftJoin('booking_tables as bt', 'bt.jadwal_array', '=', 'j.id')
            // ->where('bt.tanggal_booking', $tanggal_sekarang)
            // ->where('bt.booked', '0')
            ->get();
        // dd($data);
        $data2 = Db::table('jadwal_tables as j')
            ->select('j.*', 'bt.*')
            ->leftJoin('booking_tables as bt', 'bt.jadwal_array', '=', 'j.id')
            ->where('bt.tanggal_booking', '=', $tanggal)->get();
        return view('layouts.lapang.lapang-1', ['jadwal_tables' => $data, 'jadwal_tables2' => $data2, 'data' => $datalapang], compact('id_lapang', 'tanggal'));
    }
    public function lapang2(Request $request)
    {
        // $this->authorize('admin');
        // $this->validate($request, [
        //     'jadwal_array' => 'required',
        // ]);
        if ($request->checkbox == null) {
            return redirect('lapang/' . $request->id_lapang)->with('toast_warning', 'Please Select 1 Checkbox!');
        }
        $user = Auth::user();
        $jumlah_checkbox = count($request->checkbox);


        // hitung jumlah harga 
        $harga_lapang = DB::table('lapangan_tables')->where('id', $request->id_lapang)->first();



        $invoice = 'INV' . rand(100000, 999999);

        // MIDTRANS PAYMENT
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $invoice,
                'gross_amount' => $jumlah_checkbox * $harga_lapang->harga,
            ),
            'customer_details' => array(
                'first_name' => $user->name,
                'phone' => $user->nohp,
                'email' => $user->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        for ($i = 0; $i < $jumlah_checkbox; $i++) {
            $post = DB::table('booking_tables')->insert([
                'invoice' => $invoice,
                'nama' => $user->name,
                'tanggal_booking' => $request->tanggal_booking,
                'no_lapang' => $request->id_lapang,
                'total_jam' => $jumlah_checkbox,
                'total_harga' => $harga_lapang->harga,
                'booked' => '1',
                'status' => 'Unpaid',
                'jadwal_array' => $request->checkbox[$i],
                'snap_token' => $snapToken,
            ]);
        }

        $get_data_booking = DB::table('booking_tables')->where('invoice', $invoice)->get();
        $count_get_data_booking = count($get_data_booking);
        $grand_total = $count_get_data_booking * $get_data_booking[0]->total_harga;

        // Mengambil data jadwal berdasarkan id di table jadwal_tables
        for ($j = 0; $j < $count_get_data_booking; $j++) {
            $get_data_jadwal[$j] = DB::table('jadwal_tables')->where('id', $request->checkbox[$j])->first();
        }

        return view('layouts.lapang.lapang-checkout', compact('get_data_booking', 'grand_total', 'snapToken', 'count_get_data_booking', 'get_data_jadwal'));
    }
    public function cektgl(Request $request)
    {
        // dd($request);
        $datalapang = DB::table('lapangan_tables')->where('id', $request->id_lapang)->first();
        // $this->authorize('admin');
        $id_lapang = $request->id_lapang;
        $tanggal = $request->tanggal_booking;

        // $data = DB::table('booking_tables')->where('tanggal_booking', $request->tanggal_booking)->get();
        // dd($data);

        $data = DB::table('jadwal_tables')
            ->select('*')
            ->whereNotIn('id', DB::table('booking_tables')->select('jadwal_array')->where('tanggal_booking', '=', $request->tanggal_booking))->get();
        // dd($data);
        $data2 = Db::table('jadwal_tables as j')
            ->select('j.*', 'bt.*')
            ->leftJoin('booking_tables as bt', 'bt.jadwal_array', '=', 'j.id')
            ->where('bt.tanggal_booking', '=', $request->tanggal_booking)->get();
        // dd($data2);
        return view('layouts.lapang.lapang-1', ['jadwal_tables' => $data, 'jadwal_tables2' => $data2, 'data' => $datalapang], compact('id_lapang', 'tanggal'));
    }
    public function booking($request)
    {
        // dd($request);
        $data = DB::table('booking_tables')->where('invoice', $request)->first();
        $post = DB::table('booking_tables')->where('invoice', $request)->update([
            'status' => 'Paid',
        ]);
        if ($post) {
            return redirect('lapang/' . $data->no_lapang)->with('toast_success', 'Payment Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }
}
