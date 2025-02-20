<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;
use App\Models\Pesanan;
use DB;

class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ulasan = Ulasan::join('pesanan', 'pesanan_id', '=', 'pesanan.id')
        ->select('ulasan.*', 'pesanan.no_meja as pesan')
        ->get();
        $pesanan = Pesanan::all();
        return view ('admin.ulasan.index', compact('ulasan', 'pesanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $pesanan = Pesanan::all();
        return view('admin.ulasan.create', compact('pesanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ulasan' => 'required',
            'pesanan_id' => 'required',
            'rating' => 'required',
        ]);
        //
        DB::table('ulasan')->insert([
            'ulasan'=>$request->ulasan,
            'pesanan_id'=>$request->pesanan_id,
            'rating'=>$request->rating,
        ]);
        session()->forget('cart');
        return redirect('admin/ulasan')->with('success', 'Terima kasih telah memberi ulasan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $ulasan = Ulasan::join('pesanan', 'pesanan_id', '=', 'pesanan.id')
        ->select('ulasan.*', 'pesanan.no_meja as pesan_')
        ->where('ulasan.id', $id)
        ->first();
        $pesanan = Pesanan::all();
        return view ('admin.ulasan.index', compact('ulasan', 'pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $ulasan = Ulasan::find($id);
        $pesanan = Pesanan::all();
        return view('admin.ulasan.edit', compact('ulasan', 'pesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'ulasan' => 'required',
            'pesanan_id' => 'required',
            'rating' => 'required',
        ]);
        DB::table('ulasan')->where ('id', $id)->update([
            'ulasan'=>$request->ulasan,
            'pesanan_id'=>$request->pesanan_id,
            'rating'=>$request->rating,
        ]);
        return redirect('admin/ulasan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
