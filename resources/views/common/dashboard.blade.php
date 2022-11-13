@php
    $role_id = auth()->user()->role_id;
@endphp
@extends('layouts.app')
@section('main-content')
    @if ($role_id == 1)
        @include('admin.dashboard')
    @elseif ($role_id == 2)
        @include('company.dashboard')
    @elseif ($role_id == 3)
        @include('manager.dashboard')
    @elseif ($role_id == 4)
        @include('sales_executive.dashboard')
    @endif
@endsection 
