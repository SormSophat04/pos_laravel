<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
        'sale_id',
        'product_name',
        'quantity',
        'price',
        'total'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
