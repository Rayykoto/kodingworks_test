<?php

namespace App\Services\Audits\AdminLog;

use OwenIt\Auditing\Models\Audit;

class AdminLogService
{
    public function getData($request)
    {
        $search = $request->search;

        // Get company
        $query = Audit::with('user')->where('platform', 'admin_dashboard');

        // Filter By Params
        $query->when(request('search', false), function ($q) use ($search) {
            $q->where('event', 'like', '%' . $search . '%');
        });
        
        return $query->paginate(10);
    }
}