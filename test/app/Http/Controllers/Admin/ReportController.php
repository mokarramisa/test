<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class ReportController extends Controller
{
    public function detectDevice ()
    {
        $agent = new Agent();
        dd($agent);
        $device = $agent->device();
        dd($device);
    }
}
