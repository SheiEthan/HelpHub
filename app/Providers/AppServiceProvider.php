<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Whitecube\LaravelCookieConsent\Consent;
use Whitecube\LaravelCookieConsent\Facades\Cookies;
use Whitecube\LaravelCookieConsent\CookiesCategory;

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
        //        
        Cookies::essentials()
        ->session()
        ->csrf();

        // Register all Analytics cookies at once using one single shorthand method:
        // Cookies::analytics()
        //     ->google(env('GOOGLE_ANALYTICS_ID'));

        $category = Cookies::category(key: 'Actions de bénévolat proche de chez vous');


            // ->name('actions_proches')
            // ->description('Notre site helphub.fr utilise un traceur pour vous adresser des actions de bénévolat en fonction de votre localisation.');

        $category = Cookies::category(key: 'Actions de bénévolat ciblées');
            
        
        // Cookies::optional()
        //     ->name('darkmode_enabled')
        //     ->description('This cookie helps us remember your preferences regarding the interface\'s brightness.')
        //     ->duration(120);  
    }
            
}