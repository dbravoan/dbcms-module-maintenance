<?php

declare(strict_types=1);

namespace DbCms\Modules\Maintenance;

use DbCms\Core\Capabilities\CapabilityRegistry;
use DbCms\Core\DTOs\Modules\ModuleSettingsUpdateDTO;
use DbCms\Core\Modules\BaseModuleServiceProvider;
use DbCms\Core\Modules\Contracts\MaintenanceModeInterface;
use DbCms\Core\Modules\ModuleSettingsExtensionRegistry;
use DbCms\Modules\Maintenance\Capabilities\MaintenanceActionCatalog;
use DbCms\Modules\Maintenance\Capabilities\MaintenanceActions;
use DbCms\Modules\Maintenance\Contracts\MaintenanceSettingsAdministrationInterface;
use DbCms\Modules\Maintenance\Services\MaintenanceService;
use DbCms\Modules\Maintenance\Services\MaintenanceSettingsAdministrationService;
use Illuminate\View\View;

class MaintenanceModuleServiceProvider extends BaseModuleServiceProvider
{
    protected string $identifier = 'maintenance';

    protected string $name = 'Mantenimiento & Construcción';

    protected bool $isPageable = false;

    public function register(): void
    {
        $this->app->singleton(MaintenanceService::class);
        $this->app->alias(MaintenanceService::class, MaintenanceModeInterface::class);
        $this->app->bind(MaintenanceSettingsAdministrationInterface::class, MaintenanceSettingsAdministrationService::class);
    }

    public function boot(): void
    {
        $this->app->make(ModuleSettingsExtensionRegistry::class)->register('maintenance',
            fn (ModuleSettingsUpdateDTO $settings) => $this->app->make(MaintenanceSettingsAdministrationInterface::class)->update($settings),
            fn (): array => $this->app->make(MaintenanceSettingsAdministrationInterface::class)->view(),
        );
        $this->app->booted(function (): void {
            MaintenanceActionCatalog::register(
                $this->app->make(CapabilityRegistry::class),
                $this->app->make(MaintenanceActions::class),
            );
        });
        parent::boot();

        $this->loadViewsFrom(__DIR__.'/Resources/views', 'maintenance');
        \Illuminate\Support\Facades\View::composer('components.frontoffice-admin-bar', function (View $view): void {
            if ($this->app->make(MaintenanceService::class)->isActive()) {
                $view->getFactory()->startPush('front_admin_status', view('maintenance::admin.front-status')->render());
            }
        });
    }

    public function getAdminNavigation(): array
    {
        return [
            [
                'title' => __('admin.nav.items.maintenance'),
                'route' => 'admin.modules.settings',
                'params' => ['identifier' => 'maintenance'],
                'url' => route('admin.modules.settings', ['identifier' => 'maintenance']),
                'icon' => 'fa-solid fa-wrench',
                'permission' => 'manage:modules',
            ],
        ];
    }
}
