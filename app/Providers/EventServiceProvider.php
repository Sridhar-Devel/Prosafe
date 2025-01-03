<?php

namespace App\Providers;

use App\Models\Agreement;
use App\Models\Customer;
use App\Models\Tennure;
use App\Models\Visit;
use App\Observers\AgreementObserver;
use App\Observers\CustomerObserver;
use App\Observers\TennureObserver;
use App\Observers\VisitObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Customer::observe(CustomerObserver::class);
        Agreement::observe(AgreementObserver::class);
        Tennure::observe(TennureObserver::class);
        Visit::observe(VisitObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
