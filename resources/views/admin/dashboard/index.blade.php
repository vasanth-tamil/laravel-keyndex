@extends('layouts.admin_layout')

@section('title', 'Admin Dashboard')

@section('content')
@section('header-title', 'Dashboard')

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
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            {{-- ICON --}}
                            <div class="col-auto">
                                <span class="{{ $value->color }} text-white avatar">
                                    <i class="ti {{ $value->icon }} fs-2"></i>
                                </span>
                            </div>

                            {{-- CONTENT --}}
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $value->title }}
                                </div>
                                <div class="text-secondary">
                                    {{ $value->subTitle }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
