<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toko extends Model
{
    use HasFactory;
    protected $fillable =['kode_barang', 'nama_barang', 'gambar_barang', 'harga_barang', 'stok_barang'];
    protected $table = 'toko';
    public $timestamps = false;
}
