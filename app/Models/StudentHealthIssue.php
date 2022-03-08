<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="StudentHealthIssue",
 *      required={"student_id", "issue"},
 *      @SWG\Property(
 *          property="student_id",
 *          description="student_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="issue",
 *          description="issue",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="doctor_name",
 *          description="doctor_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="doctor_phone",
 *          description="doctor_phone",
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
class StudentHealthIssue extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'student_health_issues';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'student_id',
        'issue',
        'doctor_name',
        'doctor_phone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'student_id' => 'integer',
        'issue' => 'string',
        'doctor_name' => 'string',
        'doctor_phone' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'student_id' => 'required',
        'issue' => 'required'
    ];

    public function Student(){
        return $this->belongsTo(Student::class);
    }

}
