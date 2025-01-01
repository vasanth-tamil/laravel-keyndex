@extends('layouts.admin_layout')

@section('title', 'Admin Login Activity')
@section('header-title', 'Activity Logs')

@section('content')
    <div class="card">
        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><button class="table-sort" data-sort="sort-sno">S.No</button></th>
                            <th><button class="table-sort" data-sort="sort-name">IP Address</button></th>
                            <th><button class="table-sort" data-sort="sort-city">Operating System</button></th>
                            <th><button class="table-sort" data-sort="sort-type">User Agent</button></th>
                            <th><button class="table-sort" data-sort="sort-score">Login Type</button></th>
                            <th><button class="table-sort" data-sort="sort-date">Date</button></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach ($loginActivities as $index => $loginActivity)
                            <tr>
                                <td class="sort-name">{{ $index + 1 }}</td>
                                <td class="sort-title">{{ $loginActivity->ip_address }}</td>
                                <td class="sort-city">{{ $loginActivity->operating_system }}</td>
                                <td class="sort-type">{{ $loginActivity->user_agent ?? '-' }}</td>
                                <td class="sort-score">{{ strtoupper($loginActivity->login_type) }}</td>
                                <td class="sort-date" data-date="1628071164">{{ $loginActivity->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $loginActivities->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script_top')
@endpush
