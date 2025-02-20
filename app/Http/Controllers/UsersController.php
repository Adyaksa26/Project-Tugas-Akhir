<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Pesanan;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = Users::all();
        return view ('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $pesanan = Pesanan::all();
        $role = ['Admin', 'User'];
        return view ('admin.users.create', compact('pesanan', 'role'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!empty($request->foto)){
            // maka proses berikut yang dijalankan
            $fileName = 'foto'.uniqid().','.$request->foto->extension();
            // setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('admin/img'),$fileName);
        } else{
            $fileName = '';
        }
        DB::table('user')->insert([
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'no_hp' => $request->no_hp,
            'foto' => $fileName,
            'role' => $request->role,
        ]);
       //tambah data menggunakan eloquent
    //    $users = new Users;
    //    $users->email = $request->email;
    //    $users->username = $request->username;
    //    $users->password = $request->password;
    //    $users->no_hp = $request->no_hp;
    //    $users->foto = $fileName;
    //    $users->role = $request->role;
    //    $users->kartu_id = $request->kartu_id;
        Alert::success('Tambah User', 'Berhasil Menambahkan User');
       return redirect('admin/users');
   }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show eloquent
        $users = Users::find($id);
        // dd($users);
        return view('admin.users.detail', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $u = Users::find($id);
        $pesanan = Pesanan::all();
        $role = ['Admin', 'User'];
        return view ('admin.users.edit', compact('u','pesanan', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
       //foto lama 
       $fotoLama = DB::table('user')->select('foto')->where('id',$id)->get();
        foreach($fotoLama as $f1){
            $fotoLama = $f1->foto;
        }
        if(!empty($request->foto)){

        if(!empty($fotoLama->foto)) unlink(public_path('admin/img'.$fotoLama->foto));
            // maka proses berikut yang dijalankan
            $fileName = 'foto'.uniqid().','.$request->foto->extension();
            // setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('admin/img'),$fileName);
        } else{
            $fileName = '$fotoLama';
        }
        //tambah data menggunakan eloquent
        DB::table('user')->where ('id', $id)->update([
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'no_hp' => $request->no_hp,
            'foto' => $fileName,
            'role' => $request->role,
        ]);
        Alert::success('Update User', 'Berhasil Mengupdate User');
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $users = Users::find($id);
        $users->delete();

        return redirect('admin/users');
    }
}
