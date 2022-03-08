<?php

namespace Database\Factories;

use App\Models\MaritalStatus;
use App\Models\StParent;
use Illuminate\Database\Eloquent\Factories\Factory;

class StParentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StParent::class;

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
        'marital_status_id' => MaritalStatus::pluck('id')->random(),
        'university' => $this->faker->word,
        'occupation' => $this->faker->word,
        'employer' => $this->faker->word,
        'type_of_business' => $this->faker->word,
        'business_address' => $this->faker->word,
        'business_mobile' => $this->faker->word,
        'business_email' => $this->faker->word,
        'alumni' => $this->faker->randomElement(['0', '1']),
        'class_off' => $this->faker->word,
        'type' => $this->faker->word,
        'school' => $this->faker->word,
        'religion_id'=>$this->faker->randomElement(['2', '1']),
        'nationality_id'=>$this->faker->randomElement(['2', '1']),
        'address'=>$this->faker->word,
        'email'=>$this->faker->word,
        'phone'=>$this->faker->word,
        'mobile'=>$this->faker->word,
        'card_id'=>$this->faker->word,
        'card_id_file'=>$this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
