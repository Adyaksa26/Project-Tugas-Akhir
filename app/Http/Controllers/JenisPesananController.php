<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPesanan;
use Illuminate\Support\Facades\DB;

class JenisPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jenispesanan = DB::table('jenis_pesanan')->get();

        return view('admin.jenispesanan.index', compact('jenispesanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        DB::table('jenis_pesanan')->insert([
            'nama'=> $request->nama,
        ]);
        return redirect('admin/jenis_pesanan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
