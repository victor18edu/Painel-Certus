<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Arquivo;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
       // User::class => TaskPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('cliente_empresa', function(User $user){
            return $user->level_id == "1";
        });
        Gate::define('adm_empresa', function(User $user){
            return $user->level_id== "2";
        });
        Gate::define('adm_sistema', function(User $user){

            return $user->level_id == "3";

        });
        Gate::define('super_adm', function(User $user){
            return $user->level_id == "4";
        });

    }
}
