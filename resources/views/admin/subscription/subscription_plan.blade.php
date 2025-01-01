@extends('layouts.admin_layout')

@section('title', 'Admin Subscription Plans')

@section('header-title', 'Subscription Plans')

@section('content')
    <div class="card">
        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><button class="table-sort" data-sort="sort-sno">S.No</button></th>
                            <th><button class="table-sort" data-sort="sort-name">Plan Name</button></th>
                            <th><button class="table-sort" data-sort="sort-city">Days</button></th>
                            <th><button class="table-sort" data-sort="sort-type">Amount</button></th>
                            <th><button class="table-sort" data-sort="sort-score">Status</button></th>
                            <th><button class="table-sort" data-sort="sort-date">Date</button></th>
                            <th><button class="table-sort" data-sort="sort-date">Actions</button></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach ($subscriptionPlans as $index => $subscriptionPlan)
                            <tr>
                                <td class="sort-name">{{ $index + 1 }}</td>
                                <td class="sort-title">{{ $subscriptionPlan->plan_name }}</td>
                                <td class="sort-city">{{ $subscriptionPlan->days }}</td>
                                <td class="sort-type">{{ Helper::formatPrice($subscriptionPlan->price) }}</td>
                                <td class="sort-score">{{ $subscriptionPlan->status ? 'Active' : 'Inactive' }}</td>
                                <td class="sort-date">{{ $subscriptionPlan->created_at }}</td>
                                <td class="sort-date">
                                    <a href="#" class="text-info text-decoration-none">
                                        <i class="ti ti-pencil-minus fs-2"></i>
                                    </a>
                                    <a href="#" class="text-danger text-decoration-none">
                                        <i class="ti ti-trash px-2 fs-2"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $subscriptionPlans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script_top')
@endpush
