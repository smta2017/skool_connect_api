<?php

namespace Database\Factories;

use App\Models\Admission;
use App\Models\AdmissionStatus;
use App\Models\EvaluationCard;
use App\Models\StParent;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdmissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => Student::pluck('id')->random(),
        'admission_status_id' => AdmissionStatus::pluck('id')->random(),
        'evaluation_card_id' => $this->faker->unique()->numberBetween(1,20),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
