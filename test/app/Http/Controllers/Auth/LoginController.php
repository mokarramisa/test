<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class LoginController extends Controller
{
    public function login (Request $request)
    {

        // login process...

        // loginlog process
        $agent = new Agent();
        $loginLog = LoginLog::create([
            'device'   => $agent->device(),
            'platform' => $agent->platform(),
            'browser'  => $agent->browser() .'-V'. $agent->version($agent->browser()),
            'ip'       => $request->ip(),
            'user_id'  => auth()->user()->id,
            'shop_id'  => auth()->user()->shop_id 
        ]);

        return response(['status' => 'ok', 'message' => 'logged in successfuly']);
    }
}
