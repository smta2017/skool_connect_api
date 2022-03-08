<?php

namespace App\Repositories;

use App\Models\Grade;
use App\Repositories\BaseRepository;

/**
 * Class GradeRepository
 * @package App\Repositories
 * @version February 22, 2022, 9:43 am UTC
*/

class GradeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'division_id',
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
        return Grade::class;
    }
}
