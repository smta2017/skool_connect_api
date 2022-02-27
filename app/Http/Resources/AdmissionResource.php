<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdmissionResource extends JsonResource
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
            'parent1_id' => $this->parent1_id,
            'parent2_id' => $this->parent2_id,
            'admission_status_id' => $this->admission_status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
