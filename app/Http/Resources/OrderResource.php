<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "code" => $this->code,
            "time_delivery" => $this->time_delivery,
            "time_daley" => $this->time_daley,
            "delay" => DelayResource::collection($this->delayReports)
        ];
    }
}
