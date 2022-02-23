<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParentResource extends JsonResource
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
            'first_name_en' => $this->first_name_en,
            'middle_name_en' => $this->middle_name_en,
            'last_name_en' => $this->last_name_en,
            'first_name_ar' => $this->first_name_ar,
            'middle_name_ar' => $this->middle_name_ar,
            'last_name_ar' => $this->last_name_ar,
            'marital_status_id' => $this->marital_status_id,
            'university' => $this->university,
            'occupation' => $this->occupation,
            'employer' => $this->employer,
            'type_of_business' => $this->type_of_business,
            'business_address' => $this->business_address,
            'business_mobile' => $this->business_mobile,
            'business_email' => $this->business_email,
            'alumni' => $this->alumni,
            'class_off' => $this->class_off,
            'type' => $this->type,
            'school' => $this->school,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
