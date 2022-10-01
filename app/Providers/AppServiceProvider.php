<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Carbon::setLocale('pt');
        Blade::directive('money', function ($amount) {
            return "<?php echo   number_format($amount, 2) .' MT'; ?>";

            });


        Blade::directive('elton', function ($type) {

    if( $type==1){
    return "<?php echo Maqnta A  ?>";
    }else if( $type==2) {
    return "<?php echo Maqnta B ?>";
    }else {
    return "<?php echo Outro ?>";
    }



    });

}
}
