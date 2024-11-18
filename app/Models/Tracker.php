<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tracker extends Model
{
    protected $fillable = ['imei', 'brand_id', 'model', 'gps', 'operator_id', 'sim_card_id', 'situationTracker'];

    protected $with = ['brand', 'operator', 'sim_card'];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class);
    }

    public function sim_card(): BelongsTo
    {
        return $this->belongsTo(SimCard::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
