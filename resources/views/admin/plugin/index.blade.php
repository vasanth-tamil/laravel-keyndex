@extends('layouts.admin_layout')

@section('title', 'Admin Plugins')
@section('header-title', 'Plugins Management')

@section('content')
    <div class="row row-cards">
        @for ($i = 0; $i < 10; $i++)
            <x-plugin-card />
        @endfor
    </div>
@endsection
