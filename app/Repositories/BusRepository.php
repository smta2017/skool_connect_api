<?php

namespace App\Repositories;

use App\Models\Bus;
use App\Repositories\BaseRepository;

/**
 * Class BusRepository
 * @package App\Repositories
 * @version February 22, 2022, 10:03 am UTC
*/

class BusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'bus_no',
        'brand',
        'seat_count',
        'license_no',
        'license_expire'
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
        return Bus::class;
    }
}
