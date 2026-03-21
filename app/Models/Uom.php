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

    public function base_unit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BaseUnit::class);
    }

}
