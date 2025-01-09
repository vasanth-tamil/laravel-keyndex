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
                    <h2 class="h2 text-center text-white mb-4">Login to your account</h2>
                    <form action="{{ route('admin.sign-in') }}" method="POST" autocomplete="off">
                        @csrf

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="your@email.com"
                                autocomplete="off">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                                <span class="form-label-description">
                                    <a href="#">I forgot password</a>
                                </span>
                            </label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Your password"
                                autocomplete="off">


                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        {{-- REMEMBER CHECKBOX --}}
                        <div class="mb-2 mt-3">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="remember_me" value="true" />
                                <span class="form-check-label">Remember me on this device</span>
                            </label>
                        </div>

                        {{-- SUBMIT --}}
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center text-secondary mt-3">
                Don't have account yet? <a href="{{ route('admin.auth.sign-up') }}" tabindex="-1">Sign up</a>
            </div>
        </div>
    </div>
@endsection
