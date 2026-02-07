<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'price',
        'stock',
        'image'
    ];

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
