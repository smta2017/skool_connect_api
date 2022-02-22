<?php

namespace App\Repositories;

use App\Models\ApplyYear;
use App\Repositories\BaseRepository;

/**
 * Class ApplyYearRepository
 * @package App\Repositories
 * @version February 22, 2022, 9:48 am UTC
*/

class ApplyYearRepository extends BaseRepository
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
        return ApplyYear::class;
    }
}
