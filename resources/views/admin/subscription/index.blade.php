@extends('layouts.admin_layout')

@section('title', 'Admin Subscriptions')

@section('header-title', 'Subscriptions')

@section('content')
    <div class="card">
        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><button class="table-sort" data-sort="sort-sno">S.No</button></th>
                            <th><button class="table-sort" data-sort="sort-name">Code</button></th>
                            <th><button class="table-sort" data-sort="sort-type">Subscriber</button></th>
                            <th><button class="table-sort" data-sort="sort-city">Payment Method</button></th>
                            <th><button class="table-sort" data-sort="sort-city">Status</button></th>
                            <th><button class="table-sort" data-sort="sort-date">Subscribe Plan</button></th>
                            <th><button class="table-sort" data-sort="sort-date">Expired At</button></th>
                            <th><button class="table-sort" data-sort="sort-date">Actions</button></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach ($subscriptions as $index => $subscription)
                            <tr>
                                <td class="sort-name align-middle">{{ $index + 1 }}</td>
                                <td class="sort-title align-middle">{{ $subscription->code }}</td>
                                <td class="sort-type align-middle">
                                    {{ $subscription->subscriber->f_name }}
                                    {{ $subscription->subscriber->l_name }}
                                </td>
                                <td class="sort-city align-middle">{{ $subscription->payment_method }}</td>
                                <td class="sort-city align-middle">{{ $subscription->status }}</td>
                                <td class="sort-date align-middle">{{ $subscription->subscriptionPlan->plan_name }}</td>
                                <td class="sort-city align-middle">{{ $subscription->expires_at }}</td>
                                <td class="sort-date align-middle">
                                    <a href="#" class="text-info text-decoration-none">
                                        <i class="ti ti-refresh fs-2"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $subscriptions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_top')
@endpush
