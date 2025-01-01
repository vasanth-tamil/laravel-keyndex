<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginActivity;
use Illuminate\Http\Request;

class LoginActivityController extends Controller
{
    public function index(Request $request)
    {
        $loginActivities = LoginActivity::paginate(10);
        return view('admin.login_activity.index', compact('loginActivities'));
    }
}
