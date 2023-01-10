<?php

namespace App\AuditResolvers;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\Resolver;

class PlatformResolver implements Resolver
{

    public static function resolve(Auditable $auditable = null)
    {
        if(str_contains(url()->current(), '/admin')) {
            return 'admin_dashboard';
        }elseif (str_contains(url()->current(), '/api')) {
            return 'api';
        }

        return null;
    }
}
