<?php

namespace App\Listeners;

use App\Events\Role\RoleCreated;
use App\Events\Role\RoleUpdated;
use Illuminate\Support\Facades\Event;
use OwenIt\Auditing\Events\AuditCustom;

class RoleEventSubscriber
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
    public function auditSyncRolePermissions($event)
    {
        $role = $event->role;
        $role->auditEvent = 'sync_permissions';
        $role->isCustomEvent = true;
        $role->auditCustomOld = $event->old_permissions;
        $role->auditCustomNew = $event->new_permissions;

        Event::dispatch(AuditCustom::class, [$role]);
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
            RoleCreated::class => 'auditSyncRolePermissions',
            RoleUpdated::class => 'auditSyncRolePermissions'
        ];
    }
}
