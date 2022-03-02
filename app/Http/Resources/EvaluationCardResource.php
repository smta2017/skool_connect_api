<?php

namespace App\Http\Resources;

use App\Models\Admission;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationCardResource extends JsonResource
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
            'student' => $this->Admission->Student,
            'exam_date' => $this->exam_date,
            'exam_building_id' => $this->exam_building_id,
            'exam_date2' => $this->exam_date2,
            'exam_building2_id' => $this->exam_building2_id,
            'meeting_date' => $this->meeting_date,
            'meeting_building_id' => $this->meeting_building_id,
            'reg_notes' => $this->reg_notes,
            'entrance_ability' => $this->entrance_ability,
            'entrance_recommendation' => $this->entrance_recommendation,
            'observation_comment' => $this->observation_comment,
            'principal_note' => $this->principal_note,
            'principal_recommendation' => $this->principal_recommendation,
            'principal_ability' => $this->principal_ability,
            'director_comment' => $this->director_comment,
            'application_status' => $this->application_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
