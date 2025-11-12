<?php

namespace Database\Seeders;

use Helpz\Device\Models\Device;
use Helpz\Report\Models\Report;
use Helpz\ServiceRequest\Models\ServiceRequest;
use Helpz\User\Enums\UserRolesEnum;
use Helpz\User\Models\User;
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
        $adminRole = Role::create(['name' => UserRolesEnum::Admin]);
        
        $adminRole->givePermissionTo(Permission::all());

        $actions = ['create', 'read', 'update', 'delete'];
        $entities = ['service requests', 'devices', 'reports'];

        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "$action $entity"]);
            }
        }

        $technicianRole = Role::create(['name' => UserRolesEnum::Technician]);
        $technicianRole->givePermissionTo([
            'create service requests',
            'read service requests',
            'update service requests',
            'create devices',
            'read devices',
            'update devices',
            'create reports',
            'read reports',
            'update reports',
        ]);
        

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
            ->count(rand(10,27))
            ->state(fn () => [
                'user_id' => $users->random()->getKey(),
                'device_id' => $devices->random()->getKey()
            ])
            ->create();

        Report::factory()
            ->count(10)
            ->create();
    }

}
