<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentPreviousSchoolResource extends JsonResource
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
            'year_attended' => $this->year_attended,
            'reason_for_leaving' => $this->reason_for_leaving,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
