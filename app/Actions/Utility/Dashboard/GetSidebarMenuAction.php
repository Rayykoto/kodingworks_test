<?php

namespace App\Actions\Utility\Dashboard;

use App\Actions\Utility\Setting\GetSystemSettingMenuAction;

class GetSidebarMenuAction
{
    public function handle()
    {
        $getSystemSettingMenu = new GetSystemSettingMenuAction();

        return [
            [
                'text' => 'Dashboard',
                'url'  => route('dashboard.index'),
                'icon' => 'VDashboard',
                'can'  => 'view_general_dashboard'
            ],
            [
                'text' => 'Audit Trails',
                'icon' => 'VEmployee',
                'group' => true,
                'can'  => ['view_admin_logs'],
                'submenu' => [
                    [
                        'text' => 'Admin Logs',
                        'url'  => route('audits.admin-logs.index'),
                        'can'  => 'view_admin_logs',
                    ],
                    [
                        'text' => 'Api Logs',
                        'url'  => route('audits.api-logs.index'),
                        'can'  => 'view_admin_logs',
                    ]
                ],
            ],
            [
                'text' => 'Settings',
                'icon' => 'VSetting',
                'group' => true,
                'can' => ['view_systems_role_management'],
                'submenu' => [
                    [
                        'text' => 'Systems',
                        'url'  => $getSystemSettingMenu->handle()[1]['url'] ?? route('settings.systems.role.index'),
                        'can'  => ['view_systems_role_management']
                    ]
                ],
            ]
        ];
    }
}