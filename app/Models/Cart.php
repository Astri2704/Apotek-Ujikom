<?php

namespace App\Models;

use App\Models\Obat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $fillable = ['id', 'id_user', 'id_obat', 'jumlah', 'total_harga'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
