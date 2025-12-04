<?php

use Filament\Actions\Testing\TestAction;
use Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Pages\ListServiceRequests;
use Helpz\ServiceRequest\Models\ServiceRequest;
use Helpz\User\Models\User;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Livewire\livewire;

beforeEach(function (): void {
    Role::create(['name' => 'technician']);
    $user = User::factory()->create();
    $technician = User::factory()->getTechnicianRole()->create();
    
    $this->userServiceRequests = ServiceRequest::factory()
                                    ->count(10)
                                    ->state([
                                        'user_id' => $user->getKey(),
                                        'technician_id' => $technician->getKey()
                                    ])
                                    ->create();
    
    actingAs($user);
});

test('user can only see their own service requests', function (): void {
    $allServiceRequests = ServiceRequest::factory()->count(10)->create();

    livewire(ListServiceRequests::class)
        ->assertOk()
        ->assertCanSeeTableRecords( $this->userServiceRequests)
        ->assertCanNotSeeTableRecords( $allServiceRequests)
        ->assertCountTableRecords(count($this->userServiceRequests))
        ->assertCanRenderTableColumn('title')
        ->assertCanRenderTableColumn('user.name')
        ->assertCanRenderTableColumn('device.serial_number')
        ->assertCanRenderTableColumn('status');
});

test('can search by service request title', function(): void {
    livewire(ListServiceRequests::class)
        ->assertOk()
        ->searchTable($this->userServiceRequests->first()->title)
        ->assertCanSeeTableRecords($this->userServiceRequests->where(['title', $this->userServiceRequests->first()->title]))
        ->assertCanNotSeeTableRecords($this->userServiceRequests->where(['title', '!=', $this->userServiceRequests->first()->title]));
});

test('can search service requests by user\'s name column', function(): void {
    livewire(ListServiceRequests::class)
        ->assertOk()
        ->searchTable($this->userServiceRequests->first()->user->name)
        ->assertCanSeeTableRecords($this->userServiceRequests->where(['user.name', $this->userServiceRequests->first()->user->name]))
        ->assertCanNotSeeTableRecords($this->userServiceRequests->where(['user.name', '!=', $this->userServiceRequests->first()->user->name]));
});

test('can search by device\'s serial number column', function(): void {
    livewire(ListServiceRequests::class)
        ->assertOk()
        ->searchTable($this->userServiceRequests->first()->device->serial_number)
        ->assertCanSeeTableRecords($this->userServiceRequests->where(['device.serial_number', $this->userServiceRequests->first()->device->serial_number]))
        ->assertCanNotSeeTableRecords($this->userServiceRequests->where(['device.serial_number', '!=', $this->userServiceRequests->first()->device->serial_number]));
});

test('can delete service requests', function(): void {
    $serviceRequests = $this->userServiceRequests;
    livewire(ListServiceRequests::class)
        ->assertCanSeeTableRecords($serviceRequests)
        ->selectTableRecords($serviceRequests)
        ->callAction(TestAction::make('delete')->table()->bulk())
        ->assertNotified()
        ->assertCanNotSeeTableRecords($serviceRequests);

    $serviceRequests->each(fn (ServiceRequest $serviceRequest) => assertDatabaseMissing($serviceRequest));
});