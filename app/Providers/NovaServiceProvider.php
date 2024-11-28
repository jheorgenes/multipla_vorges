<?php

namespace App\Providers;

use App\Nova\Brand;
use App\Nova\Client;
use App\Nova\Dashboards\Main;
use App\Nova\Installer;
use App\Nova\Operator;
use App\Nova\Permission;
use App\Nova\Regional;
use App\Nova\ServiceOrder;
use App\Nova\SimCard;
use App\Nova\TableService;
use App\Nova\Tracker;
use App\Nova\User;
use App\Nova\Webhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::resourcesIn(app_path('Nova'));

        // Exibindo o caminho da navegação
        Nova::withBreadcrumbs();

        // Nova::initialPath(''); Define o caminho inicial

        // Definindo a organização de navegação com menus
        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),

                MenuSection::make('Usuario', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Permission::class),
                    MenuItem::resource(Client::class),
                ])->icon('user')->collapsable(),

                MenuSection::make('Rastreamento', [
                    MenuItem::resource(Brand::class),
                    MenuItem::resource(Operator::class),
                    MenuItem::resource(SimCard::class),
                    MenuItem::resource(Tracker::class),
                    MenuItem::resource(Installer::class),
                    MenuItem::resource(Regional::class),
                    MenuItem::resource(TableService::class),
                    MenuItem::resource(ServiceOrder::class),
                ])->icon('chip')->collapsable(),

                MenuSection::make('Webhooks', [
                    MenuItem::resource(Webhook::class),
                ])->icon('cube')->collapsable(),
            ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes(default: true)
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
