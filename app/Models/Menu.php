<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';

    protected $fillable = [
        'nama', 'harga', 'Jenis_Menu_id'
    ];

    public function Jenis_Menu(){
        return $this->belongsTo(JenisMenu::class);
    }
}
