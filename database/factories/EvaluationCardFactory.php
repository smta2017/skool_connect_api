<?php

namespace Database\Factories;

use App\Models\Admission;
use App\Models\EvaluationCard;
use App\Models\SchoolBuilding;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvaluationCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EvaluationCard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
       'exam_date' => $this->faker->date('Y-m-d H:i:s'),
        'exam_building_id' => SchoolBuilding::pluck('id')->random(),
        'exam_date2' => $this->faker->date('Y-m-d H:i:s'),
        'exam_building2_id' => SchoolBuilding::pluck('id')->random(),
        'meeting_date' => $this->faker->date('Y-m-d H:i:s'),
        'meeting_building_id' => SchoolBuilding::pluck('id')->random(),
        'reg_notes' => $this->faker->text,
        'entrance_ability' => $this->faker->randomElement(['A1','A2']),
        'entrance_recommendation' => $this->faker->randomElement(['R1', 'R2']),
        'observation_comment' => $this->faker->text,
        'principal_note' => $this->faker->text,
        'principal_recommendation' => $this->faker->randomElement(['Yes','Yes With Condition','Re-assess','No','More Info Needed']),
        'principal_ability' => $this->faker->randomElement(['Low','Medium','High']),
        'director_comment' => $this->faker->text,
        'application_status' => $this->faker->randomElement(['Waiting List','Accepted','Rejected']),
        'admission_id' => $this->faker->unique()->numberBetween(1,20),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
