@php
    $customers_active = true;
@endphp
@extends('layouts.app')
@section('main-content')
    <div class="row">
        <div class=" col-12">
            <div class="card mb-5 shadow-sm">
                <h5 class="card-header">Update Customer</h5>
                <div class="card-body">
                    <form action="{{ route('customer.update',$customer->id) }}" method='post'>
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="company_name" class="text-capitalize">company name</label>
                                <input type="text" name="company_name"
                                    class="form-control @error('company_name') is-invalid @enderror "
                                    value="{{ $customer->company_name }}" id="company_name">
                                @error('company_name')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="name" class="text-capitalize">Customar Name </label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror " value="{{ $customer->name }}"
                                    id="name">
                                @error('name')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="email " class="text-capitalize"> email </label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror "
                                    value="{{ $customer->email }}" id="email ">
                                @error('email')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="phone_number" class="text-capitalize">phone number </label>
                                <input type="text" name="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror "
                                    value="{{ $customer->phone_number }}" id="phone_number">
                                @error('phone_number')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-sm-12 mb-3">
                                <label for="address" class="text-capitalize">address</label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address">{{ $customer->address }}</textarea>

                                @error('address')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-warning">Submit</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
