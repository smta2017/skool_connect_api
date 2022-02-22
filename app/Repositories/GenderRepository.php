<?php

namespace App\Repositories;

use App\Models\Gender;
use App\Repositories\BaseRepository;

/**
 * Class GenderRepository
 * @package App\Repositories
 * @version February 22, 2022, 9:51 am UTC
*/

class GenderRepository extends BaseRepository
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
        return Gender::class;
    }
}
