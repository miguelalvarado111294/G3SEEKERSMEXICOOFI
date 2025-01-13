<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Añadir esta línea

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Forzar el uso de HTTPS
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https'); // Usar URL::forceScheme
        }

        // Configurar la paginación con Bootstrap
        Paginator::useBootstrap();
    }
}
