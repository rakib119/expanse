@extends('layouts.app')

@section('main-content')
    <div class="row">
        <div class=" col-12">
            <div class="card mb-5 shadow-sm">
                <h5 class="card-header">Add User</h5>
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method='post'>
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="name" class="text-capitalize"> Name <span>*</span></label>
                                <input required type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror " value="{{ old('name') }}"
                                    id="name">
                                @error('name')
                                    <span> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="email " class="text-capitalize"> email <span>*</span></label>
                                <input required type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror " value="{{ old('email') }}"
                                    id="email ">
                                @error('email')
                                    <span> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="mobile" class="text-capitalize">mobile </label>
                                <input required type="text" name="mobile"
                                    class="form-control @error('mobile') is-invalid @enderror " value="{{ old('mobile') }}"
                                    id="mobile">
                                @error('mobile')
                                    <span> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="password" class="text-capitalize">password<span>*</span></label>
                                <input required type="text" name="password"
                                    class="form-control @error('password') is-invalid @enderror "
                                    value="{{ old('password') }}" id="password">
                                @error('password')
                                    <span> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-12 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <button class="btn btn-space btn-secondary">Cancel</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
