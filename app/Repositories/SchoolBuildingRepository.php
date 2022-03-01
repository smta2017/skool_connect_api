<?php

namespace App\Repositories;

use App\Models\SchoolBuilding;
use App\Repositories\BaseRepository;

/**
 * Class SchoolBuildingRepository
 * @package App\Repositories
 * @version March 1, 2022, 2:14 pm UTC
*/

class SchoolBuildingRepository extends BaseRepository
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
        return SchoolBuilding::class;
    }
}
