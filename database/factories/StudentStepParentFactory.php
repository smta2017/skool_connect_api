<?php

namespace Database\Factories;

use App\Models\StudentStepParent;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentStepParentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudentStepParent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => $this->faker->randomDigitNotNull,
        'name' => $this->faker->word,
        'gender_id' => $this->faker->randomDigitNotNull,
        'phone' => $this->faker->word,
        'address' => $this->faker->word,
        'email' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
