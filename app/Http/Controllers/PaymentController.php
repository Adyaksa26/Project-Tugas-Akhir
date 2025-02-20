<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Ulasan;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
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
