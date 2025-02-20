<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMenu extends Model
{
    use HasFactory;
    protected $table = 'Jenis_Menu';

    protected $fillable = ['nama'];

    public function Menu(){
        return $this->hasMany(Menu::class);
    }
}
