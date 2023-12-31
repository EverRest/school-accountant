<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Course;
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
        Course::factory(20)->create();
    }
}
