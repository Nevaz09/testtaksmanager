<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function users(){
        /**
         * Menampilkan halaman data seluruh users
         * dapat diakses jika menggunakan hak akses admin 
        */
        $judulhalaman = "Pengguna Terdaftar";
        $users = User::paginate(10);
        return view('admin.users.index', compact(['judulhalaman', 'users']));
    }

    public function viewUsers($id){
        /**
         * Menampilkan halaman detail data users
         * dapat diakses jika menggunakan hak akses admin
        */
        $judulhalaman = "Detail Pengguna";
        $users = User::find($id);
        return view('admin.users.view', compact(['judulhalaman', 'users']));
    }

    public function editUsers($id){
        /**
         * Menampilkan halaman edit data seluruh users
         * dapat diakses jika menggunakan hak akses admin
        */
        $judulhalaman = "Edit Pengguna";
        $users = User::find($id);
        return view('admin.users.edit', compact(['judulhalaman', 'users']));
    }

    public function updateUsers (Request $request, $id){
        /**
         * Edit data users
         * dapat diakses jika menggunakan hak akses admin
        */
        $users = User::find($id);
        $users->name = $request->name;
        $users->last_name = $request->last_name;
        $users->no_telp = $request->no_telp;
        $users->alamat = $request->alamat;
        $users->posisi = $request->posisi;
        $users->update();
        $pesan = "Data User Sudah Diupdate";
        return redirect('users')->with('success', $pesan);
    }
}
