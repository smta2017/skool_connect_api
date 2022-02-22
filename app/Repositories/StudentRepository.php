<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\BaseRepository;

/**
 * Class StudentRepository
 * @package App\Repositories
 * @version February 21, 2022, 8:55 pm UTC
*/

class StudentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name_en',
        'middle_name_en',
        'last_name_en',
        'first_name_ar',
        'middle_name_ar',
        'last_name_ar',
        'division_id',
        'grade_id',
        'class_id',
        'national_no',
        'passport_no',
        'birth_date',
        'birth_place',
        'october_age_date',
        'academic_year_applying_id',
        'nationality_id',
        'gender_id',
        'bus_id',
        'religion_id',
        'previous_school_nursery',
        'address',
        'city',
        'email',
        'mobile',
        'submit_date',
        'photo',
        'code',
        'lang_id',
        'user_id',
        'birth_certificate',
        'academic_house',
        'report_cards',
        'referance_letter',
        'referance_name',
        'referance_email',
        'referance_phone',
        'enroll_date',
        'custody',
        'foreigner',
        'egy_returning',
        'transfer_from_cairo',
        'staff_child',
        'staff_no',
        'learn_support',
        'learn_support_details'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Student::class;
    }
}
