@extends('layouts.admin_layout')

@section('title', 'Admin Dashboard')

@section('header-title', 'Dashboard')
@section('content')
    <div class="col-12">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card bg-primary text-primary-fg">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-primary">
                            <i class="ti ti-checks"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Welcome to Your Workspace</h3>
                        <p>Explore powerful features and tools designed to streamline your workflow. Let’s get started!</p>
                    </div>
                </div>
            </div>
            @foreach ($data as $index => $value)
                <x-dashboard-card :value="$value" />
            @endforeach
        </div>
    </div>
@endsection
