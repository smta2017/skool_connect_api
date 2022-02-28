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
            $studentRepo = new StudentRepository($this->app);
            $parentRepo = new ParentRepository($this->app);
            $input['student'] = array('first_name_ar'=>'a','first_name_en'=>'b');
            $student = $studentRepo->create($input['student']);
            $parent1 = $parentRepo->create($input['parent1']);
            $parent2 = $parentRepo->create($input['parent2']);
            $input['student_id'] = $student['id'];
            $input['parent1_id'] = $parent1['id'];
            $input['parent2_id'] = $parent2['id'];
            $model = $this->model->newInstance($input);
            $model->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return $student;
    }

}
