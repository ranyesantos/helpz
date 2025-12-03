<?php

use Spatie\Permission\Models\Permission;
use Filament\Actions\Testing\TestAction;
use Helpz\Device\Filament\Resources\Devices\Pages\ListDevices;
use Helpz\Device\Models\Device;
use Helpz\User\Enums\UserRolesEnum;
use Helpz\User\Models\User;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Livewire\livewire;

beforeEach(function (): void {
    $role = Role::create(['name' => UserRolesEnum::Admin]);
    $role->givePermissionTo(Permission::all());
    $this->devices = Device::factory()->count(10)->create();
    $this->admin = User::factory()->getAdmin()->create();
    $this->user = User::factory()->create();
});

describe('device list displayment', function (): void {
    it('should return http status 403 forbidden for common user', function (): void {
        actingAs($this->user);
        
        livewire(ListDevices::class)
            ->assertStatus(Response::HTTP_FORBIDDEN);
    });

    it('allows admin user to view device list with all records and columns', function (): void {
        actingAs($this->admin);
        
        livewire(ListDevices::class)
            ->assertOk()
            ->assertCanRenderTableColumn('model')
            ->assertCanRenderTableColumn('brand')
            ->assertCanRenderTableColumn('device_code')
            ->assertCanRenderTableColumn('serial_number')
            ->assertCanSeeTableRecords($this->devices);
    });

    it('can delete all items as admin user', function (): void {
        actingAs($this->admin);

        livewire(ListDevices::class)
            ->assertCanSeeTableRecords($this->devices)
            ->selectTableRecords($this->devices)
            ->callAction(TestAction::make('delete')->table()->bulk())
            ->assertNotified()
            ->assertCanNotSeeTableRecords($this->devices);


        $this->devices->each(fn (Device $device) => 
        assertDatabaseMissing($device));
    });

    it('can delete one single item as admin user', function (): void {
        actingAs($this->admin);

        livewire(ListDevices::class)
            ->assertCanSeeTableRecords([$this->devices->first()])
            ->selectTableRecords([$this->devices->first()])
            ->callAction(TestAction::make('delete')->table()->bulk())
            ->assertNotified()
            ->assertCanNotSeeTableRecords([$this->devices->first()]);
        
        assertDatabaseMissing($this->devices->first());
    });

    it('can search devices by model name', function (): void {
        actingAs($this->admin);

        livewire(ListDevices::class)
            ->assertOk()
            ->searchTable($this->devices->first()->model)
            ->assertCanSeeTableRecords($this->devices->where(['model', $this->devices->first()->model]))
            ->assertCanNotSeeTableRecords($this->devices->where(['model', '!=', $this->devices->first()->model]));
    });

    it('can search devices by brand name', function (): void {
        actingAs($this->admin);

        livewire(ListDevices::class)
            ->assertOk()
            ->searchTable($this->devices->first()->brand)
            ->assertCanSeeTableRecords($this->devices->where(['brand', $this->devices->first()->brand]))
            ->assertCanNotSeeTableRecords($this->devices->where(['brand', '!=', $this->devices->first()->brand]));
    });

    it('can search devices by device code', function (): void {
        actingAs($this->admin);

        livewire(ListDevices::class)
            ->assertOk()
            ->searchTable($this->devices->first()->device_code)
            ->assertCanSeeTableRecords($this->devices->where(['device_code', $this->devices->first()->device_code]))
            ->assertCanNotSeeTableRecords($this->devices->where(['device_code', '!=', $this->devices->first()->device_code]));
    });

    it('can search devices by serial number', function (): void {
        actingAs($this->admin);

        livewire(ListDevices::class)
            ->assertOk()
            ->searchTable($this->devices->first()->serial_number)
            ->assertCanSeeTableRecords($this->devices->where(['serial_number', $this->devices->first()->serial_number]))
            ->assertCanNotSeeTableRecords($this->devices->where(['serial_number', '!=', $this->devices->first()->serial_number]));
    });

});