<?php

namespace Helpz\Device\Filament\Resources\Devices;

use App\Filament\Resources\Devices\Tables\DevicesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Helpz\Device\Filament\Resources\Devices\Pages\CreateDevice;
use Helpz\Device\Filament\Resources\Devices\Pages\EditDevice;
use Helpz\Device\Filament\Resources\Devices\Pages\ListDevices;
use Helpz\Device\Filament\Resources\Devices\Pages\ViewDevice;
use Helpz\Device\Filament\Resources\Devices\Schemas\DeviceForm;
use Helpz\Device\Filament\Resources\Devices\Tables\DevicesTable as TablesDevicesTable;
use Helpz\Device\Models\Device;

class DeviceResource extends Resource
{
    protected static ?string $model = Device::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DeviceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TablesDevicesTable::configure($table);
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
            'index' => ListDevices::route('/'),
            'create' => CreateDevice::route('/create'),
            'view' => ViewDevice::route('/{record}'),
            'edit' => EditDevice::route('/{record}/edit'),
        ];
    }
}
