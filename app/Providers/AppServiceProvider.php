<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        //variables globales
        view()->composer('layouts.template', function($view){
        $institucion = \App\Models\Institucion::count();
        $paciente = \App\Models\Paciente::count();
        $medico = \App\Models\Medico::count();
        $unidad = \App\Models\unidad::count();
        $view->with([
            'institucion'=> $institucion,
            'paciente'=> $paciente,
            'medico'=> $medico,
            'unidad'=> $unidad,            
            ]);
        });
    }
}
