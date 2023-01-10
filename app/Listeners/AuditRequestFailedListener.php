<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Event;
use OwenIt\Auditing\Events\AuditCustom;

class AuditRequestFailedListener
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
    public function handle($event)
    {
        $item = $event->item;
        $item->auditEvent = 'sync_permissions';
        $item->isCustomEvent = true;
        $item->auditCustomOld = $event->old_permissions;
        $item->auditCustomNew = $event->new_permissions;

        Event::dispatch(AuditCustom::class, [$item]);
    }
}
