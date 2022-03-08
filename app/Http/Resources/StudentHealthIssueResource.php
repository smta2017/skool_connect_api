<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentHealthIssueResource extends JsonResource
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
            'issue' => $this->issue,
            'doctor_name' => $this->doctor_name,
            'doctor_phone' => $this->doctor_phone,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
