@if ($carts->count())
    <div class="row justify-content-betweeen">
        <div class="col-md-3">
            <label for="name" class="text-capitalize">Customer Name </label>
        </div>
        <div class="col-md-3">
            <label for="Product" class="text-capitalize">Product</label>
        </div>
        <div class="col-md-2">
            <label for="price" class="text-capitalize">unit price </label>
        </div>
        <div class="col-md-1">
            <label for="quantity" class="text-capitalize">Qty</label>
        </div>
        <div class="col-md-2">
            <label for="amount" class="text-capitalize">Amount</label>
        </div>
        <div class="col-md-1">
            <label for="amount" class="text-capitalize">Action</label>
        </div>
        @foreach ($carts as $cart)
            <div class="col-md-3 mb-2">
                <input type="text" class="form-control" disabled value="{{ $cart->customer_name }}">
            </div>
            <div class="col-md-3 mb-2">
                <input type="text" class="form-control" disabled value="{{ $cart->product_name }}">
            </div>
            <div class="col-md-2 mb-2">
                <input type="text" class="form-control" disabled value="{{ $cart->unit_price }}">
            </div>
            <div class="col-md-1 mb-2">
                <input type="text" class="form-control" disabled value="{{ $cart->quantity }}">
            </div>
            <div class="col-md-2 mb-2">
                <input type="text" class="form-control" disabled value="{{ $cart->amount }}">
            </div>
            <div class="col-md-1 mb-2">
                <a onclick="deleteCart('{{ Crypt::encrypt($cart->id) }}')" href="javascript:void(0)"
                    class="btn btn-danger"><i class="fa fa-minus"></i></a>
            </div>
        @endforeach

    </div>
    <div class="text-right my-3">
        <a style="margin-right: 13px" onclick="makeOrder()" href="javascript:void(0)"
            class="btn btn-primary text-right">Submit</a>
    </div>
@endif
