<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission extends Model
{
    protected $fillable = ['user_id', 'recurso', 'permissions'];

    /**
     * $casts faz a conversão do dado em JSON na tabela para array
     */
    protected $casts = ['permissions' => 'array'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
