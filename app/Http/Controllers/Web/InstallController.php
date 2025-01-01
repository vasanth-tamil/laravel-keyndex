<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstallController extends Controller
{
    public function installation(Request $request) {
        return view('install.index');
    }

    public function install(Request $request) {}
}
