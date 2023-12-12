<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['toko_id', 'quantity'];

    public function toko()
    {
        return $this->belongsTo(toko::class);
    }
}
 