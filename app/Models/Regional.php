<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Regional extends Model
{
    protected $fillable = ['name', 'box', 'active'];

    public function serviceOrder(): HasOne
    {
        return $this->hasOne(ServiceOrder::class);
    }
}
