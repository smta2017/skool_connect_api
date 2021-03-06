<?php

namespace App\Repositories;

use App\Models\Nationality;
use App\Repositories\BaseRepository;

/**
 * Class NationalityRepository
 * @package App\Repositories
 * @version February 22, 2022, 9:50 am UTC
*/

class NationalityRepository extends BaseRepository
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
        return Nationality::class;
    }
}
