<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="EvaluationCard",
 *      required={""},
 *      @SWG\Property(
 *          property="exam_date",
 *          description="exam_date",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="exam_building_id",
 *          description="exam_building_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="exam_date2",
 *          description="exam_date2",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="exam_building2_id",
 *          description="exam_building2_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="meeting_date",
 *          description="meeting_date",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="meeting_building_id",
 *          description="meeting_building_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="reg_notes",
 *          description="reg_notes",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="entrance_ability",
 *          description="entrance_ability",
 *          type="string",
 *          enum={"A1","a2"},
 *      ),
 *      @SWG\Property(
 *          property="entrance_recommendation",
 *          description="entrance_recommendation",
 *          type="string",
 *          enum={"R1","R2"},
 *      ),
 *      @SWG\Property(
 *          property="observation_comment",
 *          description="observation_comment",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="principal_note",
 *          description="principal_note",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="principal_recommendation",
 *          description="principal_recommendation",
 *         type="string",
 *          enum={"Yes","Yes With Condition","Re-assess","No","More Info Needed"},
 *      ),
 *      @SWG\Property(
 *          property="principal_ability",
 *          description="principal_ability",
 *             type="string",
 *          enum={"Low","Medium","High"},
 *      ),
 *      @SWG\Property(
 *          property="director_comment",
 *          description="director_comment",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="application_status",
 *          description="application_status",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="admission_id",
 *          description="admission_id",
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
class EvaluationCard extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'evaluation_cards';


    protected $dates = ['deleted_at'];



    public $fillable = [
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
        'application_status',
        'admission_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'exam_date' => 'datetime',
        'exam_building_id' => 'integer',
        'exam_date2' => 'datetime',
        'exam_building2_id' => 'integer',
        'meeting_date' => 'datetime',
        'meeting_building_id' => 'integer',
        'reg_notes' => 'string',
        'entrance_ability' => 'string',
        'entrance_recommendation' => 'string',
        'observation_comment' => 'string',
        'principal_note' => 'string',
        'principal_recommendation' => 'string',
        'principal_ability' => 'string',
        'director_comment' => 'string',
        'application_status' => 'string',
        'admission_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function SchoolBuilding(){
        return $this->belongsTo(SchoolBuilding::class);
    }

    public function Admission(){
        return $this->belongsTo(Admission::class);
    }



}
