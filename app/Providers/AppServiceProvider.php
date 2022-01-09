<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Tema;

//use Carbon\Carbon;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'es');

        View::composer(['layouts.app','admin.articulos.index','admin.articulos.create' ,'admin.articulos.edit','moderador.articulos.create','moderador.articulos.edit','moderador.articulos.index','moderador.articulos.buscador'], function($view) 
        {
            $temasTodos=Tema::all();
            $view->with(compact('temasTodos'));
        });
    }
}
