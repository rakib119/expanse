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
                <h5 class="card-header">Create New Order</h5>
                <div class="card-body">
                    <div id="cart">
                    </div>
                    <div class="my-4">
                        <div class="row justify-content-betweeen">
                            <div class="col-md-3">
                                <label for="name" class="text-capitalize">Customer Name <span>*</span></label>
                                <select id="name" required class="form-control select2">
                                    <option value="">--Select Customer--</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
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
@endsection
@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2();
            setUnitPrice();
            setTotalAmount();
        });


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
            let customer_id = $('#name').val();
            let product_id = $('#product_name').val();
            let qty = $('#quantity').val();
            let unit_price = $('#unit_price').val();
            let amount = $('#amount').val();
            $.ajax({
                type: "post",
                url: '{{ route('cart.store') }}',
                data: {
                    customer_id: customer_id,
                    product_id: product_id,
                    qty: qty,
                    unit_price: unit_price,
                    amount: amount,
                },
                success: function(results) {
                    getCart();
                    // $('#cart').html(results);
                },
            });
        })

        function getCart() {
            let customer_id = $('#name').val(); 
            $.ajax({
                type: "get",
                url: '{{ route('cart.index') }}',
                data: {
                    customer_id: customer_id
                },
                success: function(results) {
                    $('#cart').html(results.cartHtml);
                },
            });
        }
    </script>
@endsection
