<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        $usersId = User::all()->pluck('id')->toArray();
        for ($i = 0; $i < 20; $i++) {
            Course::create([
                'name' => fake()->name,
                'creator_id' => $usersId[random_int(0, count($usersId) - 1)]
            ]);
        }
    }
}
