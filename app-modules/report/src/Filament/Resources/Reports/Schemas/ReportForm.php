<?php

namespace Helpz\Report\Filament\Resources\Reports\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class ReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('description')
                    ->default('ni hao')
                    ->required(),
                Hidden::make('user_id')
                    ->required()
                    ->default(Auth::id()),
                Hidden::make('service_request_id')
                    ->required()
                    ->default(request()->get('service_request_id')),
                Hidden::make('device_id')
                    ->required()
                    ->default(request()->get('device_id')),
            ]);
    }
}
