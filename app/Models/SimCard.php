<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SimCard extends Model
{
    protected $fillable = ['operator_id', 'number', 'situationSIM'];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class);
    }

    public function tracker(): HasOne
    {
        return $this->hasOne(Tracker::class);
    }
}
