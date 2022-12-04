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
use Illuminate\Support\Facades\Crypt;

class OrderController extends Controller
{
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
    public function update(OrderDetail $order, Request $request)
    {
        $diffrence = $request->amount - $order->amount;
        $order->unit_price = $request->unit_price;
        $order->quantity = $request->quantity;
        $order->amount = $request->amount;
        $order->save();

        $orders = Order::find($order->order_id);
        $orders->order_amount += $diffrence;
        $orders->updated_by = auth()->id();
        $orders->save();
        return response()->json([
            'success' =>  'Update successfully'
        ]);
    }
    public function updateOrder(Order $order, Request $request)
    {
        $order->payment_method = $request->payment_method;
        $order->account_number = $request->account_number;
        $order->order_amount = $request->order_amount;
        $order->paid_amount = $request->paid_amount;
        $order->save();
        return response()->json([
            'success' =>  'Update successfully'
        ]);
    }

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
    public function edit($order_id)
    {
        $order_id = Crypt::decrypt($order_id);
        $order_details = OrderDetail::join('products', 'products.id', 'order_details.product_id')
            ->where('order_id', $order_id)
            ->select('products.name as product_name', 'order_details.id', 'order_details.quantity', 'order_details.unit_price', 'order_details.amount')
            ->get();
        $order = Order::where('id', $order_id)->first(['id', 'payment_method', 'account_number', 'order_amount', 'paid_amount']);
        return view('common.order.edit', compact('order_details', 'order'));
    }


    function invoice($order_id)
    {
        $order_id = Crypt::decrypt($order_id);
        $info = Order::join('customers', 'customers.id', 'orders.customer_id')
            ->join('users', 'users.id', 'orders.created_by')
            ->join('roles', 'roles.id', 'users.role_id')
            ->select('orders.id', 'orders.order_amount', 'orders.paid_amount', 'orders.created_at', 'orders.updated_at', 'customers.name as customer_name', 'customers.company_name', 'customers.phone_number', 'customers.created_by', 'customers.address', 'users.name as created_by', 'roles.role_name as designnation')
            ->first();
        $order_details  = OrderDetail::join('products', 'products.id', 'order_details.product_id')
            ->where('order_id', $order_id)
            ->select('products.name as product_name', 'order_details.quantity', 'order_details.unit_price', 'order_details.amount')
            ->get();
        return  Pdf::loadView('invoice.pdf', compact('info', 'order_details'));
    }
    function printInvoice($order_id)
    {
        $pdf = $this->invoice($order_id);
        $name = date('Y_m_d_h-i-s_A') . '.pdf';
        return $pdf->setPaper('a4')->stream($name);
    }
    function downloadInvoice($order_id)
    {
        $pdf = $this->invoice($order_id);
        $name = date('Y_m_d_h-i-s_A') . '.pdf';
        return $pdf->setPaper('a4')->download($name);
    }
}
