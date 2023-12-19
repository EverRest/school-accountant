<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::findByName('owner');
        $adminEmail = Config::get('admin.email');
        $adminPwd = Config::get('admin.pwd');
        User::updateOrCreate(['email' => $adminEmail], ['name' => 'Admin', 'password' => Hash::make($adminPwd), 'phone_number' => '0987654321']);
    }
}
