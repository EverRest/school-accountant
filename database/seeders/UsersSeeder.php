<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::query()->each(
            function (Role $role) {
                for($i = 0;$i < 21;$i++) {
                    $user = User::factory()->create();
                    $user->assignRole($role);
                }
            }
        );
    }
}
