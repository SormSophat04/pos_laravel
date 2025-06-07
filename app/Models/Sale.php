<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'total',
        'cash_received',
        'change',
        'payment_type'
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
