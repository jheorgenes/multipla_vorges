<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tracker extends Model
{
    protected $fillable = ['imei', 'brand_id', 'model', 'gps', 'situationTracker'];

    protected $with = ['brand', 'operators', 'simCards'];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function simCards(): BelongsToMany
    {
        return $this->belongsToMany(SimCard::class, 'tracker_sim_card');
    }

    public function operators(): BelongsToMany
    {
        return $this->belongsToMany(Operator::class, 'tracker_operator');
    }

    public function serviceOrders(): BelongsToMany
    {
        return $this->belongsToMany(ServiceOrder::class, 'service_order_tracker', 'tracker_id', 'service_order_id');
    }

    // Novo método auxiliar
    public function relatedServiceOrders(): BelongsToMany
    {
        return $this->serviceOrders(); // Apenas retorna o relacionamento original
    }
}
