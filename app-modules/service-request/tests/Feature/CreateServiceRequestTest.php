<?php

use Spatie\Permission\Models\Role;
use Helpz\Device\Models\Device;
use Helpz\ServiceRequest\Enums\ServiceRequestStatusEnum;
use Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Pages\CreateServiceRequest;
use Helpz\ServiceRequest\Models\ServiceRequest;
use Helpz\User\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;
use function PHPUnit\Framework\assertTrue;

describe ('service request creation', function() {
    it('works correctly when a common user is creating', function (): void {
        $user = User::factory()->create();
        $device = Device::factory()->create();
        $input = [
            'title' => 'service request title',
            'description' => 'service request description',
            'user_id' => $user->id,
            'device_id' => $device->id,
            'status' => ServiceRequestStatusEnum::Pending->value
        ];
    
        actingAs($user);
        
        livewire(CreateServiceRequest::class)
            ->fillForm($input)
            ->call('create')
            ->assertSuccessful()
            ->assertHasNoErrors();
        
        assertDatabaseCount(ServiceRequest::class, 1);
        assertDatabaseHas(ServiceRequest::class,$input);
    });
    
    it('works correctly when a admin is creating', function (): void {
        Role::create(['name' => 'admin']);
        $admin = User::factory()->create()->assignRole('admin');
        $device = Device::factory()->create();
        $input = [
            'title' => 'service request title',
            'description' => 'service request description',
            'user_id' => $admin->id,
            'device_id' => $device->id,
            'status' => ServiceRequestStatusEnum::Pending->value
        ];
        assertTrue($admin->hasRole('admin'));
    
        actingAs($admin);
    
        livewire(CreateServiceRequest::class)
            ->fillForm($input)
            ->call('create')
            ->assertSuccessful()
            ->assertHasNoErrors();
    
        assertDatabaseCount(ServiceRequest::class, 1);
        assertDatabaseHas(ServiceRequest::class, $input);
    });

    
});    

