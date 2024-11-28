<?php

namespace App\Traits;

use App\Models\Webhook;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait NotifiesWebhooks
{
    /**
     * Esse método é executado automaticamente quando o modelo é inicializado.
     * Ele define o que deve acontecer quando determinados eventos (como created) ocorrem no modelo.
     */
    public static function bootNotifiesWebhooks()
    {
        // static::created($model) - Evento do Eloquent chamado quando um novo registro é criado.
        static::created(function ($model) {
            // Aqui, ele chama o método notifyWebhooks.
            self::notifyWebhooks($model, 'Cadastro');
        });

        static::updated(function ($model) {
            self::notifyWebhooks($model, 'Atualizacao');
        });

        static::deleted(function ($model) {
            self::notifyWebhooks($model, 'Remocao');
        });
    }

    /**
     * Identifica o modelo (classe) que disparou o evento
     * Busca todos os webhooks no banco de dados configurados para monitorar esse modelo.
     * Envia um POST para cada URL do webhook com os dados do modelo no corpo da requisição.
     */
    private static function notifyWebhooks($model, $action)
    {
        // Obtem o nome da classe do modelo
        $modelName = get_class($model);

        // Busca todos os webhooks no banco de dados configurados para monitorar esse modelo
        $webhooks = Webhook::whereJsonContains('models_webhook', $modelName)
            ->where('type_webhook', $action)
            ->get();

        foreach ($webhooks as $webhook) {
            try {
                // Envia um POST para cada URL do webhook com os dados do modelo no corpo da requisição
                Http::post($webhook->url_webhook, $model->toArray());
            } catch (\Exception $e) {
                Log::error("Falha ao enviar webhook para {$webhook->url_webhook}: {$e->getMessage()}");
            }
        }
    }
}
