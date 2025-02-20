<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = 'user';

    protected $fillable = ['email', 'username', 'password', 'no_hp', 'foto', 'role'];

    public function Pesanan(){
        return $this->hasMany(Pesanan::class);
    }
}
