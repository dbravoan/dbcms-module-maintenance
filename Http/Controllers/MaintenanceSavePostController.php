<?php

declare(strict_types=1);

namespace DbCms\Modules\Maintenance\Http\Controllers;

use DbCms\Core\DTOs\Modules\ModuleSettingsUpdateDTO;
use DbCms\Core\Http\Controllers\Controller;
use DbCms\Modules\Maintenance\Contracts\MaintenanceSettingsAdministrationInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class MaintenanceSavePostController extends Controller
{
    public function __construct(private readonly MaintenanceSettingsAdministrationInterface $service) {}

    public function __invoke(Request $request): RedirectResponse
    {
        $this->service->update(new ModuleSettingsUpdateDTO($request->except(['_token', '_method'])));

        return redirect()->route('admin.modules.settings', ['identifier' => 'maintenance'])->with('success', 'Configuración de Mantenimiento & Construcción guardada correctamente.');
    }
}
