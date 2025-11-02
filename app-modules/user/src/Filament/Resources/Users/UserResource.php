<?php

namespace Helpz\User\Filament\Resources\Users;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Helpz\User\Filament\Resources\Users\Pages\CreateUser;
use Helpz\User\Filament\Resources\Users\Pages\EditUser;
use Helpz\User\Filament\Resources\Users\Pages\ListUsers;
use Helpz\User\Filament\Resources\Users\RelationManagers\ServiceRequestsRelationManager;
use Helpz\User\Filament\Resources\Users\Schemas\UserForm;
use Helpz\User\Filament\Resources\Users\Tables\UsersTable;
use Helpz\User\Models\User;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ServiceRequestsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
