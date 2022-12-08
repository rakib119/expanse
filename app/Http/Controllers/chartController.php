<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class chartController extends Controller
{
    // public function getchart()
    // {
    //     $role_id  = auth()->user()->role_id;
    //     if ($role_id == 2) {
    //         return  $this->companyChart();
    //     } elseif ($role_id == 3) {
    //         return $this->managerChart();
    //     } elseif ($role_id == 4) {
    //         return  $this->salesExecutiveChart();
    //     }

    //     abort('404');
    // }
    public function topSell(Request $request)
    {
        $shortBy = $request->shortBy;
        $company_id = auth()->user()->id;
        $orders = OrderDetail::join('products', 'products.id', 'order_details.product_id')
            ->select('products.name', DB::raw('count(order_details.product_id) as total'))
            ->where('company_id', $company_id)
            ->groupBy('products.name')
            ->orderBy('total', 'desc');

        if ($shortBy == 2) {
            $orders = $orders->whereMonth('order_details.created_at', Carbon::now()->month)->take(5);
        } else if ($shortBy == 3) {
            $orders->whereBetween('order_details.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->take(5);
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
}
