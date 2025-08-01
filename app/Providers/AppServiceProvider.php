<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\SchoolSession;
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
    View::composer('*', function ($view) {
        $activeSession = SchoolSession::where('is_active', true)->first();
        $view->with('activeSession', $activeSession);
    });
}

}
