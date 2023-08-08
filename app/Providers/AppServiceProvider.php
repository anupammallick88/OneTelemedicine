<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Language;
use App\Models\Models\Admin\Site;
use App\Models\Models\Appointment;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();


        if (file_exists(storage_path('installed'))) {
            $site  = Site::first();
            $allsettings = allsetting();
            view()->share(['site' => $site, 'allsettings' => $allsettings]);

            $language = Language::where('default', '1')->first();
            if ($language && !session('locale')) {
                $prefix = $language->prefix;
                App::setLocale($prefix);
                session()->put('locale', $prefix);
                session()->put('lang_dir', $language->direction);
            }
        }
    }
}
