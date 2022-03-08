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
            'student' => new StudentResource($this->Student),
            'parent1' => new ParentResource($this->Parent1),
            'parent2' => new ParentResource($this->Parent2),
            'apply_reason' => $this->apply_reason,
            'apply_month' => $this->apply_month,
            'evaluation_card' => new EvaluationCardResource($this->EvaluationCard),
            'admission_status' => new AdmissionStatusResource($this->AdmissionStatus),
            'division' => new DivisionResource($this->Division),
            'grade' => new GradeResource($this->Grade),
            'apply_year' => new ApplyYearResource($this->ApplyYear),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
