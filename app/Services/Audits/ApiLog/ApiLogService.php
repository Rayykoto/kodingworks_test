<?php

namespace App\Services\Audits\ApiLog;

use OwenIt\Auditing\Models\Audit;

class ApiLogService
{
    public function getData($request)
    {
        $search = $request->search;

        // Get company
        $query = Audit::with('user')->where('platform', 'api');

        // Filter By Params
        $query->when(request('search', false), function ($q) use ($search) {
            $q->where('event', 'like', '%' . $search . '%');
        });

        return $query->paginate(10);
    }
}