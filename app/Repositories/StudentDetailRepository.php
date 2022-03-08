<?php

namespace App\Repositories;

use App\Models\StudentDetail;
use App\Repositories\BaseRepository;

/**
 * Class StudentDetailRepository
 * @package App\Repositories
 * @version March 7, 2022, 2:11 pm UTC
*/

class StudentDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'student_id',
        'marital_status_id',
        'bus',
        'custodial_parent_name'
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
        return StudentDetail::class;
    }
}
