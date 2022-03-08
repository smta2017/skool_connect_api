<?php

namespace Database\Factories;

use App\Models\StudentSibling;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentSiblingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudentSibling::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => $this->faker->randomDigitNotNull,
        'sibling_in_alsson' => $this->faker->word,
        'name' => $this->faker->word,
        'current_school' => $this->faker->word,
        'age' => $this->faker->word,
        'grade' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
