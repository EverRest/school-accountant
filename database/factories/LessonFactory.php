<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Course;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lesson>
 */
class LessonFactory extends Factory
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
            'group_id' => Group::query()->inRandomOrder()->first(),
            'teacher_id' => Teacher::query()->inRandomOrder()->first(),
            'date' => fake()->date(),
        ];
    }
}
