<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\TelescopeServiceProvider::class,
    Laravel\Telescope\TelescopeServiceProvider::class,
    Helpz\AiIntegration\Providers\AiServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
];
