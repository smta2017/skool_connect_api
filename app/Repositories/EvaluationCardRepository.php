<?php

namespace App\Repositories;

use App\Models\EvaluationCard;
use App\Repositories\BaseRepository;

/**
 * Class EvaluationCardRepository
 * @package App\Repositories
 * @version March 1, 2022, 1:40 pm UTC
*/

class EvaluationCardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'exam_date',
        'exam_building_id',
        'exam_date2',
        'exam_building2_id',
        'meeting_date',
        'meeting_building_id',
        'reg_notes',
        'entrance_ability',
        'entrance_recommendation',
        'observation_comment',
        'principal_note',
        'principal_recommendation',
        'principal_ability',
        'director_comment',
        'application_status',
        'admission_id'
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
        return EvaluationCard::class;
    }
}
