<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Teacher;
use Exception;
use Illuminate\Database\Seeder;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Teacher::factory(20)->create();
    }
}
