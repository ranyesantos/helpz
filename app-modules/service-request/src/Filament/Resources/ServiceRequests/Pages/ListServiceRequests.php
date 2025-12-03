<?php

namespace Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Helpz\ServiceRequest\Filament\Resources\ServiceRequests\ServiceRequestResource;
use Illuminate\Support\Facades\Auth;

class ListServiceRequests extends ListRecords
{
    protected static string $resource = ServiceRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Service Requests'),
            'active' => Tab::make('Your Service Requests')
                ->modifyQueryUsing(function(Builder $query) {
                    /** @var \Helpz\User\Models\User */
                    $userId = Auth::user();
                    
                    $query->where(
                        'technician_id', $userId->getKey()
                    );
                })
        ];
    }
}
