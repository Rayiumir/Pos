<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseUnit extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function uom()
    {
        return $this->hasMany(Uom::class);
    }

}
