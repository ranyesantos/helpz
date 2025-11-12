<?php

use Filament\Actions\Testing\TestAction;
use Helpz\Report\Filament\Resources\Reports\Pages\ListReports;
use Helpz\Report\Models\Report;
use Helpz\User\Enums\UserRolesEnum;
use Helpz\User\Models\User;

use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;


describe('when common user is logged-in', function (): void {
    beforeEach(function (): void {
        $this->commonUser = User::factory()->create();
    });

    it('return 403 http status code if it attempt to access listing view', function ():void {
        actingAs($this->commonUser);

        livewire(ListReports::class)
            ->assertStatus(Response::HTTP_FORBIDDEN);
    });
});

describe('when admin user is logged-in', function (): void {
    beforeEach(function (): void {
        Role::create(['name' => UserRolesEnum::Admin]);

        $this->reports = Report::factory()
            ->count(10)
            ->create();

        $this->admin = User::factory()
            ->getAdmin()
            ->create();
    });

    it('can acess listing view', function (): void {
        actingAs($this->admin);

        livewire(ListReports::class)
            ->assertCanSeeTableRecords($this->reports)
            ->assertCanRenderTableColumn('description')
            ->assertCanRenderTableColumn('user.name')
            ->assertCanRenderTableColumn('serviceRequest.title')
            ->assertActionExists(TestAction::make('edit')->table($this->reports))
            ->assertOk();
    });
});

describe('when technician user is logged-in', function (): void {
    beforeEach(function (): void {
        Role::create(['name' => UserRolesEnum::Technician]);
        
        $this->reports = Report::factory()
            ->count(10)
            ->create();

        $this->technician = User::factory()
            ->getTechnicianRole()
            ->create();
    });

    it('can acess listing view', function (): void {
        actingAs($this->technician);

        livewire(ListReports::class)
            ->assertCanSeeTableRecords($this->reports)
            ->assertCanRenderTableColumn('description')
            ->assertCanRenderTableColumn('user.name')
            ->assertCanRenderTableColumn('serviceRequest.title')
            ->assertActionDoesNotExist('edit')
            ->assertOk();
    });
});