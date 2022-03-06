<?php

namespace App\Repositories;

use App\Models\StudentStatus;
use App\Repositories\BaseRepository;

/**
 * Class StudentStatusRepository
 * @package App\Repositories
 * @version March 6, 2022, 10:27 am UTC
*/

class StudentStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return StudentStatus::class;
    }
}
