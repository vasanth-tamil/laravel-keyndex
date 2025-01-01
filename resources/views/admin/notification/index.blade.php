@extends('layouts.admin_layout')

@section('title', 'Admin Dashboard')
@section('header-title', 'Notifications')

@section('content')
    <div class="card">
        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><button class="table-sort" data-sort="sort-sno">S.No</button></th>
                            <th><button class="table-sort" data-sort="sort-name">Title</button></th>
                            <th><button class="table-sort" data-sort="sort-city">Message</button></th>
                            <th><button class="table-sort" data-sort="sort-type">Target</button></th>
                            <th><button class="table-sort" data-sort="sort-score">Type</button></th>
                            <th><button class="table-sort" data-sort="sort-date">Date</button></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach ($notifications as $index => $notification)
                            <tr>
                                <td class="sort-name">{{ $index + 1 }}</td>
                                <td class="sort-title">{{ $notification->title }}</td>
                                <td class="sort-city">{{ $notification->message }}</td>
                                <td class="sort-type">{{ $notification->target ?? '-' }}</td>
                                <td class="sort-score">{{ $notification->type }}</td>
                                <td class="sort-date" data-date="1628071164">{{ $notification->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script_top')
@endpush
