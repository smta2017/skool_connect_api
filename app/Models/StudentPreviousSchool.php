<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="StudentPreviousSchool",
 *      required={"student_id"},
 *      @SWG\Property(
 *          property="student_id",
 *          description="student_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="year_attended",
 *          description="year_attended",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="reason_for_leaving",
 *          description="reason_for_leaving",
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
class StudentPreviousSchool extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'student_previous_schools';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'student_id',
        'year_attended',
        'reason_for_leaving'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'student_id' => 'integer',
        'year_attended' => 'string',
        'reason_for_leaving' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'student_id' => 'required'
    ];

    public function Student(){
        return $this->belongsTo(Student::class);
    }
}
