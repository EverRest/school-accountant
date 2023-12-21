<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Group;
use Exception;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Group::factory(20)->create();
    }
}
