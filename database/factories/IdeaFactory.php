<?php

namespace Database\Factories;

use App\Idea;
use App\Models\Space;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IdeaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Idea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->get()->pluck('id')->random(),
            'space_id' => Space::query()->get()->pluck('id')->random(),
            'title' => $this->faker->name,
            'status' => $this->faker->numberBetween(0, 3),
            'public' => $this->faker->boolean,
        ];
    }
}
