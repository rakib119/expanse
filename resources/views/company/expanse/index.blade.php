@php
    $role_id = auth()->user()->role_id;
    $expanses_active = true;
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
                            <h5> Expanse List</h5>
                        </div>
                        <div>
                            <a href="{{ route('expanse.create') }}" class="btn btn-secondary"> <i class="fa fa-plus"></i> Add
                                Expanse</a>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table" id='myTable'>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expanses as $expanse)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $expanse->category }}</td>
                                        <td>{{ $expanse->remarks }}</td>
                                        <td>{{ $expanse->amount }}</td>
                                        <td> <a href="">{{ $expanse->created_by }}</a> </td>

                                        <td>
                                            <div class="dropdown show">
                                                <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Action
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="{{route('expanse.edit',Crypt::encrypt($expanse->id))}}">Edit</a>
                                                    {{-- <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a> --}}
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
