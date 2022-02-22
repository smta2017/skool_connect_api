<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Bus",
 *      required={"bus_no", "brand", "seat_count", "license_no", "license_expire"},
 *      @SWG\Property(
 *          property="bus_no",
 *          description="bus_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="brand",
 *          description="brand",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="seat_count",
 *          description="seat_count",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="license_no",
 *          description="license_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="license_expire",
 *          description="license_expire",
 *          type="string",
 *          format="date"
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
class Bus extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'buses';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'bus_no',
        'brand',
        'seat_count',
        'license_no',
        'license_expire'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'bus_no' => 'string',
        'brand' => 'string',
        'seat_count' => 'integer',
        'license_no' => 'string',
        'license_expire' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'bus_no' => 'required',
        'brand' => 'required',
        'seat_count' => 'required',
        'license_no' => 'required',
        'license_expire' => 'required'
    ];

    
}
