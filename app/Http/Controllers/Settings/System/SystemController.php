<?php

namespace App\Http\Controllers\Settings\System;

use Inertia\Inertia;
use App\Http\Controllers\AdminBaseController;
use App\Actions\Utility\Setting\GetSystemSettingMenuAction;

class SystemController extends AdminBaseController
{
    public function __construct(
        GetSystemSettingMenuAction $getSystemSettingMenu
    ) {
        $this->getSystemSettingMenu = $getSystemSettingMenu;
    }

    public function roleSettingIndex()
    {
        return Inertia::render($this->source . 'settings/systems/role/Index', [
            "title" => 'Setting System Authentication',
            "additional" => [
                'menu' => $this->getSystemSettingMenu->handle()
            ]
        ]);
    }
}
