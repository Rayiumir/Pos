<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'image',
        'is_active'
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
