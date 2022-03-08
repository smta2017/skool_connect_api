<?php

namespace App\Repositories;

use App\Models\StudentParent;
use App\Repositories\BaseRepository;

/**
 * Class StudentParentRepository
 * @package App\Repositories
 * @version March 7, 2022, 1:52 pm UTC
*/

class StudentParentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'student_id',
        'parent_id'
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
        return StudentParent::class;
    }
}
