<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'division_id' => $this->division_id,
            'grade_id' => $this->grade_id,
            'class_id' => $this->class_id,
            'national_no' => $this->national_no,
            'passport_no' => $this->passport_no,
            'birth_date' => $this->birth_date,
            'birth_place' => $this->birth_place,
            'october_age_date' => $this->october_age_date,
            'academic_year_applying_id' => $this->academic_year_applying_id,
            'nationality_id' => $this->nationality_id,
            'gender_id' => $this->gender_id,
            'bus_id' => $this->bus_id,
            'religion_id' => $this->religion_id,
            'previous_school_nursery' => $this->previous_school_nursery,
            'address' => $this->address,
            'city' => $this->city,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'submit_date' => $this->submit_date,
            'photo' => $this->photo,
            'code' => $this->code,
            'lang_id' => $this->lang_id,
            'birth_certificate' => $this->birth_certificate,
            'academic_house' => $this->academic_house,
            'report_cards' => $this->report_cards,
            'referance_letter' => $this->referance_letter,
            'referance_name' => $this->referance_name,
            'referance_email' => $this->referance_email,
            'referance_phone' => $this->referance_phone,
            'enroll_date' => $this->enroll_date,
            'custody' => $this->custody,
            'foreigner' => $this->foreigner,
            'egy_returning' => $this->egy_returning,
            'transfer_from_cairo' => $this->transfer_from_cairo,
            'staff_child' => $this->staff_child,
            'staff_no' => $this->staff_no,
            'learn_support' => $this->learn_support,
            'learn_support_details' => $this->learn_support_details,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
