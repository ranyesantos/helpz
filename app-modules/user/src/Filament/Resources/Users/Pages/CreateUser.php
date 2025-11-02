<?php

namespace Helpz\User\Filament\Resources\Users\Pages;

use Filament\Resources\Pages\CreateRecord;
use Helpz\User\Filament\Resources\Users\UserResource;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
