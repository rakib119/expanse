<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth =  auth()->user();
        $column =  'orders.created_by';
        if ($auth->role_id  == 2) {
            $column =  'orders.company_id';
        }
        $orders = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('users', 'users.id', '=', 'orders.created_by')
            ->where($column, auth()->id())
            ->orderBy('orders.id', 'desc')
            ->select('users.name as created_by', 'customers.name as customer_name', 'orders.order_amount', 'orders.id', 'orders.created_at')
            ->get();
        return view('common.order.index', compact('orders'));
    }


    public function create()
    {
        $user = auth()->user();
        $user_id = $user->id;
        $role_id =  $user->role_id;
        $company_id = $user->company_id;
        if ($role_id == 2) {
            $condition = ['company_id' => $user_id];
            $company_id = $user_id;
        } elseif ($role_id == 3) {
            $condition = ['manager_id' => $user_id];
        } elseif ($role_id == 4) {
            $condition = ['sels_executive_id' => $user_id];
        }
        $products = Product::where('company_id', $company_id)->get(['id', 'name', 'price']);
        $customers = Customer::where($condition)->get(['id', 'name']);
        return view('common.order.create', compact('customers', 'products'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json();
        $user = auth()->user();
        $user_id = $user->id;
        $role_id =  $user->role_id;
        $company_id = $user->company_id;
        $manager_id = $user->manager_id;
        $sels_executive_id = $user->sels_executive_id;
        $paid_amount =  $request->paid_amount;
        if ($role_id == 2) {
            $company_id = $user_id;
        } elseif ($role_id == 3) {
            $manager_id = $user_id;
        } elseif ($role_id == 4) {
            $sels_executive_id = $user_id;
        }

        $customer_id = $request->customer_id;
        $payment_method = $request->payment_method;
        $account_number = $request->account_number;
        $carts = Cart::where('customer_id', $customer_id)->get();
        $order_amount = 0;
        $order_id = Order::insertGetId([
            'order_amount' => $order_amount,
            'paid_amount' => $paid_amount,
            'payment_method' => $payment_method,
            'account_number' => $account_number,
            'company_id' => $company_id,
            'manager_id' => $manager_id,
            'sels_executive_id' => $sels_executive_id,
            'customer_id' => $customer_id,
            'created_by' => $user->id,
            'created_at' => Carbon::now()
        ]);
        foreach ($carts as  $cart) {
            $order_amount += $cart->amount;
            OrderDetail::insert([
                'order_id' => $order_id,
                'product_id' => $cart->product_id,
                'unit_price' => $cart->unit_price,
                'quantity' => $cart->quantity,
                'amount' => $cart->amount,
                'created_at' => $cart->created_at,
            ]);
            $cart->delete();
        }
        $order = Order::find($order_id);
        $order->order_amount =  $order_amount;
        $order->timestamps = false;
        $order->save();
        return response()->json([
            'success' => 'successfull'
        ]);
    }
    function downloadInvoice($order_id)
    {
        $pdf = Pdf::loadView('invoice.pdf');
        $name = date('Y_m_d_h-i-s_A') . '.pdf';
        return $pdf->setPaper('a4')->stream($name);
        //  $pdf->download($name);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
