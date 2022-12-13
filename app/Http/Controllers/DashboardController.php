<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expanse;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
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
        $order = Order::where('company_id', $auth_id);
        $figers = new stdClass;
        $figers->total_sales = $order->sum('order_amount');
        $figers->total_payment = $order->sum('paid_amount');
        $figers->total_due = $figers->total_sales - $figers->total_payment;
        $figers->total_expanse = Expanse::where(['company_id' => $auth_id])->sum('amount');
        $figers->total_profit = $figers->total_payment - $figers->total_expanse;
        $figers->net_profit = number_format(($figers->total_profit / $figers->total_payment) * 100, 2);
        return view('company.dashboard', compact('figers'));
    }

    public static function managerDashboard($id = null)
    {
        if ($id) {
            $auth_id = $id;
            $name = User::where('id', $auth_id)->first('name')->name;
        } else {
            $auth_id = auth()->id();
            $name = "";
        }

        $figers = new stdClass;
        $figers->total_order = Order::where(['created_by' => $auth_id])->count();
        $figers->user_id = $auth_id;
        $figers->name = $name;
        $figers->new_order = Order::where(['created_by' => $auth_id])->whereMonth('created_at', Carbon::now()->month)->count();
        $figers->total_customer = Customer::where(['created_by' => $auth_id])->count();
        $figers->new_customer = Customer::where(['created_by' => $auth_id])->whereMonth('created_at', Carbon::now()->month)->count();
        return view('manager.dashboard', compact('figers'));
    }

    public static function salesExecutiveDashboard($id = null)
    {
        if ($id) {
            $auth_id = $id;
            $user = User::where('id', $auth_id)->first(['name',''])->name;
            $name = $user->name;
            $commission = $user->commission;
        } else { 
            $user = auth()->user();
            $auth_id =  $user->id;
            $commission = $user->commission;
            $name = "";
        }
        $order = Order::where(['created_by' => $auth_id]);
        $figers = new stdClass;
        $figers->user_id = $auth_id;
        $figers->name = $name;
        $figers->total_order = $order->sum('order_amount');
        $figers->total_paid = $order->sum('paid_amount');
        $figers->new_order = $order->whereMonth('created_at', Carbon::now()->month)->sum('order_amount');
        $figers->new_paid_amount = $order->whereMonth('created_at', Carbon::now()->month)->sum('paid_amount');
        $figers->total_commission = $figers->total_paid * ($commission/100);
        $figers->new_commission = $figers->new_paid_amount * ($commission/100);
        // $figers->total_customer = Customer::where(['created_by' => $auth_id])->count();
        // $figers->new_customer = Customer::where(['created_by' => $auth_id])->whereMonth('created_at', Carbon::now()->month)->count();
        return view('sales_executive.dashboard', compact('figers'));
    }
}
