<?php

namespace App\Repositories;

use App\Models\UserType;
use App\Repositories\BaseRepository;

/**
 * Class UserTypeRepository
 * @package App\Repositories
 * @version February 21, 2022, 12:20 pm UTC
*/

class UserTypeRepository extends BaseRepository
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
        return UserType::class;
    }
}
