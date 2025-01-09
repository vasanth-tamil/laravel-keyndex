<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function uptime(Request $request)
    {
        return view('admin.server.uptime');
    }
}
