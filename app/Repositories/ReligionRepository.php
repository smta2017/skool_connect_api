<?php

namespace App\Repositories;

use App\Models\Religion;
use App\Repositories\BaseRepository;

/**
 * Class ReligionRepository
 * @package App\Repositories
 * @version February 22, 2022, 9:53 am UTC
*/

class ReligionRepository extends BaseRepository
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
        return Religion::class;
    }
}
