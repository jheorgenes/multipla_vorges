<?php

namespace App\Providers;

use App\Models\Brand;
use App\Policies\BrandPolicy;
use App\Policies\InstallerPolicy;
use App\Policies\RegionalPolicy;
use App\Policies\ServiceOrderPolicy;
use App\Policies\SimCardPolicy;
use App\Policies\TableServicePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Client;
use App\Models\Installer;
use App\Models\Operator;
use App\Models\Permission;
use App\Models\Regional;
use App\Models\ServiceOrder;
use App\Models\SimCard;
use App\Models\TableService;
use App\Policies\ClientPolicy;
use App\Policies\OperatorPolicy;
use App\Policies\PermissionPolicy;

// Classe criada manualmente para associar policies a models
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Client::class => ClientPolicy::class,
        Permission::class => PermissionPolicy::class,
        Brand::class => BrandPolicy::class,
        Installer::class => InstallerPolicy::class,
        Operator::class => OperatorPolicy::class,
        Regional::class => RegionalPolicy::class,
        ServiceOrder::class => ServiceOrderPolicy::class,
        SimCard::class => SimCardPolicy::class,
        TableService::class => TableServicePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
