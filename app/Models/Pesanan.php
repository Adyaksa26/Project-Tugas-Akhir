<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesananpelanggan';

    protected $fillable = [
        'no_meja', 'metode_pembayaran','bukti_pembayaran','tgl_pesan','jam_pesan','Menu_id','User_id' ,'Jenis_Pesanan_id'
    ];

    public function Jenis_Pesanan(){
        return $this->belongsTo(JenisPesanan::class);

    }
    
}
