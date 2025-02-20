<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\JenisMenu;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MenuResource;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    //
    public function index(){
        $menu = Menu::join('jenis_menu', 'jenis_menu_id', '=', 'jenis_menu.id')
            ->select('menu.*', 'jenis_menu.nama as jenis')
            ->get();
            return new MenuResource(true, 'List Data menu', $menu);
    }
    public function show($id){
        $menu = Menu::join('jenis_menu', 'jenis_menu_id', '=', 'jenis_menu.id')
            ->select('menu.*', 'jenis_menu.nama as jenis')
            ->where('menu.id', $id)
            ->first();
            if($menu){
                return new MenuResource(true, 'Detail Data Menu', $menu);
            } else
            return response()->json([
                'success'=> false,
                'message'=> 'Menu Tidak ditemukan'
            ], 404);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nama' => 'required|max:45',
            'harga' => 'required|numeric',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $menu = Menu::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'foto' => $request->foto,
            'Jenis_Menu_id' => $request->Jenis_Menu_id,
            'updated_at'=>$request->updated_at,
            'created_at' => $request->created_at
        ]);
        return new MenuResource(true, 'Data menu berhasil ditambah', $menu);
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'nama' => 'required|max:45',
            'harga' => 'required|numeric',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $menu = Menu::whereId($id)->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'foto' => $request->foto,
            'Jenis_Menu_id' => $request->Jenis_Menu_id,
            'updated_at'=>$request->updated_at,
            'created_at' => $request->created_at
        ]);
        return new MenuResource(true, 'Data menu berhasil diubah', $menu);
    }
    public function destroy($id){
        $menu = Menu::whereId($id)->first();
        $menu->delete();
        return new MenuResource(true, 'Data menu berhasil dihapus', $menu);
    }
}
