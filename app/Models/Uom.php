<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    protected $fillable = [
        'name',
        'code',
        'base_unit_id',
        'symbol',
        'description',
        'is_active'
    ];

    public function baseUnits(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BaseUnit::class, 'base_unit_id');
    }

}
