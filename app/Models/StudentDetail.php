<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="StudentDetail",
 *      required={"student_id", "marital_status_id"},
 *      @SWG\Property(
 *          property="student_id",
 *          description="student_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="marital_status_id",
 *          description="marital_status_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="bus",
 *          description="bus",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="custodial_parent_name",
 *          description="custodial_parent_name",
 *          type="string"
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
class StudentDetail extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'student_details';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'student_id',
        'marital_status_id',
        'bus',
        'custodial_parent_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'student_id' => 'integer',
        'marital_status_id' => 'integer',
        'bus' => 'string',
        'custodial_parent_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'student_id' => 'required',
        'marital_status_id' => 'required'
    ];

    public function Student(){
        return $this->belongsTo(Student::class);
    }

}
