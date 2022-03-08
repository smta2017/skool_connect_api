<?php

namespace App\Repositories;

use App\Models\StudentStepParent;
use App\Repositories\BaseRepository;

/**
 * Class StudentStepParentRepository
 * @package App\Repositories
 * @version March 7, 2022, 1:27 pm UTC
*/

class StudentStepParentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'student_id',
        'name',
        'gender_id',
        'phone',
        'address',
        'email'
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
        return StudentStepParent::class;
    }
}
