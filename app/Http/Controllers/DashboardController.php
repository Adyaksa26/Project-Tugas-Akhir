<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\JenisMenu;
use App\Models\Pesanan;
use App\Models\JenisPesanan;
use DB;

class DashboardController extends Controller
{
    //
    public function index(){
        $menu = Menu::count();
        $pesanan = Pesanan::count();
        $jenis_menu = JenisMenu::count();
        $jenis_pesanan = JenisPesanan::count();
        $menuData = Menu::select('nama', 'harga')->get();
        $pesananData = Pesanan::select('metode_pembayaran', 'Menu_id')->get();
        // $menuData=json()['data'];
        // pengubahan data ke json
        // $role = DB::table('user')
        // ->selectRaw('r, count(r) as jumlah')
        // ->groupBy('r')
        // ->get();
        return view('admin.dashboard', 
        compact('menu', 'jenis_menu', 'pesanan', 'jenis_pesanan', 
        'menuData', 'pesananData'));
    }
}
