<?php

namespace Helpz\Report\Filament\Resources\Reports;

use Helpz\Report\Filament\Resources\Reports\Pages\CreateReport;
use Helpz\Report\Filament\Resources\Reports\Pages\EditReport;
use Helpz\Report\Filament\Resources\Reports\Pages\ListReports;
use Helpz\Report\Filament\Resources\Reports\Schemas\ReportForm;
use Helpz\Report\Filament\Resources\Reports\Tables\ReportsTable;
use Helpz\Report\Models\Report;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use BackedEnum;
use Helpz\Report\Filament\Resources\Reports\Pages\ViewReport;
use Helpz\Report\Filament\Resources\Reports\RelationManagers\DeviceRelationManager;
use Helpz\Report\Filament\Resources\Reports\RelationManagers\ServiceRequestRelationManager;
use Helpz\Report\Filament\Resources\Reports\RelationManagers\UserRelationManager;
use Helpz\Report\Filament\Resources\Reports\Schemas\ReportInfolist;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ReportForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReportInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReportsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ServiceRequestRelationManager::class,
            UserRelationManager::class,
            DeviceRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReports::route('/'),
            'create' => CreateReport::route('/create'),
            'view' => ViewReport::route('/{record}'),
            'edit' => EditReport::route('/{record}/edit')
        ];
    }
}
