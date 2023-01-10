<?php

namespace App\Models;

use OwenIt\Auditing\Contracts\Auditable; 
use OwenIt\Auditing\Auditable as AuditableTrait;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole implements Auditable
{
    use AuditableTrait;

    protected $casts = [
        'is_default' => 'boolean'
    ];
}
