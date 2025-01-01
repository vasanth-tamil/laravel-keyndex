@extends('layouts.admin_layout')

@section('title', 'Policy & Terms')

@section('header-title', 'App Policies')

@section('content')
    <div class="card">
        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><button class="table-sort" data-sort="sort-sno">S.No</button></th>
                            <th><button class="table-sort" data-sort="sort-name">Title</button></th>
                            <th><button class="table-sort" data-sort="sort-type">Content</button></th>
                            <th><button class="table-sort" data-sort="sort-city">Type</button></th>
                            <th><button class="table-sort" data-sort="sort-date">Date</button></th>
                            <th><button class="table-sort" data-sort="sort-date">Actions</button></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach ($policies as $index => $policy)
                            <tr>
                                <td class="sort-name align-middle">{{ $index + 1 }}</td>
                                <td class="sort-title align-middle">{{ $policy->title }}</td>
                                <td class="sort-type align-middle">
                                    {{ Illuminate\Support\Str::of($policy->content)->limit(80) }}
                                </td>
                                <td class="sort-city align-middle">{{ $policy->type }}</td>
                                <td class="sort-date align-middle">{{ $policy->created_at }}</td>
                                <td class="sort-date align-middle">
                                    <a href="#" class="text-info text-decoration-none">
                                        <i class="ti ti-pencil-minus fs-2"></i>
                                    </a>
                                    <a href="#" class="text-danger px-2 text-decoration-none">
                                        <i class="ti ti-trash fs-2"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $policies->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script_top')
@endpush
