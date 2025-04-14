<?php
namespace Database\Factories;

use App\Models\TravelRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class TravelRequestFactory extends Factory
{
    protected $model = TravelRequest::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'requester_name' => $this->faker->name,
            'destination' => $this->faker->city,
            'departure_date' => $this->faker->date,
            'return_date' => $this->faker->date,
        ];
    }
}
