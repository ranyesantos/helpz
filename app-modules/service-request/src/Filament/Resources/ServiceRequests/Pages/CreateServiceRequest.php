<?php

namespace Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Pages;

use Filament\Resources\Pages\CreateRecord;
use Helpz\ServiceRequest\Filament\Resources\ServiceRequests\ServiceRequestResource;

class CreateServiceRequest extends CreateRecord
{
    protected static string $resource = ServiceRequestResource::class;
}
