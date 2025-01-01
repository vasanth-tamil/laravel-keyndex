<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $data = [
            'subscription' => (object) [
                'color' => 'bg-primary',
                'icon' => 'ti-cash',
                'title' => '₹ 43,560 Earnings',
                'subTitle' => '₹ 4,356 This Month',
            ],
            'subscriber' => (object) [
                'color' => 'bg-danger',
                'icon' => 'ti-users',
                'title' => '3,456 Subscribers',
                'subTitle' => '+567 This Month',
            ],
            'task' => (object) [
                'color' => 'bg-success',
                'icon' => 'ti-list-details',
                'title' => '445 Tasks',
                'subTitle' => '+334 This Month',
            ],
            'home' => (object) [
                'color' => 'bg-warning',
                'icon' => 'ti-database',
                'title' => '56 Backups',
                'subTitle' => '+43 This Month',
            ],
        ];

        notyf()->success('Welcome to Keyndex SAAS.');

        return view('admin.dashboard.index', compact('data'));
    }
}
