<?php

namespace Database\Factories;

use App\Models\StudentHealthIssue;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentHealthIssueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudentHealthIssue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => $this->faker->randomDigitNotNull,
        'issue' => $this->faker->word,
        'doctor_name' => $this->faker->word,
        'doctor_phone' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
