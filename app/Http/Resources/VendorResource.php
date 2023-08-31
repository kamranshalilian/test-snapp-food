<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $row = [
            "id" => $this->id,
            "name" => $this->name,
            "orders" => OrderResource::collection($this->orders)
        ];
        $row["total_daley"] = $this->total_daley ?? 0;
        return $row;
    }
}
