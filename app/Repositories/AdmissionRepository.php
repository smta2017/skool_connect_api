<?php

namespace App\Repositories;

use App\Models\Admission;
use App\Repositories\BaseRepository;

/**
 * Class AdmissionRepository
 * @package App\Repositories
 * @version February 27, 2022, 12:26 pm UTC
*/

class AdmissionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'student_id',
        'parent1_id',
        'parent2_id',
        'status'
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
        return Admission::class;
    }
}
