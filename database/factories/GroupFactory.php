<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Course;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'creator_id' => User::query()->inRandomOrder()->first(),
            'course_id' => Course::query()->inRandomOrder()->first(),
            'name' => fake()->sentence(),
        ];
    }
}
