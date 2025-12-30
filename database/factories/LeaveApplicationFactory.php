<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\LeaveApplicationStatus;
use App\Models\User;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveApplication>
 */
class LeaveApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTime();
        $daysDifference = $this->faker->numberBetween(0, 100);
        $endDate = Carbon::instance($startDate)->addDays($daysDifference);

        return [
            'user_id' => User::all()->random()->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'reason' => $this->faker->sentence(),
            'status' => LeaveApplicationStatus::getRandomValue(),
        ];
    }
}
