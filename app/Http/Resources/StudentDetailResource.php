<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentDetailResource extends JsonResource
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
            'student_id' => $this->student_id,
            'marital_status_id' => $this->marital_status_id,
            'bus' => $this->bus,
            'custodial_parent_name' => $this->custodial_parent_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
