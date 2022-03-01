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
        'entrance_ability' => $this->faker->text,
        'entrance_recommendation' => $this->faker->word,
        'observation_comment' => $this->faker->text,
        'principal_note' => $this->faker->text,
        'principal_recommendation' => $this->faker->word,
        'principal_ability' => $this->faker->word,
        'director_comment' => $this->faker->text,
        'application_status' => $this->faker->word,
        'admission_id' => Admission::pluck('id')->random(),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
