<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Services\KomisiServices;
use App\Services\Rules\RulesPeriode;
use App\Services\Rules\RulesBarang;
use App\Services\Rules\RulesPemasok;
use App\Services\Rules\RulesKomisi;
use App\Services\Rules\RulesSales;
use App\Services\Rules\RulesInterface;

use App\Services\Pembelian\PembelianService;
use App\Services\Pembelian\Tipe\PenagihanService;


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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        if (config('app.env') === 'development') {
            URL::forceScheme('https');
        }
        $this->app->bind(KomisiServices::class, function ($app) {
            return new KomisiServices(
                $app->make(RulesPeriode::class),
                $app->make(RulesBarang::class),
                $app->make(RulesPemasok::class),
                $app->make(RulesKomisi::class),
                $app->make(RulesSales::class)
            );
        });

   

        $this->app->bind(PenagihanService::class, function ($app) {
            // Resolve the dependency from the container
            return new PenagihanService(
                $app->make(PembelianService::class)
            );
            
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
            URL::forceScheme('https');
    
    }
}
