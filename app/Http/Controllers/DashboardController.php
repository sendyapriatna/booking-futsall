<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Lapangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $this->authorize('admin');
        return view('layouts.dashboard.dashboard');
    }

    // CONTROLLER ADMIN
    public function admin()
    {
        $this->authorize('admin');
        // $admin = DB::table('users')->count();
        // return view('layouts.dashboard.admin-view', ['users' => DB::table('users')->where('role', 'admin')->paginate(10)], compact('admin'));
        return view('layouts.dashboard.admin.admin-view', ['users' => DB::table('users')->where('role', 'admin')->paginate(10)]);
    }

    public function createAdmin()
    {
        $this->authorize('admin');
        return view('layouts.dashboard.admin.admin-create');
    }

    public function addAdmin(Request $request)
    {
        // dd($request);

        $validatedData = $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required',
            'username' => 'required',
            'nohp' => 'required',
            'password' => ['required', 'string', 'min:8'],
            'image' => 'image|file|max:2048',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('public/post-image-profile');
        }

        // $post = User::Create($validatedData);
        $post = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'nohp' => $request->nohp,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'created_at' => Carbon::now(),
            'image' => $request->file('image')->store('post-image-profile'),
        ]);

        if ($post) {
            return redirect('/dashboard/admin')->with('toast_success', 'Task Created Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }
    public function updateAdmin($id)
    {
        $this->authorize('admin');
        $data = DB::table('users')->where('id', $id)->first();
        return view('layouts.dashboard.admin.admin-edit', ['data' => $data]);
    }

    public function updatedAdmin(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|min:5',
            'email' => 'required',
            'username' => 'required',
            'nohp' => 'required',
            'image' => 'image|file|max:2048',
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                if ($request->oldImage == "/post-image-profile/default/avatar-1.png") {
                    $validatedData['image'] = $request->file('image')->store('public/post-image-profile');
                } else {
                    Storage::delete($request->oldImage);
                }
            }
            $validatedData['image'] = $request->file('image')->store('public/post-image-profile');

            $post = DB::table('users')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'nohp' => $request->nohp,
                'image' => $request->file('image')->store('post-image-profile')

            ]);
        } else {
            $post = DB::table('users')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'nohp' => $request->nohp,
                'image' => $request->oldImage
            ]);
        }
        if ($post) {
            return redirect('/dashboard/admin/edit/' . $request->id)->with('toast_success', 'Task Updated Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }

    public function updatedAdmin2(Request $request)
    {
        // $id2 = $request->id2;
        $this->validate($request, [
            'oldpasswordInput' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8']
        ]);
        $auth = DB::table('users')->find($request->id2);

        $passwordbaru = preg_replace("/[^a-zA-Z0-9]/", "", $request->password);
        $password_confirmation = preg_replace("/[^a-zA-Z0-9]/", "", $request->password_confirmation);

        $data = strlen($passwordbaru);
        $data2 = strlen($password_confirmation);

        // The passwords matches
        if (!Hash::check($request->get('oldpasswordInput'), $auth->password)) {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Password not match!');
        }

        // Current password and new password same
        if (strcmp($request->get('oldpasswordInput'), $request->password) == 0) {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }

        if ($request->password != $request->password_confirmation) {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'New password and password confirmation not match');
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->password);
        $output = $user->save();
        if ($output == true) {
            return redirect('/dashboard/admin/edit/' . $request->id2)->with('toast_success', 'Task Updated Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }
    public function deleteAdmin($id)
    {
        $this->authorize('admin');
        $post = DB::table('users')->where('id', $id)->delete();
        if ($post) {
            return redirect('/dashboard/admin/')->with('toast_success', 'Task Deleted Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }

    public function cariAdmin(Request $request)
    {

        $this->authorize('admin');
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $name = DB::table('users')
            ->where('name', 'like', "%" . $cari . "%")
            ->paginate(10);

        // mengirim data name ke view index
        return view('layouts.dashboard.admin.admin-view', ['users' => $name], compact('name'));
    }

    // END CONTROLLER ADMIN


    // CONTROLLER USER

    public function user()
    {
        $this->authorize('admin');
        return view('layouts.dashboard.user.user-view', ['users' => DB::table('users')->where('role', 'user')->paginate(10)]);
    }

    public function createUser()
    {
        $this->authorize('admin');
        return view('layouts.dashboard.user.user-create');
    }

    public function addUser(Request $request)
    {
        // dd($request);

        $validatedData = $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required',
            'username' => 'required',
            'nohp' => 'required',
            'password' => ['required', 'string', 'min:8'],
            'image' => 'image|file|max:2048',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('public/post-image-profile');
        }

        // $post = User::Create($validatedData);
        $post = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'nohp' => $request->nohp,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'created_at' => Carbon::now(),
            'image' => $request->file('image')->store('post-image-profile'),
        ]);

        if ($post) {
            return redirect('/dashboard/user')->with('toast_success', 'Task Created Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }
    public function updateUser($id)
    {
        $this->authorize('admin');
        $data = DB::table('users')->where('id', $id)->first();
        return view('layouts.dashboard.user.user-edit', ['data' => $data]);
    }

    public function updatedUser(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|min:5',
            'email' => 'required',
            'username' => 'required',
            'nohp' => 'required',
            'image' => 'image|file|max:2048',
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                if ($request->oldImage == "/post-image-profile/default/avatar-1.png") {
                    $validatedData['image'] = $request->file('image')->store('public/post-image-profile');
                } else {
                    Storage::delete($request->oldImage);
                }
            }
            $validatedData['image'] = $request->file('image')->store('public/post-image-profile');

            $post = DB::table('users')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'nohp' => $request->nohp,
                'image' => $request->file('image')->store('post-image-profile')

            ]);
        } else {
            $post = DB::table('users')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'nohp' => $request->nohp,
                'image' => $request->oldImage
            ]);
        }
        if ($post) {
            return redirect('/dashboard/user/edit/' . $request->id)->with('toast_success', 'Task Updated Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }

    public function updatedUser2(Request $request)
    {
        // $id2 = $request->id2;
        $this->validate($request, [
            'oldpasswordInput' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8']
        ]);
        $auth = DB::table('users')->find($request->id2);

        $passwordbaru = preg_replace("/[^a-zA-Z0-9]/", "", $request->password);
        $password_confirmation = preg_replace("/[^a-zA-Z0-9]/", "", $request->password_confirmation);

        $data = strlen($passwordbaru);
        $data2 = strlen($password_confirmation);

        // The passwords matches
        if (!Hash::check($request->get('oldpasswordInput'), $auth->password)) {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Password not match!');
        }

        // Current password and new password same
        if (strcmp($request->get('oldpasswordInput'), $request->password) == 0) {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }

        if ($request->password != $request->password_confirmation) {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'New password and password confirmation not match');
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->password);
        $output = $user->save();
        if ($output == true) {
            return redirect('/dashboard/user/edit/' . $request->id2)->with('toast_success', 'Task Updated Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }
    public function deleteUser($id)
    {
        $this->authorize('admin');
        $post = DB::table('users')->where('id', $id)->delete();
        if ($post) {
            return redirect('/dashboard/user/')->with('toast_success', 'Task Deleted Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }

    public function cariUser(Request $request)
    {

        $this->authorize('admin');
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $name = DB::table('users')
            ->where('name', 'like', "%" . $cari . "%")
            ->paginate(10);

        // mengirim data name ke view index
        return view('layouts.dashboard.user.user-view', ['users' => $name], compact('name'));
    }

    // END CONTROLLER USER


    // CONTROLLER LAPANGAN

    public function lapangan()
    {
        $this->authorize('admin');
        return view('layouts.dashboard.lapangan.lapangan-view', ['lapangan_tables' => Lapangan::orderBy('id', 'asc')->paginate(10)]);
    }

    public function createLapangan()
    {
        $this->authorize('admin');
        return view('layouts.dashboard.lapangan.lapangan-create');
    }

    public function addLapangan(Request $request)
    {

        // dd($request);
        $this->validate($request, [
            'deskripsi' => 'required',
            'harga' => 'required',
            'panjang' => 'required',
            'lebar' => 'required',
            'jarijari' => 'required',
            'material' => 'required',
            'image' => 'image|file|max:2048',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('public/post-image-profile');
        }

        // $post = User::Create($validatedData);
        $post = DB::table('lapangan_tables')->insert([
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'jarijari' => $request->jarijari,
            'material' => $request->material,
            'created_at' => Carbon::now(),
            'image' => $request->file('image')->store('post-image-profile'),
        ]);

        if ($post) {
            return redirect('/dashboard/lapangan')->with('toast_success', 'Task Created Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }

    public function updateLapangan($id)
    {
        $this->authorize('admin');
        $data = DB::table('lapangan_tables')->where('id', $id)->first();
        return view('layouts.dashboard.lapangan.lapangan-edit', ['data' => $data]);
    }

    public function updatedLapangan(Request $request)
    {

        $this->validate($request, [
            'deskripsi' => 'required',
            'harga' => 'required',
            'panjang' => 'required',
            'lebar' => 'required',
            'jarijari' => 'required',
            'material' => 'required',
            'image' => 'image|file|max:2048',
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                if ($request->oldImage == "/post-image-profile/default/avatar-1.png") {
                    $validatedData['image'] = $request->file('image')->store('public/post-image-profile');
                } else {
                    Storage::delete($request->oldImage);
                }
            }
            $validatedData['image'] = $request->file('image')->store('public/post-image-profile');

            $post = DB::table('lapangan_tables')->where('id', $request->id)->update([
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'panjang' => $request->panjang,
                'lebar' => $request->lebar,
                'jarijari' => $request->jarijari,
                'material' => $request->material,
                'created_at' => Carbon::now(),
                'image' => $request->file('image')->store('post-image-profile'),

            ]);
        } else {
            $post = DB::table('lapangan_tables')->where('id', $request->id)->update([
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'panjang' => $request->panjang,
                'lebar' => $request->lebar,
                'jarijari' => $request->jarijari,
                'material' => $request->material,
                'created_at' => Carbon::now(),
                'image' => $request->oldImage
            ]);
        }
        if ($post) {
            return redirect('/dashboard/lapangan/edit/' . $request->id)->with('toast_success', 'Task Updated Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }

    public function deleteLapangan($id)
    {
        $this->authorize('admin');
        $post = DB::table('lapangan_tables')->where('id', $id)->delete();
        if ($post) {
            return redirect('/dashboard/lapangan/')->with('toast_success', 'Task Deleted Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }

    // END CONTROLLER LAPANGAN


    // CONTROLLER JADWAL

    public function jadwal()
    {
        $this->authorize('admin');
        return view('layouts.dashboard.jadwal.jadwal-view', ['jadwal_tables' => Jadwal::orderBy('id', 'asc')->paginate(20)]);
    }

    public function updatedJadwal($id)
    {
        $data = DB::table('jadwal_tables')->where('id', $id)->first();
        // dd($data);

        if ($data->is_active == 'Active') {
            $post = DB::table('jadwal_tables')->where('id', $id)->update([
                'is_active' => 'NonActive',
            ]);
            if ($post) {
                return redirect('/dashboard/jadwal')->with('toast_success', 'Non Active');
            } else {
                return redirect()
                    ->back()
                    ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
            }
        } else {
            $post = DB::table('jadwal_tables')->where('id', $id)->update([
                'is_active' => 'Active',
            ]);
            if ($post) {
                return redirect('/dashboard/jadwal')->with('toast_success', 'Active');
            } else {
                return redirect()
                    ->back()
                    ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
            }
        }
    }

    // PROFILE USER
    public function indexProfile($id)
    {
        // $this->authorize('admin');
        $data = DB::table('users')->where('id', $id)->first();
        return view('layouts.dashboard.profil.profil', ['data' => $data]);
    }

    public function updatedProfile(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|min:5',
            'email' => 'required',
            'username' => 'required',
            'nohp' => 'required',
            'image' => 'image|file|max:2048',
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                if ($request->oldImage == "/post-image-profile/default/avatar-1.png") {
                    $validatedData['image'] = $request->file('image')->store('public/post-image-profile');
                } else {
                    Storage::delete($request->oldImage);
                }
            }
            $validatedData['image'] = $request->file('image')->store('public/post-image-profile');

            $post = DB::table('users')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'nohp' => $request->nohp,
                'image' => $request->file('image')->store('post-image-profile')

            ]);
        } else {
            $post = DB::table('users')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'nohp' => $request->nohp,
                'image' => $request->oldImage
            ]);
        }
        if ($post) {
            return redirect('/landingpage/profil/' . $request->id)->with('toast_success', 'Task Updated Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }

    public function updatedProfile2(Request $request)
    {
        // $id2 = $request->id2;
        $this->validate($request, [
            'oldpasswordInput' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8']
        ]);
        $auth = DB::table('users')->find($request->id2);

        $passwordbaru = preg_replace("/[^a-zA-Z0-9]/", "", $request->password);
        $password_confirmation = preg_replace("/[^a-zA-Z0-9]/", "", $request->password_confirmation);

        $data = strlen($passwordbaru);
        $data2 = strlen($password_confirmation);

        // The passwords matches
        if (!Hash::check($request->get('oldpasswordInput'), $auth->password)) {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Password not match!');
        }

        // Current password and new password same
        if (strcmp($request->get('oldpasswordInput'), $request->password) == 0) {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }

        if ($request->password != $request->password_confirmation) {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'New password and password confirmation not match');
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->password);
        $output = $user->save();
        if ($output == true) {
            return redirect('/landingpage/profil/' . $request->id2)->with('toast_success', 'Task Updated Successfully!');
        } else {
            return redirect()
                ->back()
                ->withInput()->with('toast_warning', 'Some problem occurred, please try again');
        }
    }
    // END PROFILE USER
}
