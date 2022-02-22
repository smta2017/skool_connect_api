<?php

namespace Database\Factories;

use App\Models\Student;
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
        'division_id' => $this->faker->randomDigitNotNull,
        'grade_id' => $this->faker->randomDigitNotNull,
        'class_id' => $this->faker->randomDigitNotNull,
        'national_no' => $this->faker->word,
        'passport_no' => $this->faker->word,
        'birth_date' => $this->faker->word,
        'birth_place' => $this->faker->word,
        'october_age_date' => $this->faker->word,
        'academic_year_applying_id' => $this->faker->randomDigitNotNull,
        'nationality_id' => $this->faker->randomDigitNotNull,
        'gender_id' => $this->faker->randomDigitNotNull,
        'bus_id' => $this->faker->randomDigitNotNull,
        'religion_id' => $this->faker->randomDigitNotNull,
        'previous_school_nursery' => $this->faker->word,
        'address' => $this->faker->word,
        'city' => $this->faker->word,
        'email' => $this->faker->word,
        'mobile' => $this->faker->word,
        'submit_date' => $this->faker->word,
        'photo' => $this->faker->word,
        'code' => $this->faker->word,
        'lang_id' => $this->faker->randomDigitNotNull,
        'birth_certificate' => $this->faker->word,
        'academic_house' => $this->faker->word,
        'report_cards' => $this->faker->word,
        'referance_letter' => $this->faker->word,
        'referance_name' => $this->faker->word,
        'referance_email' => $this->faker->word,
        'referance_phone' => $this->faker->word,
        'enroll_date' => $this->faker->word,
        'custody' => $this->faker->word,
        'foreigner' => $this->faker->word,
        'egy_returning' => $this->faker->word,
        'transfer_from_cairo' => $this->faker->word,
        'staff_child' => $this->faker->word,
        'staff_no' => $this->faker->word,
        'learn_support' => $this->faker->word,
        'learn_support_details' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
