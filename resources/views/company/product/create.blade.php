@php
    $product_active = true;
@endphp
@extends('layouts.app')
@section('main-content')
    <div class="row">
        <div class=" col-12">
            <div class="card mb-5 shadow-sm">
                <h5 class="card-header">Add Products Or Services</h5>
                <div class="card-body mt-4">
                    <form action="{{ route('product.store') }}" method='post'>
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 mb-3">
                                <label for="name" class="text-capitalize">Product Name  <span>*</span></label>
                                <input required  type="text" name="name" placeholder="Enter product name"
                                    class="form-control @error('name') is-invalid @enderror " value="{{ old('name') }}"
                                    id="name">
                                @error('name')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-sm-12 mb-3">
                                <label for="category" class="text-capitalize"> Product Category <span>*</span></label>
                                <select required name="category" id="category" required
                                    class="form-control @error('category') is-invalid @enderror ">

                                    <option value="">--Select Category--</option>
                                    @foreach ($categories as $category)
                                        <option {{ old('category') == $category->id ? 'selected' : '' }} value="{{$category->id}}">
                                            {{$category->p_cat_name}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-sm-12 mb-3">
                                <label for="price " class="text-capitalize"> price <span>*</span></label>
                                <input required  type="price" placeholder="Enter product price" name="price"
                                    class="form-control @error('price') is-invalid @enderror " value="{{ old('price') }}"
                                    id="price ">
                                @error('price')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-12 pl-0 mt-3">
                                <p class="text-right">
                                    <button type="reset" class="btn btn-space btn-secondary">Reset</button>
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
