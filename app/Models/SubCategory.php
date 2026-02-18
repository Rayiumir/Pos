<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'title',
        'image',
        'is_active',
        'category_id'
    ];
}
