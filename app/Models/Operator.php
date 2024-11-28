<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Operator extends Model
{
    protected $fillable = ['name'];

    public function sim_card(): HasMany
    {
        return $this->hasMany(SimCard::class);
    }

    public function trackers(): BelongsToMany
    {
        return $this->belongsToMany(Tracker::class, 'tracker_operator');
    }
}
