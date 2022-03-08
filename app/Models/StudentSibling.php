<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="StudentSibling",
 *      required={"student_id", "sibling_in_alsson", "name"},
 *      @SWG\Property(
 *          property="student_id",
 *          description="student_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="sibling_in_alsson",
 *          description="sibling_in_alsson",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="current_school",
 *          description="current_school",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="age",
 *          description="age",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="grade",
 *          description="grade",
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
class StudentSibling extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'student_siblings';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'student_id',
        'sibling_in_alsson',
        'name',
        'current_school',
        'age',
        'grade'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'student_id' => 'integer',
        'sibling_in_alsson' => 'boolean',
        'name' => 'string',
        'current_school' => 'string',
        'age' => 'string',
        'grade' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'student_id' => 'required',
        'sibling_in_alsson' => 'required',
        'name' => 'required'
    ];

    public function Student(){
        return $this->belongsTo(Student::class);
    }

}
