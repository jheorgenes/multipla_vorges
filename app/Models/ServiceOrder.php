<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ServiceOrder extends Model
{
    protected $fillable = ['service', 'date', 'associate', 'plate', 'total_value', 'payment_date', 'situationOS', 'regional_id', 'table_service_id'];

    protected $casts = [
        'date'=> 'date:d-m-Y',
        'payment_date' => 'date:d-m-Y',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $lastEntry = static::orderBy('service', 'desc')->first();
            $model->service = $lastEntry ? $lastEntry->service + 1 : 1;
        });
    }

    public function table_service(): BelongsTo
    {
        return $this->belongsTo(TableService::class);
    }

    public function regional(): BelongsTo
    {
        return $this->belongsTo(Regional::class);
    }

    public function trackers(): BelongsToMany
    {
        return $this->belongsToMany(Tracker::class, 'service_order_tracker', 'service_order_id', 'tracker_id');
    }
}
