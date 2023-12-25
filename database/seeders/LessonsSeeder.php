<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\LessonTeacherSalary;
use Exception;
use Illuminate\Database\Seeder;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        LessonTeacherSalary::factory(20)->create();
    }
}
