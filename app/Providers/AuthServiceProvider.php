<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use App\Models\Clase;
use App\Policies\ClasePolicy;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
       Clase::class => ClasePolicy::class, // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('accion', 'App\Policies\AdminPolicy@metodo');
        //
    }
}
