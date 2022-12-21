@php
    $role_id = auth()->user()->role_id;
    $users_active = true;
@endphp
@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection
@section('main-content')
    <div class="ecommerce-widget">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card shadow-sm mb-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5>{{ $role_id == 1 ? 'Company' : 'Employee' }} List</h5>
                        </div>
                        <div>
                            <a href="{{ route('user.create') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add
                                {{ $role_id == 1 ? 'Company' : 'Employee' }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id='myTable'>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Name</th>
                                    @if ($role_id == 2 || $role_id == 3)
                                        <th scope="col">commission</th>
                                    @endif
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone Number</th>
                                    @if ($role_id == 2)
                                        <th scope="col">Role</th>
                                    @endif
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @php
                                        $user_role = $user->role_id;
                                        $role = DB::table('roles')
                                            ->where('role_id', $user_role)
                                            ->first();
                                        $role = $role ? $role->role_name : 'unknown';

                                        $bg_color = $user_role == 3 ? 'bg-success' : ($user_role == 4 ? 'bg-secondary' : 'bg-danger');
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td> <img class="img-fluid" width="50" height="50"
                                                src="{{ asset('assets/images/profile/' . $user->profile_photo) }}"
                                                alt=""> </td>
                                        <td>{{ $user->name }}</td>
                                        @if ($role_id == 2 || $role_id == 3)
                                            <td>{{ $user->commission }}%</td>
                                        @endif
                                        <td>{{ $user->email ? $user->email : 'N/A' }}</td>
                                        <td>{{ $user->phone_number ? $user->phone_number : 'N/A' }}</td>
                                        @if ($role_id == 2)
                                            <th scope="col"> <span
                                                    class="badge text-light {{ $bg_color }}">{{ $role }}</span>
                                            </th>
                                        @endif
                                        <td>
                                            <div class="dropdown show">
                                                <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Action
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item"
                                                        href="{{ route('user.edit', Crypt::encrypt($user->id)) }}">Edit</a>
                                                    @if ($role_id == 2 || $role_id == 3)
                                                        <a class="dropdown-item"
                                                            href="{{ route('user.show', Crypt::encrypt($user->id)) }}">Dashboard</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
