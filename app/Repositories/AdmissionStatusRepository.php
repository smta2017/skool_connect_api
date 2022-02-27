<?php

namespace App\Repositories;

use App\Models\AdmissionStatus;
use App\Repositories\BaseRepository;

/**
 * Class AdmissionStatusRepository
 * @package App\Repositories
 * @version February 27, 2022, 12:40 pm UTC
*/

class AdmissionStatusRepository extends BaseRepository
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
        return AdmissionStatus::class;
    }
}
