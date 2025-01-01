<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(Request $request) {
        return view('index');
    }

    public function page(Request $request, $page) {
        return view('page');
    }
}
