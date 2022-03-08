<?php

namespace App\Repositories;

use App\Models\StudentSibling;
use App\Repositories\BaseRepository;

/**
 * Class StudentSiblingRepository
 * @package App\Repositories
 * @version March 7, 2022, 11:46 am UTC
*/

class StudentSiblingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'student_id',
        'sibling_in_alsson',
        'name',
        'current_school',
        'age',
        'grade'
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
        return StudentSibling::class;
    }
}
