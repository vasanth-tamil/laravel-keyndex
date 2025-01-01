@extends('layouts.empty_layout')

@section('title', 'Admin Dashboard')

@section('header-title', 'Installation Setup')
@section('content')
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow p-4" style="width: 350px;">
            <div class="text-center">
                <img src="assets/icon/icon.svg" alt="Icon">
            </div>
            <h3 class="text-start text-white my-2">Welcome to Installation</h3>
            <p>We happy to see you here! easy to setup your project.</p>

            <ul class="list-unstyled list-group-flush d-flex flex-column gap-2 mt-2">
                <li>
                    <i class="ti ti-check"></i> Create tables
                </li>
                <li>
                    <i class="ti ti-check"></i> Setup Admin Default Credentials
                </li>
                <li>
                    <i class="ti ti-check"></i> Configure Database Connection
                </li>
                <li>
                    <i class="ti ti-check"></i> Install Required Dependencies
                </li>
                <li>
                    <i class="ti ti-check"></i> Set Up Application Environment
                </li>
                <li>
                    <div class="spinner-border spinner-border-sm" role="status"></div>
                    Verify Installation Process
                </li>
            </ul>

            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Let's Go</a>
        </div>
    </div>
@endsection
