<?php

namespace App\Filament\Resources\RelationManagerReceivers;

use App\Filament\Resources\RelationManagerReceivers\Pages\CreateRelationManagerReceiver;
use App\Filament\Resources\RelationManagerReceivers\Pages\EditRelationManagerReceiver;
use App\Filament\Resources\RelationManagerReceivers\Pages\ListRelationManagerReceivers;
use App\Filament\Resources\RelationManagerReceivers\Schemas\RelationManagerReceiverForm;
use App\Filament\Resources\RelationManagerReceivers\Tables\RelationManagerReceiversTable;
use App\Models\RelationManagerReceiver;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RelationManagerReceiverResource extends Resource
{
    protected static ?string $model = RelationManagerReceiver::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ohno';

    public static function form(Schema $schema): Schema
    {
        return RelationManagerReceiverForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RelationManagerReceiversTable::configure($table);
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
            'index' => ListRelationManagerReceivers::route('/'),
            'create' => CreateRelationManagerReceiver::route('/create'),
            'edit' => EditRelationManagerReceiver::route('/{record}/edit'),
        ];
    }
}
