@extends('layouts.empty_layout')

@section('title', 'Sign In')

@section('content')
    <div class="page page-center vh-100">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('assets/icon/icon.svg') }}" alt="Tabler">
                </a>
            </div>

            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center text-white mb-4">Create Your Account</h2>
                    <form action="#" method="get" autocomplete="off" novalidate>
                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" placeholder="your@email.com" autocomplete="off">
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-2">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Your password" autocomplete="off">
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Re-Password</label>
                            <input type="password" class="form-control" placeholder="Your re-password" autocomplete="off">
                        </div>
                        {{-- REMEMBER CHECKBOX --}}
                        <div class="mb-2 mt-3">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" />
                                <span class="form-check-label">Automatically sign me in</span>
                            </label>
                        </div>

                        {{-- SUBMIT --}}
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center text-secondary mt-3">
                Don't have account yet? <a href="{{ route('admin.auth.sign-in') }}" tabindex="-1">Sign In</a>
            </div>
        </div>
    </div>
@endsection
