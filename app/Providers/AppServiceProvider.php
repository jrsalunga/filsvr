<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $websitesettings = \App\WebsiteSetting::first();
    $contact_number = "N/A";
    if($websitesettings)
        $contact_number = ($websitesettings->telephone_no !="") ? $websitesettings->telephone_no : "N/A";
    view()->share('website_telephone_number', $contact_number);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
