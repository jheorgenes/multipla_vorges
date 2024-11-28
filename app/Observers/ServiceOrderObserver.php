<?php

namespace App\Observers;

use App\Models\ServiceOrder;
use Illuminate\Validation\ValidationException;

class ServiceOrderObserver
{
    public function creating(ServiceOrder $serviceOrder)
    {
        if(!$serviceOrder->trackers || $serviceOrder->trackers->isEmpty()) {
            throw ValidationException::withMessages([
                'trackers' => ['Os ordens de serviço devem ter pelo menos um tracker associado'],
            ]);
        }
    }
}
