<?php

namespace App\Models;

use App\Traits\NotifiesWebhooks;
use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    use NotifiesWebhooks;

    protected $fillable = ['name', 'url_webhook', 'type_webhook', 'models_webhook'];

    protected $casts = [
        'models_webhook' => 'array',
    ];
}
