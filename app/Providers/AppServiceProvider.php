<?php
 

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
   
public function boot()
{
    // Tambahkan path baru untuk view
    View::addLocation(resource_path('view/src'));
}

}
