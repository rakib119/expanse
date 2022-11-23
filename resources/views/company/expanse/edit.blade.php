@php
    $expanses_active = true;
@endphp
@extends('layouts.app')

@section('main-content')
    <div class="row">
        <div class=" col-12">
            <div class="card mb-5 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5> Update Expanse</h5>
                    </div>
                    <div>
                        <a href="{{ route('expanse.index') }}" class="btn btn-secondary"> Expanse List <i
                                class="fa fa-arrow-right"></i></a>
                    </div>

                </div>
                <div class="card-body">
                    <form action="{{ route('expanse.update', $expanse->id) }}" method='post'>
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="category" class="text-capitalize"> Category <span>*</span></label>
                                <select name="category" id="category" required
                                    class="form-control @error('name') is-invalid @enderror ">
                                    <option value="">--Select Category--</option>
                                    @foreach ($categories as $category)
                                        <option {{ $expanse->cat_id == $category->id ? 'selected' :'' }}
                                            value="{{ $category->id }}">{{ $category->e_cat_name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="amount" class="text-capitalize"> amount <span>*</span></label>
                                <input required type="number" name="amount" min="1"
                                    class="form-control @error('amount') is-invalid @enderror "
                                    value="{{ $expanse->amount }}" id="amount" placeholder="Enter expanse amount">
                                @error('amount')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-sm-12 mb-3">
                                <label for="remarks" class="text-capitalize"> remarks <span> </span></label>
                                <textarea name="remarks" id="remarks" class="form-control @error('remarks') is-invalid @enderror " cols="30"
                                    rows="4" placeholder='Please give a explanation'>{{ $expanse->remarks }}</textarea>
                                @error('remarks')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-12 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Update</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
