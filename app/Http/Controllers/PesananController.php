<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\JenisPesanan;
Use App\Models\User;
use DB;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Melakukan join antar tabel pesanan, jenis_pesanan, menu, dan user
    $pesanan = Pesanan::join('jenis_pesanan', 'pesananpelanggan.jenis_pesanan_id', '=', 'jenis_pesanan.id')
    ->select(
        'pesananpelanggan.*',
        'jenis_pesanan.nama as jenis_pesanan_nama'
    )
    ->get();

    foreach ($pesanan as $pesan) {
        $menuIds = $pesan->Menu_id;
    
        if (is_string($menuIds)) {
            $menuIds = json_decode($menuIds, true);
    
            if (is_array($menuIds)) {
                $namaMenu = [];
                foreach ($menuIds as $menuId) {
                    // Konversi ke integer dan log data
                    $menuIdInt = intval($menuId);
    
                    $menu = Menu::find($menuIdInt);
    
                    if ($menu) {
                        $namaMenu[] = $menu->nama;
                    } else {
                        Log::error("Menu dengan ID {$menuIdInt} tidak ditemukan.");
                    }
                }
                $pesan->nama_menu = implode(', ', $namaMenu);
            }
        } else {
            $pesan->nama_menu = null;
        }
    }
        // return print_r($pesanan);
    // Mengembalikan view dengan data yang telah di-join
    return view('admin.pesanan.index', compact('pesanan'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $jenis_pesanan = DB::table('jenis_pesanan')->get();
        $menu = DB::table('menu')->get();
        return view('admin.pesanan.create', compact('jenis_pesanan', 'menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_meja' => 'required|max:3',
            'metode_pembayaran' => 'required|max:45',
            'tgl_pesan' => 'required|date',
            'jam_pesan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],
        [
            'no_meja.max' => 'No Meja maksimal 3 karakter',
            'no_meja.required' => 'No Meja wajib diisi',
            'metode_pembayaran.required' => 'Motode Pembayaran wajib diisi',
            'tgl_pesan.required' => 'Tanggal Pesan wajib diisi',
            'jam_pesan.required' => 'Jam Pesan wajib diisi',
            'foto.max' => 'Foto maksimal 2 MB',
            'foto.mimes' => 'File ekstensi hanya bisa jpg,png,jpeg,gif,svg',
            'foto.image' => 'Foto harus berbentuk image'
        ]
        );
    
        if(!empty($request->foto)){
            // maka proses berikut yang dijalankan
            $fileName = 'foto'.uniqid().','.$request->foto->extension();
            // setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('admin/img'),$fileName);
        } else{
            $fileName = '';
        }
        //
        DB::table('pesananpelanggan')->insert([
            // 'user_id'=>$request->User_id,
            'no_meja'=>$request->no_meja,
            'metode_pembayaran'=>$request->metode_pembayaran,
            'bukti_pembayaran'=>$request->bukti_pembayaran,
            'tgl_pesan'=>$request->tgl_pesan,
            'jam_pesan'=>$request->jam_pesan,
            'foto'=>$fileName,
            'menu_id'=>'["0000000023"]',
            'jenis_pesanan_id'=>$request->jenis_pesanan_id,
            'deskripsi'=>$request->deskripsi,
        ]);
        return redirect('admin/pesanan')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pesanan = Pesanan::join('jenis_pesanan', 'pesananpelanggan.jenis_pesanan_id', '=', 'jenis_pesanan.id')
        ->join('menu', 'pesananpelanggan.menu_id', '=', 'menu.id')
        ->select(
            'pesananpelanggan.*',
            'jenis_pesanan.nama as jenis_pesanan_nama',
            'menu.nama as menu_nama')
        ->where('pesananpelanggan.id', $id)
        ->get();
        return view ('admin.pesananpelanggan.detail', compact('pesananpelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $pesanan = DB::table('pesananpelanggan')->where('id', $id)->get();
        $jenis_pesanan = DB::table('jenis_pesanan')->get();
        $menu = DB::table('menu')->get();
        return view('admin.pesananpelanggan.edit', compact('jenis_pesanan','menu','pesananpelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //foto lama 
       $fotoLama = Pesanan::select('foto')->where('id', $id)->get();
       foreach($fotoLama as $f1){
           $fotoLama = $f1->foto;
       }
        if(!empty($request->foto)){

        if(!empty($fotoLama->foto)) unlink(public_path('admin/img/'.$fotoLama->foto));
            // maka proses berikut yang dijalankan
            $fileName = 'foto'.$request->id.','.$request->foto->extension();
            // setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('admin/img/'),$fileName);
        } else{
            $fileName = '$fotoLama';
        }
        DB::table('pesanan')->where ('id',$id)->update([
            // 'user_id'=>$request->user_id,
            'no_meja'=>$request->no_meja,
            'metode_pembayaran'=>$request->metode_pembayaran,
            'bukti_pembayaran'=>$request->bukti_pembayaran,
            'tgl_pesan'=>$request->tgl_pesan,
            'jam_pesan'=>$request->jam_pesan,
            'foto'=>$fileName,
            'menu_id'=>$request->menu_id,
            'jenis_pesanan_id'=>$request->jenis_pesanan_id,
            'deskripsi'=>$request->deskripsi,
        ]);
        return redirect('admin/pesanan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('pesanan')->where('id', $id)->delete();
        return redirect ('admin/pesanan');
    }
}
