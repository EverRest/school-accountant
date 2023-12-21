<?php
declare(strict_types=1);
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesSeeder::class);
        $this->call(SuperAdminSeeder::class);
//        $this->call(UsersSeeder::class);
        $this->call(TeachersSeeder::class);
        $this->call(CoursesSeeder::class);
        $this->call(GroupsSeeder::class);
        $this->call(LessonsSeeder::class);
    }
}
