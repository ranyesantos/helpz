<?php

namespace Database\Seeders;

use App\Enums\UserRolesType;
use App\Models\Device;
use App\Models\ServiceRequest;
use App\Models\User;
use Database\Factories\DeviceFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role = Role::create(['name' => UserRolesType::Admin]);
        $role->givePermissionTo(Permission::all());
        Role::create(['name' => UserRolesType::Technician]);

        User::factory()
            ->getAdmin()
            ->create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => 'password'
            ]);
            
        User::factory()
            ->create([
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => 'password'
            ]);

        User::factory()
            ->getTechnicianRole()
            ->create([
                'name' => 'technician',
                'email' => 'technician@technician.com',
                'password' => 'password'
            ]);

        $users = User::factory()
            ->count(15)
            ->create();

        $devices = Device::factory()
            ->count(9)
            ->create();

        ServiceRequest::factory()
            ->generateServiceRequests($users, $devices);
    }

}
