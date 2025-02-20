<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\User;
use Alert;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash; //hash adalah library yang membantu kita meng enkripsi password
use Illuminate\Support\Facades\Storage; //menyimpan file selayaknya public dan storage menghubungkan ke public
//jika library ini di panggil, ketika mengambil dari github, harus melakukan proses pengetikan sebagai berikut
//php artisan storage:link, agar storage terhubung ke public


class UserController extends Controller
{
    //
    public function index(){
        $userAll = User::all();
        return view('admin.user.index', compact('userAll'));
    }
    public function activate(User $user){
        $user->is_active = true;
        $user->save();

        return redirect('admin/user')->with('success', 'User Berhasil diaktifkan');
    }
    public function showProfile(){
        $user = User::findOrFail(Auth::id());
        return view('admin.user.profile', compact('user'));
    }
    public function update(Request $request, $id){
        //validate
        request()->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|unique:users,email, '.$id.',id',
            'old_password' => 'nullable|string',
            'password' => 'nullable|required_with:old_password|string|confirmed|min:8',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->filled('old_password')){
            if(Hash::check($request->old_password, $user->password)){
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }   else{
                return back()
                ->withErrors(['old_password' => __('Tolong periksa passwordnya lagi')])
                ->withInput();
            }
        }
        if(request()->hasfile('foto')){
            //code di bawah ini untuk pengecekan apakah foto sudah ada atau belum
            if($user->foto && file_exists(storage_path('app/public/foto'))){
                Storage::delete('app/public/foto'.$user->foto);
            }
            //proses request foto setelah di cek
            $file = $request->file('foto');
            $fileName = 'foto'.uniqid().$file->getClientOriginalName();
            //pengecekan ekstension, dia sebagai .png .jpg dan seterusnya
            // $fileName = $file->getClientOriginalName().'.'. $file->getClinetOriginalExtension();
            //dimasukan ke file storage
            $request->foto->move(storage_path('app/public/foto/'), $fileName);
            //request menggunakan eloquent
            $user->foto = $fileName;
        }
        $user->role = $request->role;
        $user->save();
        return back()->with('succes', 'Profile Terupdate');
    }
}