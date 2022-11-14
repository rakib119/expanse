<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class DashboardController extends Controller
{

    public function index()
    {
        $role_id  = auth()->user()->role_id;
        if ($role_id == 1) {
            return  $this->adminDashboard();
        } elseif ($role_id == 2) {
            return  $this->companyDashboard();
        } elseif ($role_id == 3) {
            return $this->managerDashboard();
        } elseif ($role_id == 4) {
            return  $this->salesExecutiveDashboard();
        }

        abort('404');
    }

    private function adminDashboard()
    {
        $figers = new stdClass;
        $figers->total_user = User::count();
        $figers->total_company = User::where('role_id', 2)->count();
        $figers->total_manager = User::where('role_id', 3)->count();
        $figers->total_sales_executive = User::where('role_id', 4)->count();
        return view('admin.dashboard', compact('figers'));
    }

    private function companyDashboard()
    {
        $auth_id = auth()->id();
        $figers = new stdClass;
        $figers->total_employee = User::where(['company_id' => $auth_id])->count();
        $figers->total_product = Product::where(['company_id' => $auth_id])->count();
        $figers->total_order = Order::where(['company_id' => $auth_id]) ->whereMonth('created_at', Carbon::now()->month)->count();
        $figers->total_customer = Customer::where(['company_id' => $auth_id])->count();

        $orders = OrderDetail::join('products', 'products.id', 'order_details.product_id')->select('products.name', DB::raw('count(order_details.product_id) as total'))->groupBy('products.name');
        $product_name =  $orders->pluck('products.name')->toArray();
        $total_sell =  $orders->pluck('total')->toArray();

        return view('company.dashboard', compact('product_name', 'total_sell', 'figers'));
    }

    private function managerDashboard()
    {
        return view('manager.dashboard');
    }

    private function salesExecutiveDashboard()
    {
        return view('sales_executive.dashboard', compact('a', 'b'));
    }
}
