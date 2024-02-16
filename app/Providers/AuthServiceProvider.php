<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Exceptions\CustomMissingScopeException;
use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Laravel\Passport\Exceptions\MissingScopeException;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();


        $permissions = Cache::remember('passport_permissions',100, function () {
            $permissions = Permission::all();

            return collect($permissions)->mapWithKeys(function ($item) {
                return [$item->name => $item->name];
            })->all();
        });
        
        Passport::tokensCan($permissions);
    }
}
