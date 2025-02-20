<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\JenisMenu;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BerandaController extends Controller
{
    public function index()
    {
        $menu = Menu::join('jenis_menu', 'jenis_menu_id', '=', 'jenis_menu.id')
            ->select('menu.*', 'jenis_menu.nama as jenis')
            ->get();
        return view('frond.home', compact('menu'));
    }

    public function addToCart($id)
    {
        $menu = Menu::find($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "nama" => $menu->nama,
                "quantity" => 1,
                "harga" => $menu->harga,
                "foto" => $menu->foto
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk Berhasil di Tambahkan!');
    }

    public function detail($id)
    {
        $menu = Menu::join('jenis_menu', 'jenis_menu_id', '=', 'jenis_menu.id')
            ->select('menu.*', 'jenis_menu.nama as jenis')
            ->where('menu.id', $id)
            ->get();

        return view('frond.detail', compact('menu'));
    }

    public function cart()
    {
        $cart = session()->get('cart');
        $total = 0;
        $snapToken = null; // Initialize $snapToken as null

        if ($cart && count($cart) > 0) { // Check if cart is not empty
            foreach ($cart as $key => $menu) {
                $total += $menu['harga'] * $menu['quantity'];
            }

            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $total,
                ),
                'customer_details' => array(
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);
        }

        return view('frond.shop_cart', compact('cart', 'total', 'snapToken'));
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk Berhasil di Hapus!');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->quantity as $id => $quantity) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);

        $total = 0;
        foreach ($cart as $details) {
            $total += $details['harga'] * $details['quantity'];
        }

        return response()->json(['success' => true, 'total' => $total]);
    }
}
