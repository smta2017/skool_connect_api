<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'bus_no' => $this->bus_no,
            'brand' => $this->brand,
            'seat_count' => $this->seat_count,
            'license_no' => $this->license_no,
            'license_expire' => $this->license_expire,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
