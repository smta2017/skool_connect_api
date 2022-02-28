<?php

namespace App\Repositories;

use App\Http\Requests\API\CreateAdmissionAPIRequest;
use App\Models\Admission;
use App\Models\StParent;
use App\Models\Student;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

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

    public function create( $input)
    {
        $model = null;
        DB::beginTransaction();
        try {
            $model = $this->model->newInstance($input);
            $model->Student()->create($input['student']);
            $model->Parent1()->create($input['parent1']);
            $model->Parent2()->create($input['parent2']);
            $model->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return $model;
    }

}
