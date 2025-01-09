<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function sign_in(Request $request)
    {
        if($request->isMethod('post')) {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if (Auth::guard('admin')->attempt($credentials)) {

                notyf()->success('logged in successfully.');
                return redirect()->route('admin.dashboard');
            }

            // 3. if correct return token otherwise throw
            notyf()->error('wrong credentials. check and try again.');
            return redirect()->back();
        }

        // CHECK LOGIN
        if(!Auth::guard('admin')->check()) {
            return view('admin.auth.sign-in');
        }
        return redirect()->route('admin.dashboard');
    }

    public function sign_up(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
                return redirect(route('dashboard'));
            }

            // 3. if correct return token otherwise throw
            return redirect()->back()->withErrors(['message' => 'wrong credentials. check and try again.']);
        }
        // CHECK LOGIN
        if (!Auth::guard('admin')->check()) {
            // return redirect()->route('admin.dashboard');
            return view('admin.auth.sign-up');
        }
        return redirect()->route('admin.dashboard');
    }

    public function sign_out(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('admin.auth.sign-in');
    }
}
