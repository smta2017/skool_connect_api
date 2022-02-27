<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="StudentParent",
 *      required={"student", "parent_id"},
 *      @SWG\Property(
 *          property="student",
 *          description="student",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="parent_id",
 *          description="parent_id",
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
class StudentParent extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'student_parents';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'student',
        'parent_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'student' => 'integer',
        'parent_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'student' => 'required',
        'parent_id' => 'required'
    ];

    public function Student(){
        return $this->belongsTo(Student::class);
    }

    public function Parent(){
        return $this->belongsTo(StParent::class);
    }


}
