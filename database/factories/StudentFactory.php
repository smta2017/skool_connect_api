<?php

namespace Database\Factories;

use App\Models\Bus;
use App\Models\Division;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Language;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\StClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name_en' => $this->faker->word,
            'middle_name_en' => $this->faker->word,
            'last_name_en' => $this->faker->word,
            'first_name_ar' => $this->faker->word,
            'middle_name_ar' => $this->faker->word,
            'last_name_ar' => $this->faker->word,
            'division_id' => Division::pluck('id')->random(),
            'grade_id' => Grade::pluck('id')->random(),
            'class_id' => StClass::pluck('id')->random(),
            'national_no' => $this->faker->word,
            'passport_no' => $this->faker->word,
            'birth_date' => $this->faker->date('Y-m-d'),
            'birth_place' => $this->faker->word,
            'october_age_date' => $this->faker->date('Y-m-d'),
            'academic_year_applying_id' => $this->faker->randomDigitNotNull,
            'nationality_id' => Nationality::pluck('id')->random(),
            'gender_id' => Gender::pluck('id')->random(),
            'bus_id' => Bus::pluck('id')->random(),
            'religion_id' => Religion::pluck('id')->random(),
            'previous_school_nursery' => $this->faker->word,
            'address' => $this->faker->word,
            'city' => $this->faker->word,
            'email' => $this->faker->word,
            'mobile' => $this->faker->word,
            'photo' => $this->faker->word,
            'code' => $this->faker->word,
            'lang_id' => Language::pluck('id')->random(),
            'birth_certificate' => $this->faker->word,
            'academic_house' => $this->faker->word,
            'report_cards' => $this->faker->word,
            'referance_letter' => $this->faker->word,
            'referance_name' => $this->faker->word,
            'referance_email' => $this->faker->word,
            'referance_phone' => $this->faker->word,
            'custody' => $this->faker->word,
            'foreigner' => $this->faker->randomElement(['0', '1']),
            'egy_returning' => $this->faker->randomElement(['0', '1']),
            'transfer_from_cairo' => $this->faker->randomElement(['0', '1']),
            'staff_child' => $this->faker->randomElement(['0', '1']),
            'staff_no' => $this->faker->word,
            'student_status_id' => 0,
            'learn_support' => $this->faker->randomElement(['0', '1']),
            'learn_support_details' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'user_id' => User::pluck('id')->random()
        ];
    }
}
