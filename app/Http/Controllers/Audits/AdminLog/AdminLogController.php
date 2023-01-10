<?php

namespace App\Http\Controllers\Audits\AdminLog;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;
use App\Services\Audits\AdminLog\AdminLogService;
use App\Http\Resources\Audits\AdminLog\AdminLogListResource;

class AdminLogController extends AdminBaseController
{
    public function __construct(AdminLogService $adminLogService) {
        $this->adminLogService = $adminLogService;
        
        $this->title = "Audit Logs";
        $this->path = "audits/adminLog/index";
    }

    public function getData(Request $request)
    {
        try {
            $data = $this->adminLogService->getData($request);

            $result = new AdminLogListResource($data);
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }
}
