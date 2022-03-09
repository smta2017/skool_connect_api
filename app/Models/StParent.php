<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Parent",
 *      required={"first_name_en", "middle_name_en", "last_name_en", "first_name_ar", "middle_name_ar", "last_name_ar", "marital_status_id", "university", "occupation", "employer", "type_of_business", "business_address", "business_mobile", "business_email", "alumni", "class_off", "type", "school"},
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
 *          property="marital_status_id",
 *          description="marital_status_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="university",
 *          description="university",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="occupation",
 *          description="occupation",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="employer",
 *          description="employer",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="type_of_business",
 *          description="type_of_business",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="business_address",
 *          description="business_address",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="business_mobile",
 *          description="business_mobile",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="business_email",
 *          description="business_email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="alumni",
 *          description="alumni",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="class_off",
 *          description="class_off",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="school",
 *          description="school",
 *          type="string"
 *      ),
 *
 *
 *      @SWG\Property(
 *       property="religion_id" ,
 *       description="religion_id",
 *          type="string"
 *      ),
 *       @SWG\Property(
 *         property="nationality_id",
 *         description="nationality_id",
 *          type="string"
 *      ),
 *       @SWG\Property(
 *         property="address",
 *         description="address",
 *          type="string"
 *      ),
 *       @SWG\Property(
 *        property="email",
 *        description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *        property="phone",
 *        description="phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *        property="mobile",
 *        description="mobile",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *        property="card_id",
 *        description="card_id",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *       property="card_id_file",
 *       description="card_id_file",
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
class StParent extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'parents';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'first_name_en',
        'middle_name_en',
        'last_name_en',
        'first_name_ar',
        'middle_name_ar',
        'last_name_ar',
        'marital_status_id',
        'university',
        'occupation',
        'employer',
        'type_of_business',
        'business_address',
        'business_mobile',
        'business_email',
        'alumni',
        'class_off',
        'type',
        'religion_id',
        'nationality_id',
        'address',
        'email',
        'phone',
        'mobile',
        'card_id',
        'card_id_file',
        'school'
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
        'marital_status_id' => 'integer',
        'university' => 'string',
        'occupation' => 'string',
        'employer' => 'string',
        'type_of_business' => 'string',
        'business_address' => 'string',
        'business_mobile' => 'string',
        'business_email' => 'string',
        'alumni' => 'boolean',
        'class_off' => 'string',
        'type' => 'string',
        'religion_id'=>'integer',
        'nationality_id'=>'integer',
        'address'=>'string',
        'email'=>'string',
        'phone'=>'string',
        'mobile'=>'string',
        'card_id'=>'string',
        'card_id_file'=>'string',
        'school' => 'string'
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
        'marital_status_id' => 'required',
        'university' => 'required',
        'occupation' => 'required',
        'employer' => 'required',
        'type_of_business' => 'required',
        'business_address' => 'required',
        'business_mobile' => 'required',
        'business_email' => 'required',
        'alumni' => 'required',
        'class_off' => 'required',
        'type' => 'required',
        'religion_id'=>'',
        'nationality_id'=>'',
        'address'=>'',
        'email'=>'',
        'phone'=>'',
        'mobile'=>'',
        'card_id'=>'',
        'card_id_file'=>'',
        'school' => 'required'
    ];

    public function StudentParent(){
        return $this->hasMany(StudentParent::class);
    }

}
