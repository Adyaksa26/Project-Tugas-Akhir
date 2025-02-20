<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPesanan extends Model
{
    use HasFactory;
    protected $table = 'jenis_pesanan';

    protected $fillable = ['namapesanan'];

    public function Pesanan(){
        return $this->hasMany(Pesanan::class);
    }
}
