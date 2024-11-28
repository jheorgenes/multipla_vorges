<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Este namespace é aplicado aos controladores das rotas do seu aplicativo.
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Defina o namespace padrão para suas rotas do Nova.
     */
    protected $novaNamespace = 'App\\Nova\\Http\\Controllers';

    /**
     * Registre qualquer serviço de aplicação.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Registre as rotas da aplicação.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Registra as rotas da API.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Registra as rotas do Web.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
}
