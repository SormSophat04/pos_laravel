<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'producs';
    protected $fillable = [
      'name', 'price', 'qty', 'category', 'image', 'created_at', 'updated_at'
    ];
}
