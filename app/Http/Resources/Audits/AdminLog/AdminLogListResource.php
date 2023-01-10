<?php

namespace App\Http\Resources\Audits\AdminLog;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminLogListResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->transformCollection($this->collection),
            'meta' => [
                "success" => true,
                "message" => "Success get admin log lists",
                'pagination' => $this->metaData()
            ]
        ];
    }

    private function transformData($data)
    {
        return [
            'id' => $data->id,
            'status_code' => $data->status_code,
            'user' => $data->user,
            'event' => $data->event,
            'type' => class_basename($data->auditable_type),
            'platform' => $data->platform,
            'old_values' => $data->old_values,
            'new_values' => $data->new_values,
            'request' => json_decode($data->request),
            'response' => json_decode($data->response),
            'status_code' => $data->status_code,
            'url' => $data->url,
            'ip_address' => $data->ip_address,
            'user_agent' => $data->user_agent,
            'created_at' => Carbon::parse($data->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($data->updated_at)->format('Y-m-d H:i:s')
        ];
    }

    private function transformCollection($collection)
    {
        return $collection->transform(function ($data) {
            return $this->transformData($data);
        });
    }

    private function metaData()
    {
        return [
            "total" => $this->total(),
            "count" => $this->count(),
            "per_page" => (int)$this->perPage(),
            "current_page" => $this->currentPage(),
            "total_pages" => $this->lastPage(),
            "links" => [
                "next" => $this->nextPageUrl()
            ],
        ];
    }
}
