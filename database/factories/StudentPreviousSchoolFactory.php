<?php

namespace Database\Factories;

use App\Models\StudentPreviousSchool;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentPreviousSchoolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudentPreviousSchool::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => $this->faker->randomDigitNotNull,
        'year_attended' => $this->faker->word,
        'reason_for_leaving' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
