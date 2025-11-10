<?php

namespace Helpz\Report\Filament\Resources\Reports\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('description')
                    ->required()
            ]);
    }
}
