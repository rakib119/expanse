<li class="nav-item">
    <a class="nav-link" href="/"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>
</li>
<li class="nav-item ">
    <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#company_sub_menu"
        aria-controls="company_sub_menu"><i class="fa fa-fw fa-user-circle"></i>Company</a>
    <div id="company_sub_menu" class="collapse submenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.create')}}">Create</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.index')}}">List</a>
            </li>
        </ul>
    </div>
</li>
