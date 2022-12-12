<?php

namespace App\Http\Controllers;

use App\Models\Expanse;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class chartController extends Controller
{
    public function topSell(Request $request)
    {
        $shortBy = $request->shortBy;
        $company_id = auth()->id();
        $orders = OrderDetail::join('products', 'products.id', 'order_details.product_id')
            ->join('orders', 'orders.id', 'order_details.order_id')
            ->select('products.name', DB::raw('count(order_details.product_id) as total'))
            ->where('orders.company_id', $company_id)
            ->groupBy('products.name')
            ->orderBy('total', 'desc');

        if ($shortBy == 2) {
            $orders = $orders->whereMonth('order_details.created_at', Carbon::now()->month)->take(5);
        } else if ($shortBy == 3) {
            $orders =  $orders->whereBetween('order_details.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->take(5);
        } else {
            $orders = $orders->whereYear('order_details.created_at',  Carbon::now()->year)->take(5);
        }

        $product_name =  $orders->pluck('products.name')->toArray();
        $total_sell =  $orders->pluck('total')->toArray();
        return response()->json([
            'product_name' => $product_name,
            'total_sell' => $total_sell
        ]);
    }
    public function expanseChart(Request $request)
    {
        $shortBy = $request->shortBy;
        $company_id = auth()->id();
        $orders = Expanse::join('expanse_categories', 'expanse_categories.id', 'expanses.cat_id')
            ->select('expanse_categories.e_cat_name as category', DB::raw('sum(expanses.amount) as amount'))
            ->where('expanses.company_id', $company_id)
            ->groupBy('expanse_categories.e_cat_name');

        if ($shortBy == 2) {
            $orders = $orders->whereMonth('expanses.created_at', Carbon::now()->month)->take(5);
        } else if ($shortBy == 3) {
            $orders = $orders->whereBetween('expanses.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->take(5);
        } else {
            $orders = $orders->whereYear('expanses.created_at',  Carbon::now()->year)->take(5);
        }
        // return $orders->get();
        $category =  $orders->pluck('category')->toArray();
        $amount =  $orders->pluck('amount')->toArray();
        return response()->json([
            'categories' => $category,
            'amounts' => $amount
        ]);
    }
    public function progressChart(Request $request)
    {
        // return Carbon::now()->year;
        $shortBy = $request->shortBy;
        $company_id = auth()->id();
        $order =   Order::where('company_id', $company_id);
        $expanse =   Expanse::where('company_id', $company_id);
        if ($shortBy == 2) {
            $total_order = $order->whereMonth('created_at', Carbon::now()->month)->sum('order_amount');
            $total_payment = $order->whereMonth('created_at', Carbon::now()->month)->sum('paid_amount');
            $total_expanse = $expanse->whereMonth('created_at', Carbon::now()->month)->sum('amount');
        } else if ($shortBy == 3) {

            $total_order =  $order->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('order_amount');
            $total_payment =  $order->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('paid_amount');
            $total_expanse =  $expanse->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
        } else {
            $total_order = $order->whereYear('created_at',  Carbon::now()->year)->sum('order_amount');
            $total_payment = $order->whereYear('created_at',  Carbon::now()->year)->sum('paid_amount');
            $total_expanse = $expanse->whereYear('created_at', Carbon::now()->year)->sum('amount');
        }
        $net_profit = $total_payment - $total_expanse;
        return response()->json([
            'categories' => ['Order', 'Expanse', 'Net Profit'],
            'values' => [$total_order, $total_expanse, $net_profit]
        ]);
    }
    public function topSalesExecutiveChart(Request $request)
    {
        $shortBy = $request->shortBy;
        $company_id = auth()->id();
        $orders =   Order::join('users', 'users.id', 'orders.created_by')
            ->select('users.name as user_name', DB::raw('sum(orders.order_amount) as total_order'))
            ->where('orders.company_id', $company_id)
            ->groupBy('users.name')
            ->where('users.role_id', 4);

        if ($shortBy == 2) {
            $orders = $orders->whereMonth('orders.created_at', Carbon::now()->month)->take(5);
        } else if ($shortBy == 3) {
            $orders =  $orders->whereBetween('orders.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->take(5);
        } else {
            $orders = $orders->whereYear('orders.created_at',  Carbon::now()->year)->take(5);
        }
        $user_name =  $orders->pluck('user_name')->toArray();
        $total_order =  $orders->pluck('total_order')->toArray();
        return response()->json([
            'user_name' => $user_name,
            'total_order' => $total_order
        ]);
    }
    public function salesManPerfomance(Request $request)
    {
        $shortBy = $request->shortBy;
        $company_id = auth()->user()->company_id;

        $orders =   Order::join('users', 'users.id', 'orders.created_by')
            ->select('users.name as user_name', DB::raw('sum(orders.order_amount) as total_order'))
            ->where('orders.company_id', $company_id)
            ->where('users.manager_id', auth()->id())
            ->groupBy('users.name')
            ->where('users.role_id', 4);

        if ($shortBy == 2) {
            $orders = $orders->whereMonth('orders.created_at', Carbon::now()->month)->take(5);
        } else if ($shortBy == 3) {
            $orders = $orders->whereBetween('orders.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->take(5);
        } else {
            $orders = $orders->whereYear('orders.created_at',  Carbon::now()->year)->take(5);
        }
        $user_name =  $orders->pluck('user_name')->toArray();
        $total_order =  $orders->pluck('total_order')->toArray();
        return response()->json([
            'user_name' => $user_name,
            'total_order' => $total_order
        ]);
    }

    public function selfPerfomanceSaLesMan()
    {
        $orders =  Order::select(
            DB::raw('sum(order_amount) as sum'),
            DB::raw("DATE_FORMAT(created_at,'%b') as month")
        )
            ->where('created_by', auth()->id())
            ->groupBy('month')
            ->orderBy('created_at', 'ASC')
            ->take(12);

        $month =  $orders->pluck('month')->toArray();
        $sum =  $orders->pluck('sum')->toArray();
        return response()->json([
            'month' => $month,
            'sum' => $sum
        ]);
    }
    public function amountChart(Request $request)
    {
        $shortBy = $request->shortBy;
        $id = auth()->id();
        if (auth()->user()->role_id == 2) {
            $column = 'company_id';
        } else {
            $column = 'created_by';
        }
        $amount =  Order::select(
            DB::raw('sum(order_amount) as orderAmount'),
            DB::raw('sum(paid_amount) as paid_amount'),
        )->where($column, $id);

        if ($shortBy == 2) {
            $amount = $amount->whereMonth('created_at', Carbon::now()->month)->first();
        } else if ($shortBy == 3) {
            $amount = $amount->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->first();
        } else {
            $amount = $amount->whereYear('created_at',  Carbon::now()->year)->first();
        }
        $order = $amount->orderAmount ? $amount->orderAmount : 0;
        $paid = $amount->paid_amount ? $amount->paid_amount : 0;
        $due = $order - $paid;

        return response()->json([
            'amounts' => [$order, $paid, $due],
            'categories' => ['Total Order', 'Paid', 'Due']
        ]);
    }
}
