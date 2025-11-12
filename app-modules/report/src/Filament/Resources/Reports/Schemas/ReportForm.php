<?php

namespace Helpz\Report\Filament\Resources\Reports\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Helpz\User\Models\User;

class ReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('description')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->disabled(),
            ]);
    }
}
