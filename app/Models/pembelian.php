<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelians';
    public $timestamps = true;
    protected $fillable = [
        'id_pembelian',
        'id_product',
        'qty',
        'price',
        'status',
    ];

    
    public function product()
    {
        return $this->hasOne(product::class, 'id', 'id_product');
    }
}
