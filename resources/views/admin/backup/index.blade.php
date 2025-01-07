@extends('layouts.admin_layout')

@section('title', 'Admin Login Activity')
@section('header-title', 'Activity Logs')

@section('header-actions')
    <div class="btn-list">
        <div class="d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.backup.create') }}" class="btn btn-primary">
                Backup Now
                <i class="ti ti-database-export ps-2"></i>
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><button class="table-sort" data-sort="sort-sno">S.No</button></th>
                            <th><button class="table-sort" data-sort="sort-name">Note</button></th>
                            <th><button class="table-sort" data-sort="sort-city">File Size (MB)</button></th>
                            <th><button class="table-sort" data-sort="sort-score">Checksum</button></th>
                            <th><button class="table-sort" data-sort="sort-score">Created By</button></th>
                            <th><button class="table-sort" data-sort="sort-date">Backup Date</button></th>
                            <th><button class="table-sort" data-sort="sort-date">Actions</button></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach ($data as $index => $backup)
                            <tr>
                                <td class="sort-name">{{ $index + 1 }}</td>
                                <td class="sort-title">{{ $backup->name }}</td>
                                <td class="sort-city">{{ $backup->size_in_mb }} MB</td>
                                <td class="sort-type">{{ $backup->checksum }}</td>
                                <td class="sort-type">{{ $backup->creator->name }}</td>
                                <td class="sort-date">{{ $backup->backup_at }}</td>
                                <td class="sort-date">
                                    <a href="{{ route('admin.backup.download', $backup->id) }}"
                                        class="text-info text-decoration-none">
                                        <i class="ti ti-download px-2 fs-2"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script_top')
@endpush
