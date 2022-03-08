<?php

namespace App\Repositories;

use App\Models\StudentPreviousSchool;
use App\Repositories\BaseRepository;

/**
 * Class StudentPreviousSchoolRepository
 * @package App\Repositories
 * @version March 8, 2022, 8:50 am UTC
*/

class StudentPreviousSchoolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'student_id',
        'year_attended',
        'reason_for_leaving'
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
        return StudentPreviousSchool::class;
    }
}
