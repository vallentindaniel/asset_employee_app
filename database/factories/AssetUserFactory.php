<?php

namespace Database\Factories;

use App\Models\AssetUser;
use App\Models\User;
use App\Models\Asset;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssetUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'asset_id' => Asset::factory(),
            'employee_id' => User::factory(),
            'from' => $this->faker->name,
            'to' => $this->faker->name,
            'cost_center_id' => CostCenter::factory(),
            'end_of_life' => now()
        ];
    }

     /**
     * @return AssetUserFactory
     */
    public function configure(): AssetUserFactory
    {
        return $this->afterCreating(function (User $user, Asset $asset) {
            if ($user->cost_center_id == $asset->cost_center_id) {
                AssetUser::firstOrCreate([
                    'asset_id' =>  $asset->cost_center_id,
                    'employee_id' => $user->cost_center_id
                ]);
            }
        });
    }
}
