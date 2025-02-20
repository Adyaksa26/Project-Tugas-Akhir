<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;
    protected $table = 'ulasan';

    protected $fillable = [
        'ulasan', 'rating', 'pesanan_id'
    ];

    public function Ulasan(){
        return $this->belongsTo(Ulasan::class);
    }
}
