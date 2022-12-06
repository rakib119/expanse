<li class="nav-item">
    <a class="nav-link {{ isset($dashboard_active) ? 'active' : '' }}" href="/"><i
            class="fa fa-fw fa-user-circle"></i>Dashboard</a>
</li>
<li class="nav-item ">
    <a class="nav-link {{ isset($users_active) ? 'active' : '' }} text-capitalize " href="#" data-toggle="collapse"
        aria-expanded="false" data-target="#employee_sub_menu" aria-controls="employee_sub_menu"><i
            class="fa fa-fw fa-user-circle"></i>Employee</a>
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
    <a class="nav-link  {{ isset($expanses_active) ? 'active' : '' }} text-capitalize " href="#"
        data-toggle="collapse" aria-expanded="false" data-target="#exppanses_sub_menu"
        aria-controls="exppanses_sub_menu"><i class="fa fa-fw fa-user-circle"></i>expanses</a>
    <div id="exppanses_sub_menu" class="collapse submenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('category-expanse.index') }}">Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('expanse.index') }}">Expanse</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link {{ isset($product_active) ? 'active' : '' }} text-capitalize " href="#"
        data-toggle="collapse" aria-expanded="false" data-target="#Product_sub_menu" aria-controls="Product_sub_menu"><i
            class="fa fa-fw fa-user-circle"></i>Product</a>
    <div id="Product_sub_menu" class="collapse submenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('category-product.index') }}">Category List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('product.create') }}">Create</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('product.index') }}">List</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link {{ isset($orders_active) ? 'active' : '' }} text-capitalize " href="#"
        data-toggle="collapse" aria-expanded="false" data-target="#orders_sub_menu" aria-controls="orders_sub_menu"><i
            class="fa fa-fw fa-user-circle"></i>Orders</a>
    <div id="orders_sub_menu" class="collapse submenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('order.create') }}">Create</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('order.index') }}">List</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link {{ isset($customers_active) ? 'active' : '' }}" href="{{ route('customer.index') }}"><i
            class="fa fa-fw fa-user-circle"></i>Customers</a>
</li>



{{-- <li class="nav-item ">
    <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1"
        aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>C Dashboard </a>
    <div id="submenu-1" class="collapse submenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                    data-target="#submenu-1-2" aria-controls="submenu-1-2">E-Commerce</a>
                <div id="submenu-1-2" class="collapse submenu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index-2.html">E Commerce
                                Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard/ecommerce-product.html">Product List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard/ecommerce-product-single.html">Product
                                Single</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard/ecommerce-product-checkout.html">Product
                                Checkout</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dashboard/dashboard-finance.html">Finance</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dashboard/dashboard-sales.html">Sales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                    data-target="#submenu-1-1" aria-controls="submenu-1-1">Infulencer</a>
                <div id="submenu-1-1" class="collapse submenu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard/dashboard-influencer.html">Influencer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard/influencer-finder.html">Influencer
                                Finder</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard/influencer-profile.html">Influencer
                                Profile</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                    data-target="#submenu-1-3" aria-controls="submenu-1-3">Contacts</a>
                <div id="submenu-1-3" class="collapse submenu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard/dashboard-contact.html">Contacts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard/dashboard-contact-list.html">Contact
                                List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard/dashboard-contact-cardlist.html">Contact
                                Cardlist</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                    data-target="#submenu-1-4" aria-controls="submenu-1-4">Invoice</a>
                <div id="submenu-1-4" class="collapse submenu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard/dashboard-invoice.html">Invoice</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard/dashboard-invoice-list.html">Invoice
                                List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard/dashboard-invoice-form.html">Invoice
                                Form</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard/dashboard-invoice-sample.html">Invoice Form
                                Sample</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="index.html"><i class="fa fa-fw fa-rocket"></i>UI Elements</a>
</li> --}}
