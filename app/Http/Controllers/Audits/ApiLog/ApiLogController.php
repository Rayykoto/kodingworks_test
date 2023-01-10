<?php

namespace App\Http\Controllers\Audits\ApiLog;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;
use App\Services\Audits\ApiLog\ApiLogService;
use App\Http\Resources\Audits\AdminLog\AdminLogListResource;

class ApiLogController extends AdminBaseController
{
    public function __construct(ApiLogService $apiLogservice)
    {
        $this->apiLogservice = $apiLogservice;

        $this->title = "Audit Logs";
        $this->path = "audits/apiLog/index";
    }

    public function getData(Request $request)
    {
        try {
            $data = $this->apiLogservice->getData($request);

            $result = new AdminLogListResource($data);
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }
}
