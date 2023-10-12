<?php

namespace Database\Factories;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StateFactory extends Factory
{
    protected $model = State::class;

    public function definition()
    {
        return [
            'name' => $this->faker->streetName(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
