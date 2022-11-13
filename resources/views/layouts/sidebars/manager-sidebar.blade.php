<li class="nav-item">
    <a class="nav-link active" href="/"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>
</li>
<li class="nav-item ">
    <a class="nav-link text-capitalize " href="#" data-toggle="collapse" aria-expanded="false" data-target="#employee_sub_menu"
        aria-controls="employee_sub_menu"><i class="fa fa-fw fa-user-circle"></i>Sales Executive</a>
    <div id="employee_sub_menu" class="collapse submenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.create') }}">Create</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.index') }}">List</a>
            </li>
        </ul>
    </div>
</li> 
<li class="nav-item ">
    <a class="nav-link text-capitalize " href="#" data-toggle="collapse" aria-expanded="false" data-target="#orders_sub_menu"
        aria-controls="orders_sub_menu"><i class="fa fa-fw fa-user-circle"></i>Orders</a>
    <div id="orders_sub_menu" class="collapse submenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="">Create</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">List</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link" href=""><i class="fa fa-fw fa-user-circle"></i>Customers</a>
</li>

