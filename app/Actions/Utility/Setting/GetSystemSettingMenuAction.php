<?php

namespace App\Actions\Utility\Setting;

use App\Helpers\Menu\Builder;
use App\Helpers\Menu\ModuleAccess;

class GetSystemSettingMenuAction
{
    public function handle()
    {
        $menu = [
            [
                'text' => 'System Settings',
                'url' => route('settings.systems.role.index'),
                'header' => true
            ],
            [
                'text' => 'Role Management',
                'url' => route('settings.systems.role.index'),
                'icon' =>  'VRole',
                'can' => 'view_systems_role_management'
            ],
        ];

        $builderSidebar = new Builder([
            new ModuleAccess(),
        ]);

        return array_values($builderSidebar->transformItems($menu));
    }
}