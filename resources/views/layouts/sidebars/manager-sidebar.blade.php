<li class="nav-item">
    <a class="nav-link {{ isset($dashboard_active) ? 'active' : '' }}" href="/"><i
            class="fa fa-fw fa-user-circle"></i>Dashboard</a>
</li>
<li class="nav-item ">
    <a class="nav-link {{ isset($users_active) ? 'active' : '' }} text-capitalize " href="#" data-toggle="collapse"
        aria-expanded="false" data-target="#employee_sub_menu" aria-controls="employee_sub_menu"><i
            class="fa fa-fw fa-user-circle"></i>Sales Executive</a>
    <div id="employee_sub_menu" class="collapse submenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('user.create') }}">Create</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('user.index') }}">List</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link {{ isset($orders_active) ? 'active' : '' }} text-capitalize " href="#" data-toggle="collapse"
        aria-expanded="false" data-target="#orders_sub_menu" aria-controls="orders_sub_menu"><i
            class="fa fa-fw fa-user-circle"></i>Orders</a>
    <div id="orders_sub_menu" class="collapse submenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('order.create') }}">Create</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('order.index') }}">List</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link {{ isset($customers) ? 'active' : '' }}" href="{{ route('customer.index') }}"><i
            class="fa fa-fw fa-user-circle"></i>Customers</a>
</li>
