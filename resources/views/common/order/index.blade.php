@php
    $role_id = auth()->user()->role_id;
    $orders_active = true;
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
                            <h5> Order List</h5>
                        </div>
                        <div>
                            <a href="{{ route('order.create') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Create
                                Order</a>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table" id='myTable'>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer Name</th>
                                    @if (auth()->user()->role_id == 2)
                                        <th scope="col">Created By</th>
                                    @endif
                                    <th scope="col">Order Amount</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $order->customer_name }}</td>
                                        @if (auth()->user()->role_id == 2)
                                            <td> <a href="">{{ $order->created_by }}</a> </td>
                                        @endif
                                        <td>{{ $order->order_amount }}</td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>

                                        <td>
                                            <div class="dropdown show">
                                                <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Action
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="{{route('order.edit',Crypt::encrypt($order->id) )}}">Edit Details</a>
                                                    <a class="dropdown-item" href="{{route('order.download',Crypt::encrypt($order->id) )}}">Download Invoice</a>
                                                    <a class="dropdown-item" href="{{route('order.print',Crypt::encrypt($order->id) )}}">Print Invoice</a>
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
