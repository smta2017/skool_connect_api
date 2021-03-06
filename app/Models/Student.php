<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Student",
 *      required={"first_name_en", "middle_name_en", "last_name_en", "first_name_ar", "middle_name_ar", "last_name_ar", "division_id", "grade_id", "class_id", "passport_no", "birth_date", "birth_place", "october_age_date", "academic_year_applying_id", "nationality_id", "gender_id", "bus_id", "religion_id", "previous_school_nursery", "address", "city", "email", "mobile", "submit_date", "photo", "code", "lang_id", "birth_certificate", "academic_house", "report_cards", "referance_letter", "referance_name", "referance_email", "referance_phone", "enroll_date", "custody", "foreigner", "egy_returning", "transfer_from_cairo", "staff_child", "staff_no", "learn_support", "learn_support_details"},
 *      @SWG\Property(
 *          property="first_name_en",
 *          description="first_name_en",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="middle_name_en",
 *          description="middle_name_en",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="last_name_en",
 *          description="last_name_en",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="first_name_ar",
 *          description="first_name_ar",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="middle_name_ar",
 *          description="middle_name_ar",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="last_name_ar",
 *          description="last_name_ar",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="division_id",
 *          description="division_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="grade_id",
 *          description="grade_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="class_id",
 *          description="class_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="national_no",
 *          description="national_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="passport_no",
 *          description="passport_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="birth_date",
 *          description="birth_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="birth_place",
 *          description="birth_place",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="october_age_date",
 *          description="october_age_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="academic_year_applying_id",
 *          description="academic_year_applying_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="nationality_id",
 *          description="nationality_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="gender_id",
 *          description="gender_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="bus_id",
 *          description="bus_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="religion_id",
 *          description="religion_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="previous_school_nursery",
 *          description="previous_school_nursery",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          description="address",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="city",
 *          description="city",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="mobile",
 *          description="mobile",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="submit_date",
 *          description="submit_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="photo",
 *          description="photo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="lang_id",
 *          description="lang_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="birth_certificate",
 *          description="birth_certificate",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="academic_house",
 *          description="academic_house",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="report_cards",
 *          description="report_cards",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="referance_letter",
 *          description="referance_letter",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="referance_name",
 *          description="referance_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="referance_email",
 *          description="referance_email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="referance_phone",
 *          description="referance_phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="enroll_date",
 *          description="enroll_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="custody",
 *          description="custody",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="foreigner",
 *          description="foreigner",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="egy_returning",
 *          description="egy_returning",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="transfer_from_cairo",
 *          description="transfer_from_cairo",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="staff_child",
 *          description="staff_child",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="staff_no",
 *          description="staff_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="learn_support",
 *          description="learn_support",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="learn_support_details",
 *          description="learn_support_details",
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
class Student extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'students';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'first_name_en',
        'middle_name_en',
        'last_name_en',
        'first_name_ar',
        'middle_name_ar',
        'last_name_ar',
        'division_id',
        'grade_id',
        'class_id',
        'national_no',
        'passport_no',
        'birth_date',
        'birth_place',
        'october_age_date',
        'academic_year_applying_id',
        'nationality_id',
        'gender_id',
        'bus_id',
        'religion_id',
        'previous_school_nursery',
        'address',
        'city',
        'email',
        'mobile',
        'submit_date',
        'photo',
        'code',
        'lang_id',
        'user_id',
        'birth_certificate',
        'academic_house',
        'report_cards',
        'referance_letter',
        'referance_name',
        'referance_email',
        'referance_phone',
        'enroll_date',
        'custody',
        'foreigner',
        'egy_returning',
        'transfer_from_cairo',
        'staff_child',
        'staff_no',
        'learn_support',
        'learn_support_details'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name_en' => 'string',
        'middle_name_en' => 'string',
        'last_name_en' => 'string',
        'first_name_ar' => 'string',
        'middle_name_ar' => 'string',
        'last_name_ar' => 'string',
        'division_id' => 'integer',
        'grade_id' => 'integer',
        'class_id' => 'integer',
        'national_no' => 'string',
        'passport_no' => 'string',
        'birth_date' => 'date',
        'birth_place' => 'string',
        'october_age_date' => 'date',
        'academic_year_applying_id' => 'integer',
        'nationality_id' => 'integer',
        'gender_id' => 'integer',
        'bus_id' => 'integer',
        'religion_id' => 'integer',
        'previous_school_nursery' => 'string',
        'address' => 'string',
        'city' => 'string',
        'email' => 'string',
        'mobile' => 'string',
        'submit_date' => 'date',
        'photo' => 'string',
        'code' => 'string',
        'lang_id' => 'integer',
        'user_id' => 'integer',
        'birth_certificate' => 'string',
        'academic_house' => 'string',
        'report_cards' => 'string',
        'referance_letter' => 'string',
        'referance_name' => 'string',
        'referance_email' => 'string',
        'referance_phone' => 'string',
        'enroll_date' => 'date',
        'custody' => 'string',
        'foreigner' => 'boolean',
        'egy_returning' => 'boolean',
        'transfer_from_cairo' => 'boolean',
        'staff_child' => 'boolean',
        'staff_no' => 'string',
        'learn_support' => 'boolean',
        'learn_support_details' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name_en' => 'required',
        'middle_name_en' => 'required',
        'last_name_en' => 'required',
        'first_name_ar' => 'required',
        'middle_name_ar' => 'required',
        'last_name_ar' => 'required',
        'division_id' => 'required',
        'grade_id' => 'required',
        'class_id' => 'required',
        'national_no' => 'reqiured',
        'passport_no' => 'required',
        'birth_date' => 'required',
        'birth_place' => 'required',
        'october_age_date' => 'required',
        'academic_year_applying_id' => 'required',
        'nationality_id' => 'required',
        'gender_id' => 'required',
        'bus_id' => 'required',
        'religion_id' => 'required',
        'previous_school_nursery' => 'required',
        'address' => 'required',
        'city' => 'required',
        'email' => 'required',
        'mobile' => 'required',
        'submit_date' => 'required',
        'photo' => 'required',
        'code' => 'required',
        'lang_id' => 'required',
        'user_id' => 'required',
        'birth_certificate' => 'required',
        'academic_house' => 'required',
        'report_cards' => 'required',
        'referance_letter' => 'required',
        'referance_name' => 'required',
        'referance_email' => 'required',
        'referance_phone' => 'required',
        'enroll_date' => 'required',
        'custody' => 'required',
        'foreigner' => 'required',
        'egy_returning' => 'required',
        'transfer_from_cairo' => 'required',
        'staff_child' => 'required',
        'staff_no' => 'required',
        'learn_support' => 'required',
        'learn_support_details' => 'required'
    ];


}
