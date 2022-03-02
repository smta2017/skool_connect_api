<?php

namespace App\Repositories;

use App\Models\EvaluationCard;
use App\Models\Admission;
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
        'application_status'
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

    public function update($input, $id)
    {
        $query = $this->model->newQuery();
        $model = $query->findOrFail($id);
        $model->fill($input);
        $model->save();
        $admission = Admission::where('evaluation_card_id',$model->id)->first();
        if(!empty($input['application_status'])){
            if($input['application_status']=='Waiting List'){
                $admission->admission_status_id = 5;
            }elseif($input['application_status']=='Accepted'){
                $admission->admission_status_id = 6;
            }elseif($input['application_status']=='Rejected'){
                $admission->admission_status_id = 7;
            }
        }elseif(!empty($input['meeting_date'])){
            $admission->admission_status_id = 4;
        }elseif(!empty($input['exam_date2'])){
            $admission->admission_status_id = 3;
        }elseif(!empty($input['exam_date1'])){
            $admission->admission_status_id = 2;
        }
        $admission->save();
        return $model;
    }
}
