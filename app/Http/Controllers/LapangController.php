<?php

namespace App\Http\Controllers;

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
        // dd($request);
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
        $this->authorize('admin');
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

        for ($i = 0; $i < $jumlah_checkbox; $i++) {
            $post = DB::table('booking_tables')->insert([
                'invoice' => $invoice,
                'nama' => $user->name,
                'tanggal_booking' => $request->tanggal_booking,
                'no_lapang' => $request->id_lapang,
                'total_jam' => $jumlah_checkbox,
                'total_harga' => $harga_lapang->harga,
                'booked' => '1',
                'status' => 'On Progress',
                'jadwal_array' => $request->checkbox[$i],
            ]);
        }


        if ($post) {
            // return redirect('lapang/' . $request->id_lapang)->with('toast_success', 'Task Created Successfully!');
            return redirect('lapang/' . $request->id_lapang)->with('toast_success', 'Task Created Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
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
}
