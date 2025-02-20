<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Ulasan;

class HomeController extends Controller
{
    public function index()
    {
        $menu = menu::all();
        $ulasanAll = ulasan::join('pesanan', 'ulasan.pesanan_id', '=', 'pesanan.id')
                          ->select('ulasan.*', 'pesanan.no_meja as no_meja')
                          ->get();

        return view('frond.home', compact('menu', 'ulasanAll'));
    }
}
