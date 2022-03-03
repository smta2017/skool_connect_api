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
            'evaluation_card' => new EvaluationCardResource($this->EvaluationCard),
            'admission_status' => new AdmissionStatusResource($this->AdmissionStatus),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
