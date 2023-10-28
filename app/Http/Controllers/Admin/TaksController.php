<?php

namespace App\Http\Controllers\Admin;
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Taks;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
            /**
             * Menampilkan halaman Taks sesuai hak akses
             *  role_as = 1 adalah admin dan role_as = 0 adalah user
            */
        if(Auth::user()->role_as == 1){
            $taks = Taks::paginate(5);
            $judulhalaman = "Daftar Tugas";
            return view('admin.taks.index', compact(['judulhalaman','taks']));
        } else{
            $taks = Taks::where('id_user', Auth::id())->paginate(5);
            $judulhalaman = "Daftar Tugas";
            return view('admin.taks.index', compact(['judulhalaman','taks']));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        /**
         * Menampilkan halaman Tambah data Taks
         * Membuat Taks untuk user, hanya bisa menambahkan menggunakan hak akses admin
        */
        $judulhalaman = "Buat tugas";
        $user = User::where('role_as', '0')->get();
        return view('admin.taks.add', compact(['judulhalaman', 'user']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        /**
         * Insert data atau Menambah data Taks 
        */
        $taks = new Taks();
        if($request->hasFile('photo')){
            $request->file('photo')->move('assets/uploads/tugas', $request->file('photo')->getClientOriginalName());
            $taks->photo = $request->file('photo')->getClientOriginalName();
        }
        $taks->name = $request->name;
        $taks->description = $request->description;
        $taks->status = $request->status == TRUE ?'1':'0';
        $taks->id_user = $request->id_user;
        $taks->save();
        $pesan = "Tugas Berhasil Ditambahkan";
        return redirect('taks')->with('success', $pesan);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Taks  $taks
     * @return \Illuminate\Http\Response
     */
    public function viewTaks($id)
    {
        /**
         * Menampilkan Detail isi Taks, pada button view yang tersedia pada setiap data
        */
        $judulhalaman = "Detail Tugas";
        $taks = Taks::where('id', $id)->first();
        return view('admin.taks.viewTaks', compact(['judulhalaman', 'taks']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Taks  $taks
     * @return \Illuminate\Http\Response
     */
    public function edit(Taks $taks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Taks  $taks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taks $taks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Taks  $taks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /**
         * Menghapus atau delete data Taks
         * Menghapus data satu persatu
        */
        $taks = Taks::find($id);
        if($taks->photo){
            $path = 'assets/uploads/tugas'.$taks->photo;
            if(File::exists($path)){
                File::delete($path);
            }   
        }
        $taks->delete();
        $pesan = "Tugas Berhasil Dihapus";
        return redirect('taks')->with('success', $pesan);
    }

    public function destroyall(Request $request)
    {
        /**
         * Menghapus data Taks lebih dari 1 data
         * Menghapus dengan menggunakan checkbox, centang data yang akan dihapus
        */
        $itemsid = $request->itemsid;
        // dd($itemsid);
        if(is_null($itemsid)){
            $pesan ="Silahkan Pilih Item Yang Akan Dihapus";
            return redirect('taks')->with('warning', $pesan);
        }else{
            Taks::whereIn('id', $itemsid)->delete();
            $pesan = "Items Berhasil Di Hapus";
            return redirect('taks')->with('success', $pesan);   
        }
    }

    public function inserttaks(Request $request, $id){
        /**
         * Upload file data Taks untuk hak akses user
         * Hak akses user dapat mengupload docx/pdf dan mengganti status selesai mengerjakan
        */    
        $taks = Taks::find($id);
            if($request->hasFile('document')){ 
                $path = 'asset/uploads/document/'.$taks->document;
                if(File::exists($path)){
                    File::delete($path);
                }
                $request->file('document')->move('assets/uploads/document', $request->file('document')->getClientOriginalName());
                $taks->document = $request->file('document')->getClientOriginalName();
            }
            
            $taks->status = $request->status == TRUE ?'1':'0';
            $taks->update();
        $pesan = "Jawaban Berhasil Disimpan";
        return redirect('taks')->with('success', $pesan);
    }

    public function downloadtaks($id){
        /**
         * Download file Docs/Pdf
         * Hak askes admin dapat mendownload file docs/pdf yang sudah diupload user
         * 
        */
        $taks = DB::table('taks')->where('id', $id)->first();
        $pathToFile = public_path("assets/uploads/document{$taks->document}");
        return response()->download($pathToFile);
    }
}
