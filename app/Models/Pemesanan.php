<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = "pemesanan";
    protected $primaryKey = "id";
    protected $fillable = ['id','tanggal_pemesanan','pesanan','jumlah_pemesanan','total_harga'];

    public function pemesanan(){
        return $this->hasMany(toko::class, 'toko_id');
    }
}
