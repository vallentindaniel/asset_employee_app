<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\CostCenter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

/**
 * Class UserFactory
 *
 * @package Database\Factories
 */
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
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('parola'),
            'role' => $this->faker->randomElement([User::ROLE_ADMIN, User::ROLE_USER]),
            'cost_center_id' => CostCenter::factory(),
            'manager' => $this->faker->name,
            'email_verified_at' => now()
        ];
    }
}
