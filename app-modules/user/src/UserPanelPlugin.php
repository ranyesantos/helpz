<?php

namespace Helpz\User;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Helpz\User\Filament\Resources\Users\UserResource;

class UserPanelPlugin implements Plugin
{
    public function getId(): string
    {
        return 'user';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            UserResource::class
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}