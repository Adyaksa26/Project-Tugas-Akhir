<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoffeesController extends Controller
{
    /**
     * Menampilkan halaman daftar kopi.
     */
    public function coffees()
    {
        // Logika untuk mengambil data kopi dari model atau lainnya
        // Misalnya:
        // $coffees = Coffee::all();

        // Mengembalikan view 'coffees.blade.php' dengan data kopi
        // return view('coffees', compact('coffees'));
        return "Ini adalah halaman daftar kopi";
    }

    /**
     * Menampilkan detail kopi berdasarkan ID.
     */
    public function show($id)
    {
        // Logika untuk menampilkan detail kopi berdasarkan $id
        // Misalnya:
        // $coffee = Coffee::findOrFail($id);

        // Mengembalikan view 'coffee_detail.blade.php' dengan data kopi
        // return view('coffee_detail', compact('coffee'));
        return "Ini adalah halaman detail kopi dengan ID: $id";
    }

    /**
     * Menambahkan kopi ke dalam keranjang belanja.
     */
    public function addToCart($id)
    {
        // Logika untuk menambahkan kopi dengan ID $id ke dalam keranjang belanja
        // Misalnya:
        // $coffee = Coffee::findOrFail($id);
        // Cart::add(['id' => $coffee->id, 'name' => $coffee->name, 'price' => $coffee->price, 'quantity' => 1]);

        // Redirect atau respons sukses
        return "Kopi dengan ID $id berhasil ditambahkan ke dalam keranjang belanja";
    }
}
