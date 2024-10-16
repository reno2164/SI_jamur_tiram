<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'idUser',
        'id_barang',
        'qty',
        'price',
        'status',
    ];
    public function product()
    {
        return $this->hasOne(product::class, 'id', 'id_barang');
    }
}
