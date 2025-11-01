<?php

namespace Helpz\ServiceRequest\Filament\Resources\ServiceRequests;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Pages\CreateServiceRequest;
use Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Pages\EditServiceRequest;
use Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Pages\ListServiceRequests;
use Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Schemas\ServiceRequestForm;
use Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Tables\ServiceRequestsTable;
use Helpz\ServiceRequest\Models\ServiceRequest;

class ServiceRequestResource extends Resource
{
    protected static ?string $model = ServiceRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        
        /** @var \App\Models\User */
        $user = Auth::user(); 

        if ($user->isAdmin()){
            return $query;
        }

        return $query->where('user_id', Auth::id());
    }
    public static function form(Schema $schema): Schema
    {
        return ServiceRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceRequestsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceRequests::route('/'),
            'create' => CreateServiceRequest::route('/create'),
            'edit' => EditServiceRequest::route('/{record}/edit'),
        ];
    }
}
