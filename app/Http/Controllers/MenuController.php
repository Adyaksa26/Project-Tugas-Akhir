<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $menu = Menu::join('jenis_menu', 'jenis_menu_id', '=', 'jenis_menu.id')
            ->select('menu.*', 'jenis_menu.nama as jenis')
            ->get();
        return view('admin.menu.index', compact('menu'));
    }

    public function frondcoffees()
    {
        //
        $menu = Menu::join('jenis_menu', 'jenis_menu_id', '=', 'jenis_menu.id')
            ->select('menu.*', 'jenis_menu.nama as jenis')
            ->get();
        return view('frond.coffees', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $jenis_menu = DB::table('jenis_menu')->get();
        return view('admin.menu.create', compact('jenis_menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required|max:45',
            'harga' => 'required|numeric',
        ],
            [
                'nama.required' => 'Nama Wajib Diisi',
                'nama.max' => 'Nama maksimal 45 karakter',
                'harga.required' => 'Harga wajib diisi',
            ]
        );
        if (!empty($request->foto)) {
            // maka proses berikut yang dijalankan
            $fileName = 'foto' . uniqid() . ',' . $request->foto->extension();
            // setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('admin/img'), $fileName);
        } else {
            $fileName = '';
        }
        DB::table('menu')->insert([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'foto' => $fileName,
            'jenis_menu_id' => $request->jenis_menu_id,
        ]);
        Alert::success('Tambah Menu', 'Berhasil Menambahkan Menu');
        return redirect('admin/menu');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $menu = Menu::join('jenis_menu', 'jenis_menu_id', '=', 'jenis_menu.id')
            ->select('menu.*', 'jenis_menu.nama as jenis')
            ->where('menu.id', $id)
            ->get();
        return view('admin.menu.detail', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $jenis_menu = DB::table('jenis_menu')->get();
        $menu = DB::table('menu')->where('id', $id)->get();
        return view('admin.menu.edit', compact('jenis_menu', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $fotoLama = DB::table('menu')->select('foto')->where('id', $id)->get();
        foreach ($fotoLama as $f1) {
            $fotoLama = $f1->foto;
        }
        if (!empty($request->foto)) {

            if (!empty($fotoLama->foto)) {
                unlink(public_path('admin/img' . $fotoLama->foto));
            }

            // maka proses berikut yang dijalankan
            $fileName = 'foto' . uniqid() . ',' . $request->foto->extension();
            // setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('admin/img'), $fileName);
        } else {
            $fileName = '$fotoLama';
        }
        DB::table('menu')->where('id', $id)->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'foto' => $fileName,
            'jenis_menu_id' => $request->jenis_menu_id,
        ]);
        Alert::success('Update Menu', 'Berhasil Mengupdate Menu');
        return redirect('admin/menu');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('menu')->where('id', $id)->delete();
        return redirect('admin/menu');
    }
    public function menuApi(){
        $menu = Menu::join('jenis_menu', 'jenis_menu_id', '=', 'jenis_menu.id')
            ->select('menu.*', 'jenis_menu.nama as jenis')
            ->get();
            return response()->json([
                'success' => true,
                'message' => 'List Data Menu',
                'data' => $menu,
            ], 200);
    }
    public function menuApidetail($id){
        $menu = Menu::join('jenis_menu', 'jenis_menu_id', '=', 'jenis_menu.id')
            ->select('menu.*', 'jenis_menu.nama as jenis')
            ->where('menu.id', $id)
            ->first();
            if($menu){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Detail Menu',
                    'data'=> $menu,
                ], 200);
            } else
            return response()->json([
                'success'=> false,
                'message'=> 'Produk Tidak ditemukan'
            ], 404);
    }
}
