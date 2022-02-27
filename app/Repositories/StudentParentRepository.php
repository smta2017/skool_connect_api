<?php

namespace App\Repositories;

use App\Models\StudentParent;
use App\Repositories\BaseRepository;

/**
 * Class StudentParentRepository
 * @package App\Repositories
 * @version February 27, 2022, 9:51 am UTC
*/

class StudentParentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'student',
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
