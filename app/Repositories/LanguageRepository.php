<?php

namespace App\Repositories;

use App\Models\Language;
use App\Repositories\BaseRepository;

/**
 * Class LanguageRepository
 * @package App\Repositories
 * @version February 22, 2022, 9:56 am UTC
*/

class LanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'code'
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
        return Language::class;
    }
}
