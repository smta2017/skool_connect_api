<?php

namespace App\Repositories;

use App\Models\EmergencyContact;
use App\Repositories\BaseRepository;

/**
 * Class EmergencyContactRepository
 * @package App\Repositories
 * @version March 7, 2022, 12:11 pm UTC
*/

class EmergencyContactRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'student_id',
        'name',
        'relation',
        'mobile',
        'address',
        'email'
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
        return EmergencyContact::class;
    }
}
