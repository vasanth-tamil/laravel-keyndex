<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PluginController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.plugin.index');
    }
}
