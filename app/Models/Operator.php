<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Operator extends Model
{
    protected $fillable = ['name'];

    public function sim_card(): HasMany
    {
        return $this->hasMany(SimCard::class);
    }

    public function tracker(): HasMany
    {
        return $this->hasMany(Tracker::class);
    }
}
