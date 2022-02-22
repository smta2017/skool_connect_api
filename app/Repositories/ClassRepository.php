<?php

namespace App\Repositories;

use App\Models\StClass;
use App\Repositories\BaseRepository;

/**
 * Class ClassRepository
 * @package App\Repositories
 * @version February 22, 2022, 9:45 am UTC
*/

class ClassRepository extends BaseRepository
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
        return StClass::class;
    }
}
