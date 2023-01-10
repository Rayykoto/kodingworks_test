<?php

namespace App\Listeners;

use App\Events\Authentication\Login;
use App\Events\Authentication\Logout;
use Illuminate\Support\Facades\Event;
use OwenIt\Auditing\Events\AuditCustom;

class AuthenticationEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function auditUserLogin($event)
    {
        $user = $event->user;
        $user->auditEvent = 'login';
        $user->isCustomEvent = true;
        $user->auditCustomOld = $event->old_permissions;
        $user->auditCustomNew = $event->new_permissions;
        $user->request = $event->request;
        $user->response = $event->response;

        Event::dispatch(AuditCustom::class, [$user]);
    }

    public function auditUserLogout($event)
    {
        $user = $event->user;
        $user->auditEvent = 'logout';
        $user->isCustomEvent = true;
        $user->auditCustomOld = $event->old_permissions;
        $user->auditCustomNew = $event->new_permissions;
        $user->request = $event->request;
        $user->response = $event->response;

        Event::dispatch(AuditCustom::class, [$user]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        return [
            Login::class => 'auditUserLogin',
            Logout::class => 'auditUserLogout',
        ];
    }
}
