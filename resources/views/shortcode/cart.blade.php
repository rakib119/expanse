@if ($carts->count())
    <div class=" col-12">
        <div class="card mb-5 shadow-sm">
            <h5 class="card-header">Order Details</h5>
            <div class="card-body">
                <div class="row justify-content-betweeen mb-5">
                    {{-- <div class="col-md-3">
                    <label for="name" class="text-capitalize">Customer Name </label>
                </div> --}}
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
                    @php
                        $total_amount = 0;
                    @endphp
                    @foreach ($carts as $cart)
                        @php
                            $amount = $cart->amount;
                            $total_amount += $amount;
                            $total_product = $loop->iteration;
                            $customer_name = $cart->customer_name;
                        @endphp
                        {{-- <div class="col-md-3 mb-2">
                        <input type="text" class="form-control" disabled value="{{ $cart->customer_name }}">
                    </div> --}}
                        <div class="col-md-3 mb-2">
                            <input type="text" class="form-control" disabled value="{{ $cart->product_name }}">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input type="text" class="form-control" disabled value="{{ $cart->unit_price }}">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input type="text" class="form-control" disabled value="{{ $cart->quantity }}">
                        </div>
                        <div class="col-md-2 mb-2">
                            <input type="text" class="form-control" disabled value="{{ $amount }}">
                        </div>
                        <div class="col-md-1 mb-2">
                            <a onclick="deleteCart('{{ Crypt::encrypt($cart->id) }}')" href="javascript:void(0)"
                                class="btn btn-danger"><i class="fa fa-minus"></i></a>
                        </div>
                    @endforeach
                </div>
                <hr style="height:1px;border-width:0;background-color:#80808057">
                <div class="row justify-content-between my-5">
                    <div class="col-md-3 mb-2">
                        <label for="name" class="text-capitalize">payment method </label>
                        <input type="text" class="form-control" id="paymentMethod" >
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="name" class="text-capitalize">account number </label>
                        <input type="text" class="form-control" id="accountNumber" >
                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="name" class="text-capitalize">Total Amount </label>
                        <input type="text" class="form-control" id="payableAmount" disabled
                            value="{{ $total_amount }}">
                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="name" class="text-capitalize">Due</label>
                        <input type="number" class="form-control" disabled min="0" id="dueAmount">
                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="name" class="text-capitalize">Paid Amount <span class="text-danger">*</span>
                        </label>
                        <input onchange="dueCalculation()" type="number" class="form-control" min="0"
                            id="paidAmount" value="{{ $paid_amount ? $paid_amount : 0 }}">
                    </div>
                </div>
                <div class="text-right my-3">
                    <a style="margin-right: 13px" onclick="makeOrder()" href="javascript:void(0)"
                        class="btn btn-primary text-right">Confirm Order</a>
                </div>
            </div>
        </div>
    </div>
@endif
