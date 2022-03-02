<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Admission",
 *      @SWG\Property(
 *          property="student",
 *          description="student",
 *          @SWG\Items(
 *              type="object",
                    @SWG\Property(property="first_name_en", type="string"),
                    @SWG\Property(property="middle_name_en", type="string"),
                    @SWG\Property(property="last_name_en", type="string"),
                    @SWG\Property(property="first_name_ar", type="string"),
                    @SWG\Property(property="middle_name_ar", type="string"),
                    @SWG\Property(property="last_name_ar", type="string"),
                    @SWG\Property(property="division_id", type="string"),
                    @SWG\Property(property="grade_id", type="string"),
                    @SWG\Property(property="class_id", type="string"),
                    @SWG\Property(property="passport_no", type="string"),
                    @SWG\Property(property="birth_date", type="string"),
                    @SWG\Property(property="birth_place", type="string"),
                    @SWG\Property(property="october_age_date", type="string"),
                    @SWG\Property(property="academic_year_applying_id", type="string"),
                    @SWG\Property(property="nationality_id", type="string"),
                    @SWG\Property(property="gender_id", type="string"),
                    @SWG\Property(property="bus_id", type="string"),
                    @SWG\Property(property="religion_id", type="string"),
                    @SWG\Property(property="previous_school_nursery", type="string"),
                    @SWG\Property(property="address", type="string"),
                    @SWG\Property(property="city", type="string"),
                    @SWG\Property(property="email", type="string"),
                    @SWG\Property(property="mobile", type="string"),
                    @SWG\Property(property="lang_id", type="string"),
                    @SWG\Property(property="user_id", type="string"),
                    @SWG\Property(property="birth_certificate", type="string"),
                    @SWG\Property(property="academic_house", type="string"),
                    @SWG\Property(property="report_cards", type="string"),
                    @SWG\Property(property="referance_letter", type="string"),
                    @SWG\Property(property="referance_name", type="string"),
                    @SWG\Property(property="referance_email", type="string"),
                    @SWG\Property(property="referance_phone", type="string"),
                    @SWG\Property(property="enroll_date", type="string"),
                    @SWG\Property(property="custody", type="string"),
                    @SWG\Property(property="foreigner", type="string"),
                    @SWG\Property(property="egy_returning", type="string"),
                    @SWG\Property(property="transfer_from_cairo", type="string"),
                    @SWG\Property(property="staff_child", type="string"),
                    @SWG\Property(property="staff_no", type="string"),
                    @SWG\Property(property="learn_support", type="string"),
                    @SWG\Property(property="learn_support_details", type="string"),
                    @SWG\Property(property="photo", type="string"),
                    @SWG\Property(property="code", type="string"),
                    @SWG\Property(property="national_no", type="string"),
                    @SWG\Property(property="submit_date", type="string"),
    ),
 *      ),
 *      @SWG\Property(
 *          property="parent1",
 *          description="parent1",
 *          @SWG\Items(
 *              type="object",
         @SWG\Property(property="first_name_en", type="string"),
         @SWG\Property(property="middle_name_en", type="string"),
         @SWG\Property(property="last_name_en", type="string"),
         @SWG\Property(property="first_name_ar", type="string"),
         @SWG\Property(property="middle_name_ar", type="string"),
         @SWG\Property(property="last_name_ar", type="string"),
         @SWG\Property(property="marital_status_id", type="string"),
         @SWG\Property(property="university", type="string"),
         @SWG\Property(property="occupation", type="string"),
         @SWG\Property(property="employer", type="string"),
         @SWG\Property(property="type_of_business", type="string"),
         @SWG\Property(property="business_address", type="string"),
         @SWG\Property(property="business_mobile", type="string"),
         @SWG\Property(property="business_email", type="string"),
         @SWG\Property(property="alumni", type="string"),
         @SWG\Property(property="class_off", type="string"),
         @SWG\Property(property="type", type="string"),
         @SWG\Property(property="school", type="string"),
 * )
 *      ),
 *      @SWG\Property(
 *          property="parent2",
 *          description="parent2",
 *         *          @SWG\Items(
 *              type="object",
         @SWG\Property(property="first_name_en", type="string"),
         @SWG\Property(property="middle_name_en", type="string"),
         @SWG\Property(property="last_name_en", type="string"),
         @SWG\Property(property="first_name_ar", type="string"),
         @SWG\Property(property="middle_name_ar", type="string"),
         @SWG\Property(property="last_name_ar", type="string"),
         @SWG\Property(property="marital_status_id", type="string"),
         @SWG\Property(property="university", type="string"),
         @SWG\Property(property="occupation", type="string"),
         @SWG\Property(property="employer", type="string"),
         @SWG\Property(property="type_of_business", type="string"),
         @SWG\Property(property="business_address", type="string"),
         @SWG\Property(property="business_mobile", type="string"),
         @SWG\Property(property="business_email", type="string"),
         @SWG\Property(property="alumni", type="string"),
         @SWG\Property(property="class_off", type="string"),
         @SWG\Property(property="type", type="string"),
         @SWG\Property(property="school", type="string"),
 * )
 *      ),
 *      @SWG\Property(
 *          property="admission_status_id",
 *          description="admission_status_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *     *      @SWG\Property(
 *          property="evaluation_card_id",
 *          description="evaluation_card_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *
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
        'admission_status_id',
        'evaluation_card_id'
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
        'admission_status_id' => 'integer',
        'evaluation_card_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'student_id' => '',
        'parent1_id' => '',
        'parent2_id' => '',
        'admission_status_id' => '',
        'evaluation_card_id' => ''
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

    public function EvaluationCard(){
        return $this->belongsTo(EvaluationCard::class);
    }

}
