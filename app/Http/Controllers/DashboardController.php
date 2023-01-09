<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends AdminBaseController
{
    public function __construct()
    {
        $this->title = "Dashboard";
        $this->path = "dashboard/index";
    }
}
