<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseUnit extends Model
{

    protected $fillable = [
        'name',
        'description',
    ];

    public function uom():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Uom::class);
    }

}
