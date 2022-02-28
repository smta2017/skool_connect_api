<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Admission",
 *      required={"student_id", "parent1_id", "parent2_id", "admission_status_id"},
 *      @SWG\Property(
 *          property="student_id",
 *          description="student_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="parent1_id",
 *          description="parent1_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="parent2_id",
 *          description="parent2_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="admission_status_id",
 *          description="admission_status_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Admission extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'admissions';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'student_id',
        'parent1_id',
        'parent2_id',
        'admission_status_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'student_id' => 'integer',
        'parent1_id' => 'integer',
        'parent2_id' => 'integer',
        'admission_status_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'student_id' => 'required',
        'parent1_id' => 'required',
        'parent2_id' => 'required',
        'admission_status_id' => 'required'
    ];

    public function Student(){
        return $this->belongsTo(Student::class);
    }

    public function Parent1(){
        return $this->belongsTo(StParent::class,'parent1_id');
    }

    public function Parent2(){
        return $this->belongsTo(StParent::class,'parent2_id');
    }

    public function AdmissionStatus(){
        return $this->belongsTo(AdmissionStatus::class);
    }


}
