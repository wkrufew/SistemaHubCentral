<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
       /*  'App\Model' => 'App\Policies\ModelPolicy',*/
       'App\Articulo' => 'App\Policies\ArticuloPolicy',
       'App\ArticuloImagen' => 'App\Policies\ArticuloImagenPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
