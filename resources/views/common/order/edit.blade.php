@php
    $orders_active = true;
@endphp
@extends('layouts.app')
@section('css')
    <link href="{{ asset('assets/css/select2.css') }}" rel="stylesheet" />
@endsection
@section('main-content')
    <div class="row" id="order_detail">
        <div class=" col-12">
            <div class="card mb-5 shadow-sm">
                <h5 class="card-header">Order Details</h5>
                <div class="card-body">
                    <div class="row justify-content-betweeen mb-5">
                        <div class="col-md-3">
                            <label for="Product" class="text-capitalize">Product</label>
                        </div>
                        <div class="col-md-3">
                            <label for="price" class="text-capitalize">unit price </label>
                        </div>
                        <div class="col-md-3">
                            <label for="quantity" class="text-capitalize">Qty</label>
                        </div>
                        <div class="col-md-2">
                            <label for="amount" class="text-capitalize">Amount</label>
                        </div>
                        <div class="col-md-1">
                            <label for="amount" class="text-capitalize">Action</label>
                        </div>
                        @foreach ($order_details as $order_detail)
                            <div class="div col-12">
                                <form id="form{{ $order_detail->id }}">
                                    <div class="row justify-content-betweeen">
                                        <div class="col-md-3 mb-2">
                                            <input type="text" class="form-control" disabled
                                                value="{{ $order_detail->product_name }}">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <input type="text" onchange="setTotalAmount({{ $order_detail->id }})"
                                                id="{{ 'unit_price' . $order_detail->id }}" name="unit_price"
                                                class="form-control" value="{{ $order_detail->unit_price }}">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <input type="text" onchange="setTotalAmount({{ $order_detail->id }})"
                                                id="{{ 'quantity' . $order_detail->id }}" name="quantity"
                                                class="form-control" value="{{ $order_detail->quantity }}">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <input type="text" onchange="totalPayable()"
                                                id="{{ 'amount' . $order_detail->id }}" name="amount"
                                                class="form-control total-amount" value="{{ $order_detail->amount }}">
                                        </div>
                                        <div class="col-md-1">
                                            <a id="submit" href="javascript:void(0)"
                                                onclick="UpdateData({{ $order_detail->id }})" class="btn btn-primary"><i
                                                    class="fa fa-check"></i></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <div class="row justify-content-between my-5">
                        <div class="col-md-2 mb-2">
                            <label for="name" class="text-capitalize">payment method </label>
                            <input type="text" value="{{ $order->payment_method }}" class="form-control"
                                id="paymentMethod">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="name" class="text-capitalize">account number </label>
                            <input type="text" value="{{ $order->account_number }}" class="form-control"
                                id="accountNumber">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="name" class="text-capitalize">Total Amount </label>
                            <input type="text" value="{{ $order->order_amount }}" class="form-control"
                                id="payableAmount">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="name" class="text-capitalize">Due</label>
                            <input type="number" class="form-control"
                                value="{{ $order->order_amount - $order->paid_amount }}" disabled min="0"
                                id="dueAmount">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="name" class="text-capitalize">Paid Amount <span class="text-danger">*</span>
                            </label>
                            <input onchange="dueCalculation()" type="number" class="form-control" min="0"
                                id="paidAmount" value="{{ $order->paid_amount }}">
                        </div>
                        <div class="col-md-1" style="margin-top:30px">
                            <a id="submit" href="javascript:void(0)" onclick="UpdateOrder({{ $order->id }})"
                                class="btn btn-warning"><i class="fa fa-check"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        function ajaxSetup() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        function UpdateOrder(id) {
            let paid_amount = $('#paidAmount').val();
            let payment_method = $('#paymentMethod').val();
            let account_number = $('#accountNumber').val();
            let order_amount = $('#payableAmount').val();
            let url = "{{ route('order-update') }}" + '/' + id;
            ajaxSetup();
            $.ajax({
                type: "post",
                url: url,
                data: {
                    payment_method: payment_method,
                    account_number: account_number,
                    order_amount: order_amount,
                    paid_amount: paid_amount
                },
                success: function(results) {
                    console.log(results);
                    if (results.success) {
                        succcessTost(results.success);
                    }
                },
            });
        }

        function totalPayable() {
            var sum = 0;
            $(".total-amount").each(function() {
                sum += +$(this).val();
            });
            $("#payableAmount").val(sum);
            dueCalculation();
        }

        function dueCalculation() {
            let paidAmount = $('#paidAmount').val();
            let payableAmount = $('#payableAmount').val();
            let dueAmount = payableAmount - paidAmount;
            $('#dueAmount').val(dueAmount);
        }

        function UpdateData(order_id) {

            let unit_price = $('#unit_price' + order_id).val();
            let quantity = $('#quantity' + order_id).val();
            let amount = $('#amount' + order_id).val();
            let url = "{{ route('order.update') }}" + '/' + order_id;

            ajaxSetup();
            $.ajax({
                type: "post",
                url: url,
                data: {
                    unit_price: unit_price,
                    quantity: quantity,
                    amount: amount
                },
                success: function(results) {
                    if (results.success) {
                        succcessTost(results.success);
                    }
                },
            });
        }

        function setTotalAmount(id) {

            let unitprice = $('#unit_price' + id).val();
            let qty = $('#quantity' + id).val();
            let total = unitprice * qty;
            $('#amount' + id).val(total);
            totalPayable();
        }
    </script>
@endsection
