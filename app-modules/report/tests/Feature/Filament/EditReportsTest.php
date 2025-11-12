<?php

use Helpz\Report\Filament\Resources\Reports\Pages\EditReport;
use Helpz\Report\Filament\Resources\Reports\RelationManagers\DeviceRelationManager;
use Helpz\Report\Filament\Resources\Reports\RelationManagers\ServiceRequestRelationManager;
use Helpz\Report\Filament\Resources\Reports\RelationManagers\UserRelationManager;
use Helpz\Report\Filament\Resources\Reports\ReportResource;
use Helpz\Report\Models\Report;
use Helpz\User\Enums\UserRolesEnum;
use Helpz\User\Models\User;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

describe('when technician user is logged-in', function (): void {
    beforeEach(function (): void {
        Role::create(['name' => UserRolesEnum::Technician]);
        
        actingAs(User::factory()
            ->getTechnicianRole()
            ->create()
        );
    });

    it('return 403 http status code when it attempt to acess edit view', function (): void {
        $report = Report::factory()->create();
        
        livewire(EditReport::class, [
            'record' => $report->getKey()
        ])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    });
});

describe('when common user is logged-in', function (): void {
    beforeEach(function (): void {
        $this->user = User::factory()
            ->create();
            
        actingAs($this->user);
    });

    it('return 403 http status code when it attempt to acess edit view', function (): void {
        $report = Report::factory()->create();
        
        livewire(EditReport::class, [
            'record' => $report->getKey()
        ])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    });
});

describe('when admin user is logged-in', function (): void {
    beforeEach(function (): void {
        Role::create(['name' => UserRolesEnum::Admin]);
        
        $this->admin = User::factory()
            ->getAdmin()
            ->create();

        $this->report = Report::factory()->create();

        actingAs($this->admin);

    }); 

    it('can load the page', function (): void {

        livewire(EditReport::class, [
            'record' => $this->report->getKey()
        ])
            ->assertSchemaStateSet([
                'description' => $this->report->description,
                'user_id' => $this->report->user_id
            ]);
    });

    it('can load relation managers', function ($relationManager): void {

        livewire(EditReport::class, [
            'record' => $this->report->getKey(),
            'activeRelationManager' => array_search(
                $relationManager,
                ReportResource::getRelations()
            ),
        ])        
            ->assertOk()
            ->assertSeeLivewire($relationManager);
    })->with([
        ServiceRequestRelationManager::class,
        UserRelationManager::class,
        DeviceRelationManager::class
    ]);
});