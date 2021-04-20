<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $debt = $this->faker->unique()->randomFloat(2,0,1000);
        $stateFee = $debt / 100 * 13;
        $stateFee = number_format($stateFee,2,'.','');
        return [
            'firstName' => $this->faker->firstName,
            'secondName' => $this->faker->lastName,
            'middleName' => $this->faker->lastName,
            'debt' => $debt,
            'stateFee' => $stateFee
        ];
    }
}
