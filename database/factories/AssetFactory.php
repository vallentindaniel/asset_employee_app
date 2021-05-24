<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\CostCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Asset::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->name,
            'imput_date' => now(),
            'cost_center_id' => CostCenter::factory()
        ];
    }
}
