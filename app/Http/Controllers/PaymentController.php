<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\JenisPesanan;
use App\Models\Ulasan;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function index()
{
    // Melakukan join antar tabel pesanan, jenis_pesanan, menu, dan user
    $pesanan = Pesanan::join('jenis_pesanan', 'pesananpelanggan.jenis_pesanan_id', '=', 'jenis_pesanan.id')
    ->select(
        'pesananpelanggan.*',
        'jenis_pesanan.nama as jenis_pesanan_nama'
    )
    ->get();

    foreach ($pesanan as $pesan) {
        $menuIds = $pesan->Menu_id;
    
        if (is_string($menuIds)) {
            $menuIds = json_decode($menuIds, true);
    
            if (is_array($menuIds)) {
                $namaMenu = [];
                foreach ($menuIds as $menuId) {
                    // Konversi ke integer dan log data
                    $menuIdInt = intval($menuId);
    
                    $menu = Menu::find($menuIdInt);
    
                    if ($menu) {
                        $namaMenu[] = $menu->nama;
                    } else {
                        Log::error("Menu dengan ID {$menuIdInt} tidak ditemukan.");
                    }
                }
                $pesan->nama_menu = implode(', ', $namaMenu);
            }
        } else {
            $pesan->nama_menu = null;
        }
    }
    // Mengembalikan view dengan data yang telah di-join
    return view('admin.pesanan.index', compact('pesanan'));
}
    public function create()
{
    //
    $jenis_pesanan = DB::table('jenis_pesanan')->get();
    $menu = DB::table('menu')->get();
    return view('admin.pesanan.create', compact('jenis_pesanan', 'menu'));
}

/**
 * Store a newly created resource in storage.
 */
    public function store(Request $request)
{
    $request->validate([
        'no_meja' => 'required|max:3',
        'metode_pembayaran' => 'required|max:45',
        'tgl_pesan' => 'required|date',
        'jam_pesan' => 'required',
        'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ],
    [
        'no_meja.max' => 'No Meja maksimal 3 karakter',
        'no_meja.required' => 'No Meja wajib diisi',
        'metode_pembayaran.required' => 'Motode Pembayaran wajib diisi',
        'tgl_pesan.required' => 'Tanggal Pesan wajib diisi',
        'jam_pesan.required' => 'Jam Pesan wajib diisi',
        'foto.max' => 'Foto maksimal 2 MB',
        'foto.mimes' => 'File ekstensi hanya bisa jpg,png,jpeg,gif,svg',
        'foto.image' => 'Foto harus berbentuk image'
    ]
    );

    if(!empty($request->foto)){
        // maka proses berikut yang dijalankan
        $fileName = 'foto'.uniqid().','.$request->foto->extension();
        // setelah tau fotonya sudah masuk maka tempatkan ke public
        $request->foto->move(public_path('admin/img'),$fileName);
    } else{
        $fileName = '';
    }
    //
    DB::table('pesananpelanggan')->insert([
        // 'user_id'=>$request->User_id,
        'no_meja'=>$request->no_meja,
        'metode_pembayaran'=>$request->metode_pembayaran,
        'bukti_pembayaran'=>$request->bukti_pembayaran,
        'tgl_pesan'=>$request->tgl_pesan,
        'jam_pesan'=>$request->jam_pesan,
        'foto'=>$fileName,
        'menu_id'=>json_encode($request->menu_ids),
        'jenis_pesanan_id'=>$request->jenis_pesanan_id,
        'deskripsi'=>$request->deskripsi,
    ]);
    return redirect('admin/pesanan')->with('success', 'Berhasil menambahkan data');
}

    public function showPaymentForm($pesanan_id)
    {
        $pesanan = Pesanan::find($pesanan_id);

        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $pesanan->id,
                'gross_amount' => $pesanan->total_harga,
            ],
            'customer_details' => [
                'first_name' => $pesanan->user->name,
                'email' => $pesanan->user->email,
                'phone' => $pesanan->user->phone,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('frond.payment_form', compact('pesanan', 'snapToken'));
    }

    public function processPayment(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashedKey = hash('sha512', $serverKey);

        $signatureKey = $request->input('signature_key');
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $grossAmount = $request->input('gross_amount');

        $pesanan = Pesanan::findOrFail($orderId);

        if ($signatureKey === $hashedKey) {
            if ($statusCode == 200) {
                // Update order status to paid
                $pesanan->status = 'paid';
                $pesanan->save();

                // menambah record pesanan disini

                // Redirect to review form
                return redirect()->route('ulasan.create', ['pesanan_id' => $orderId]);
            } else {
                // Handle failed payment
                return redirect()->route('cart')->with('error', 'Payment failed');
            }
        } else {
            // Handle invalid signature
            return redirect()->route('cart')->with('error', 'Invalid signature');
        }
    }
}
