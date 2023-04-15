<?php

namespace App\Providers;

use App\Contracts\EventRegistrationService;
use App\Contracts\TicketReservationService;
use App\Repositories\EventRegistrationRepository;
use App\Repositories\TicketReservationRepository;
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
        //
    }
}
