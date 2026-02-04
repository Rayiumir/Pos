<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'price',
        'stock'
    ];

    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
