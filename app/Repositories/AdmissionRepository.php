<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\Admission;

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
        'admission_status_id'
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

    public function create($input)
    {
        $admission = null;
        DB::beginTransaction();
        try {
            $model = new Admission();
            $st_res = $model->Student()->create($input['student']);
            $pr_res1 = $model->Parent1()->create($input['parent1']);
            $pr_res2 = $model->Parent2()->create($input['parent2']);
            $input['student_id'] = $st_res['id'];
            $input['parent1_id'] = $pr_res1['id'];
            $input['parent2_id'] = $pr_res2['id'];
            $admission = $model->create($input);
            $ev_card['admission_id'] = $admission->id;
            $model->EvaluationCard()->create($ev_card);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
        return $admission;
    }

}
