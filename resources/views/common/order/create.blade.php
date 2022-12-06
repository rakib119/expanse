@php
    $orders_active = true;
@endphp
@extends('layouts.app')
@section('css')
    <link href="{{ asset('assets/css/select2.css') }}" rel="stylesheet" />
@endsection
@section('main-content')
    <div class="row">
        <div class=" col-12">
            <div class="card mb-5 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Create New Order</h5>
                    </div>
                    <div>
                        <a class="btn btn-primary" href="{{route('customer.create')}}" >Add Customer</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="my-4">
                        <div class="row justify-content-betweeen">
                            <div class="col-md-3">
                                <label for="name" class="text-capitalize">Customer Name <span>* </span></label>
                                <select id="name" required class="form-control select2">
                                    <option value="">--Select Customer--</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name .'('. $customer->company_name .' '. $customer->phone_number .' )' }}</option>
                                    @endforeach
                                </select>

                                <span class="text-danger" id="nameError"> </span>
                            </div>
                            <div class="col-md-3">
                                <label for="Product" class="text-capitalize">Product <span>*</span></label>
                                <select id="product_name" name="Product" class="form-control select2">
                                    <option value="">--Product Customer--</option>
                                    @foreach ($products as $product)
                                        <option data-price="{{ $product->price }}" value="{{ $product->id }}">
                                            {{ $product->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="productError"> </span>
                            </div>
                            <div class="col-md-2">
                                <label for="price" class="text-capitalize">unit price <span>*</span></label>
                                <input type="text" name="price" id="unit_price" class="form-control">
                                <span class="text-danger" id="priceError"> </span>
                            </div>
                            <div class="col-md-1">
                                <label for="quantity" class="text-capitalize">Qty <span>*</span></label>
                                <input type="text" value="1" name="quantity" id="quantity" class="form-control">
                                <span class="text-danger" id="quantityError"> </span>
                            </div>

                            <div class="col-md-2">
                                <label for="amount" class="text-capitalize">Amount <span>*</span></label>
                                <input type="text" name="amount" id="amount" class="form-control">
                                <span class="text-danger" id="amountError"> </span>
                            </div>
                            <div class="col-md-1" style="margin-top: 30px;">
                                <button id="addToCart" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="cart">
    </div>
@endsection
@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2();
            setUnitPrice();
            setTotalAmount();
            getCart();
        });

        function deleteCart(id) {
            ajaxSetup();
            $.ajax({
                type: "post",
                url: '{{ route('cart.destroy') }}',
                data: {
                    id: id
                },
                success: function(results) {
                    getCart();
                },
            });

        }

        function ajaxSetup() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
        $('#product_name').change(() => {
            setUnitPrice();
            setTotalAmount();
        })
        $('#quantity').change(() => {
            setTotalAmount();
        })
        $('#unit_price').change(() => {
            setTotalAmount();
        })
        $('#name').change(() => {
            getCart();
        })

        function setTotalAmount() {
            let unitprice = $('#unit_price').val();
            let qty = $('#quantity').val();
            let total = unitprice * qty;
            $('#amount').val(total);
        }

        function setUnitPrice() {
            let price = $('#product_name').find(':selected').attr('data-price');
            $('#unit_price').val(price);
        }
        $('#addToCart').click(() => {
            // alert('hello');
            ajaxSetup();
            let customer = $('#name').val();
            let product = $('#product_name').val();
            let qty = $('#quantity').val();
            let unit_price = $('#unit_price').val();
            let amount = $('#amount').val();
            $.ajax({
                type: "post",
                url: '{{ route('cart.store') }}',
                data: {
                    customer: customer,
                    product: product,
                    qty: qty,
                    unit_price: unit_price,
                    amount: amount,
                },
                success: function(results) {
                    let nameError = $('#nameError');
                    let productError = $('#productError');
                    let quantityError = $('#quantityError');
                    let priceError = $('#priceError');
                    let amountError = $('#amountError');
                    if (results.success) {
                        nameError.html('');
                        productError.html('');
                        quantityError.html('');
                        priceError.html('');
                        amountError.html('');
                        getCart();
                        succcessTost(results.success);
                    }
                    if (results.customer) {
                        nameError.html(results.customer[0]);
                    }
                    if (results.product) {
                        productError.html(results.product[0]);
                    }
                    if (results.qty) {
                        quantityError.html(results.qty[0]);
                    }
                    if (results.unit_price) {
                        priceError.html(results.unit_price[0]);
                    }
                    if (results.amount) {
                        amountError.html(results.amount[0]);
                    }
                },
            });
        })

        function getCart() {
            let paidAmount = $('#paidAmount').val();
            let customer_id = $('#name').val();
            $.ajax({
                type: "get",
                url: '{{ route('cart.index') }}',
                data: {
                    customer_id: customer_id,
                    paidAmount: paidAmount
                },
                success: function(results) {
                    $('#cart').html(results.cartHtml);
                    dueCalculation();
                }
            });
        }

        function dueCalculation() {
            let paidAmount = $('#paidAmount').val();
            let payableAmount = $('#payableAmount').val();
            let dueAmount = payableAmount - paidAmount;
            $('#dueAmount').val(dueAmount);
        }

        function makeOrder() {
            let customer_id = $('#name').val();
            let paid_amount = $('#paidAmount').val();
            let payment_method = $('#paymentMethod').val();
            let account_number = $('#accountNumber').val();
            ajaxSetup();
            $.ajax({
                type: "post",
                url: '{{ route('order.store') }}',
                data: {
                    customer_id: customer_id,
                    paid_amount: paid_amount,
                    payment_method: payment_method,
                    account_number: account_number,
                },
                success: function(results) {
                    if (results.success) {
                        succcessTost(results.success);
                    }
                    getCart();
                },
            });
        }
    </script>
@endsection
