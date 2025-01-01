@extends('layouts.admin_layout')

@section('title', 'Admin Users')

@section('header-title', 'Admin Users')

@section('content')
    <div class="card">
        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><button class="table-sort" data-sort="sort-sno">S.No</button></th>
                            <th><button class="table-sort" data-sort="sort-name">Name</button></th>
                            <th><button class="table-sort" data-sort="sort-type">email</button></th>
                            <th><button class="table-sort" data-sort="sort-city">is Subscriber</button></th>
                            <th><button class="table-sort" data-sort="sort-city">Status</button></th>
                            <th><button class="table-sort" data-sort="sort-date">Created At</button></th>
                            <th><button class="table-sort" data-sort="sort-date">Actions</button></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach ($users as $index => $user)
                            <tr>
                                <td class="sort-name align-middle">{{ $index + 1 }}</td>
                                <td class="sort-title align-middle">{{ $user->f_name }} {{ $user->l_name }}</td>
                                <td class="sort-type align-middle">{{ $user->email }}</td>
                                <td class="sort-city align-middle">{{ $user->is_subscribed ? 'Yes' : 'No' }}</td>
                                <td class="sort-city align-middle">{{ $user->status ? 'Active' : 'Inactive' }}</td>
                                <td class="sort-date align-middle">{{ $user->created_at }}</td>
                                <td class="sort-date align-middle">
                                    <a href="#" class="text-info text-decoration-none">
                                        <i class="ti ti-notes fs-2"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script_top')
@endpush
