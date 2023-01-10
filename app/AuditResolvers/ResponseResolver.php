<?php

namespace App\AuditResolvers;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\Resolver;

class ResponseResolver implements Resolver
{

    public static function resolve(Auditable $auditable = null)
    {
        if (isset($auditable['response'])) {
            return json_encode($auditable->response);
        }

        return null;
    }
}
