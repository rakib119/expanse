<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    function index(Request $request)
    {
        $paid_amount = $request->paidAmount;
        $carts =  Cart::join('customers', 'customers.id', 'carts.customer_id')
            ->join('products', 'products.id', 'carts.product_id')
            ->where(['carts.created_by' => auth()->id(), 'carts.customer_id' => $request->customer_id])
            ->select('carts.id', 'carts.quantity', 'carts.unit_price', 'carts.amount', 'products.name as product_name', 'customers.name as customer_name')
            ->orderBy('carts.id', 'desc')
            ->get();

        $cart_html = (string) view('shortcode.cart', compact('carts', 'paid_amount'));
        return response()->json(['cartHtml' => $cart_html]);
    }
    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product' =>   'required|numeric',
            'customer' => 'required|numeric',
            'qty' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'amount' => 'required|numeric',
        ], [
            'product.numeric' => 'Enter valid data',
            'customer.numeric' => 'Enter valid data',
            'qty.numeric' => 'Enter valid data',
            'unit_price.numeric' => 'Enter valid data',
            'amount.numeric' => 'Enter valid data',
        ]);
        if ($validator->fails()) {
            $error_messages = $validator->errors()->messages();
            // $errors=[];
            // foreach ($error_messages as $key => $error) {
            //     $errors[$key] = $error;
            // }
            return response()->json($error_messages);
        }

        $auth_id  = auth()->id();
        Cart::insert([
            'product_id' => $request->product,
            'customer_id' => $request->customer,
            'quantity' => $request->qty,
            'unit_price' => $request->unit_price,
            'amount' => $request->amount,
            'created_by' => $auth_id,
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => 'successfull'
        ]);
    }

    public function destroy(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        Cart::find($id)->delete();
        return response()->json([
            'success' => 'Deleted successfully'
        ]);
    }
}
