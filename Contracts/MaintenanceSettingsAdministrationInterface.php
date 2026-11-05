<?php

declare(strict_types=1);

namespace DbCms\Modules\Maintenance\Contracts;

use DbCms\Core\DTOs\Modules\ModuleSettingsUpdateDTO;

interface MaintenanceSettingsAdministrationInterface
{
    public function update(ModuleSettingsUpdateDTO $settings): void;

    /** @return array<string,mixed> */
    public function view(): array;

    public function toggle(): bool;

    public function preview(): string;
}
