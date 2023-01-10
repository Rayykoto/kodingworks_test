<?php

namespace App\AuditResolvers;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\Resolver;

class RequestResolver implements Resolver
{

    public static function resolve(Auditable $auditable = null)
    {
        if (isset($auditable['request'])) {
            return json_encode($auditable->request);
        }

        return null;
    }
}
