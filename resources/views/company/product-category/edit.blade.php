@php
    $product_active = true;
@endphp
@extends('layouts.app')
@section('main-content')
    <div class="row">
        <div class=" col-12">
            <div class="card mb-5 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Update Product Category</h5>
                    </div>
                    <div>
                        <a href="{{ route('category-product.index') }}" class="btn btn-secondary"> Product Category List <i
                                class="fa fa-arrow-right"></i></a>
                    </div>

                </div>
                <div class="card-body">
                    <form action="{{ route('category-product.update',$ProductCategory->id) }}" method='post'>
                        @csrf
                        @method('put')
                        <div class="row align-items-end">

                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="category" class="text-capitalize"> category <span>*</span></label>
                                <input required type="text" name="category"
                                    class="form-control @error('category') is-invalid @enderror " value="{{ $ProductCategory->p_cat_name }}"
                                    id="category" placeholder="Enter product category">
                                @error('category')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-sm-12 mb-3">
                                <p class="text-left">
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
