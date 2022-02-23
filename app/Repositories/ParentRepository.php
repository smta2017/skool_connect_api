<?php

namespace App\Repositories;

use App\Models\StParent;
use App\Repositories\BaseRepository;

/**
 * Class ParentRepository
 * @package App\Repositories
 * @version February 22, 2022, 8:13 pm UTC
*/

class ParentRepository extends BaseRepository
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
        'marital_status_id',
        'university',
        'occupation',
        'employer',
        'type_of_business',
        'business_address',
        'business_mobile',
        'business_email',
        'alumni',
        'class_off',
        'school'
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
        return StParent::class;
    }
}
