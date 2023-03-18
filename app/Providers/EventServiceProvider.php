<?php

namespace App\Providers;

use App\Events\SendEmailEvent;
use App\Events\SendInvoiceEvent;
use App\Events\SendReceiptEvent;
use App\Listeners\SendEmailListener;
use App\Listeners\SendInvoiceListener;
use App\Listeners\SendReceiptListener;
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
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // ... other providers
            \SocialiteProviders\Telegram\TelegramExtendSocialite::class.'@handle',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            SendInvoiceEvent::class,
            [SendInvoiceListener::class, 'handle'],
        );
        Event::listen(
            SendReceiptEvent::class,
            [SendReceiptListener::class, 'handle'],
        );
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
