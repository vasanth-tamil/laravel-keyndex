<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index(Request $request) {
        $policies = Policy::paginate(10);
        return view('admin.policy.index', compact('policies'));
    }
}
