@php
    $role_id = auth()->user()->role_id;
    $users_active = true;
@endphp
@extends('layouts.app')

@section('main-content')
    <div class="row">
        <div class=" col-12">
            <div class="card mb-5 shadow-sm">
                <h5 class="card-header">Add User</h5>
                <div class="card-body">
                    <form action="{{ route('user.update',$user->id) }}" method='post'>
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="name" class="text-capitalize"> Name <span>*</span></label>
                                <input required type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror " value="{{ $user->name }}"
                                    id="name">
                                @error('name')
                                    <span> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="role" class="text-capitalize"> Role <span>*</span></label>
                                <select name="role" id="role" required
                                    class="form-control @error('name') is-invalid @enderror ">
                                    @if ($role_id == 1)
                                        <option {{ $user->role == 2 ? 'selected' :'' }} value="2">Company</option>
                                    @elseif ($role_id == 2)
                                        <option {{ $user->role == 3 ? 'selected' :'' }} value="3">Manager</option>
                                    @elseif ($role_id == 3)
                                        <option {{ $user->role == 4 ? 'selected' :'' }} value="4">Sales Executive</option>
                                    @endif
                                </select>
                                @error('role')
                                    <span> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="email " class="text-capitalize"> email <span>*</span></label>
                                <input required type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror " value="{{ $user->email }}"
                                    id="email ">
                                @error('email')
                                    <span> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="mobile" class="text-capitalize">mobile </label>
                                <input required type="text" name="mobile"
                                    class="form-control @error('mobile') is-invalid @enderror " value="{{ $user->phone_number }}"
                                    id="mobile">
                                @error('mobile')
                                    <span> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-12 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-warning">Update</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
