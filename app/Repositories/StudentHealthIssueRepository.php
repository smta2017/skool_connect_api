<?php

namespace App\Repositories;

use App\Models\StudentHealthIssue;
use App\Repositories\BaseRepository;

/**
 * Class StudentHealthIssueRepository
 * @package App\Repositories
 * @version March 7, 2022, 1:38 pm UTC
*/

class StudentHealthIssueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'student_id',
        'issue',
        'doctor_name',
        'doctor_phone'
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
        return StudentHealthIssue::class;
    }
}
