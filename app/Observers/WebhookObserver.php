<?php

namespace App\Observers;

use App\Models\Webhook;
use Illuminate\Support\Facades\Http;

class WebhookObserver
{
    /**
     * Handle the Webhook "created" event.
     */
    public function created(Webhook $webhook): void
    {
        $this->sendWebhook('created', $webhook);
    }

    /**
     * Handle the Webhook "updated" event.
     */
    public function updated(Webhook $webhook): void
    {
        $this->sendWebhook('updated', $webhook);
    }

    /**
     * Handle the Webhook "deleted" event.
     */
    public function deleted(Webhook $webhook): void
    {
        $this->sendWebhook('deleted', $webhook);
    }

    /**
     * Handle the Webhook "restored" event.
     */
    public function restored(Webhook $webhook): void
    {
        //
    }

    /**
     * Handle the Webhook "force deleted" event.
     */
    public function forceDeleted(Webhook $webhook): void
    {
        //
    }

    protected function sendWebhook($eventType, $model)
    {
        // Obtenha todos os webhooks registrados
        $webhooks = Webhook::all();

        foreach ($webhooks as $webhook) {
            if (in_array($eventType, $webhook->models_webhook)) { // Verifique se o evento está registrado para o modelo
                Http::post($webhook->url_webhook, [
                    'event' => $eventType,
                    'data' => $model,
                ]);
            }
        }
    }
}
