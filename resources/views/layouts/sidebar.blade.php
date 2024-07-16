<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<aside class="main-sidebar sidebar-dark-primary elevation-0 bg-dark">
    <a href="#" class="brand-link bg-warning">
        <img src="{{ asset('public/admin_assets') }}/dist/img/avatar5.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-dark text-dark">
            {{ Auth::user()->name }}
        </span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php
                    if(Auth::user()->roleid==1){
                        $menuList = App\Models\MenuList::where('status','=',1)->get();
                    }else {
                        $menuList = App\Models\MenuList::join('menu_permissions','menu_permissions.menuID','=','menu_lists.id')
                                    ->where('menu_permissions.roleID','=', Auth::user()->roleid)
                                    ->where('menu_lists.status','=',1)
                                    ->select('menu_lists.*')
                                    ->get();
                    }
                @endphp
                @foreach ($menuList as $item)
                    <li class="nav-item {{ request()->is($item->route) ? 'menu-open' : '' }}">
                        <a href="{{ url($item->route) }}" class="nav-link {{ request()->is($item->route) ? 'active' : '' }}">
                            {!! $item->icon !!}
                            <p>
                                {{  $item->name }}
                            </p>
                        </a>
                    </li>
                @endforeach
                {{-- 
                <li class="nav-item {{ request()->is('dashboard') ? 'menu-open' : '' }}">
                    <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (Auth::user()->roleid == 1)
                    <li class="nav-item {{ request()->is('roles') ? 'menu-open' : '' }}">
                        <a href="{{ url('roles') }}" class="nav-link {{ request()->is('roles') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-circle-user"></i>
                            <p>Role Manage</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->roleid == 1)
                    <li class="nav-item {{ request()->is('users') ? 'menu-open' : '' }}">
                        <a href="{{ url('users') }}" class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-users"></i>
                            <p>User Manage</p>
                        </a>
                    </li>
                @endif
                </li> 
                 <li class="nav-item {{ request()->is('expenseheads') ? 'menu-open' : '' }}">
                    <a href="{{ url('expenseheads') }}" class="nav-link {{ request()->is('expenseheads') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-circle-dollar-to-slot"></i>
                        <p>Expense Heads Manage</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('expenses') ? 'menu-open' : '' }}">
                    <a href="{{ url('expenses') }}" class="nav-link {{ request()->is('expenses') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-sack-dollar"></i>
                        <p>Expenses</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('basic-infos') ? 'menu-open' : '' }}">
                    <a href="{{ url('basic-infos') }}" class="nav-link {{ request()->is('basic-infos') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-building"></i>
                        <p>Basic Info Manage</p>
                    </a>
                </li> 
                <li class="nav-item {{ request()->is('flats') ? 'menu-open' : '' }}">
                    <a href="{{ url('flats') }}" class="nav-link {{ request()->is('flats') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-credit-card"></i>
                        <p>Flat Manage</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('flatSales') ? 'menu-open' : '' }}">
                    <a href="{{ url('flatSales') }}" class="nav-link {{ request()->is('flatSales') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-credit-card"></i>
                        <p>Flat Sales</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('collections') ? 'menu-open' : '' }}">
                    <a href="{{ url('collections') }}" class="nav-link {{ request()->is('collections') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-credit-card"></i>
                        <p>Collections</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('AdditionalAndDiscount') ? 'menu-open' : '' }}">
                    <a href="{{ url('AdditionalAndDiscount') }}" class="nav-link {{ request()->is('AdditionalAndDiscount') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-credit-card"></i>
                        <p>Additional & Discount</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('renters') ? 'menu-open' : '' }}">
                    <a href="{{ url('renters') }}" class="nav-link {{ request()->is('renters') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>Renters Manage</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('projectReport') ? 'menu-open' : '' }}">
                    <a href="{{ url('projectReport') }}" class="nav-link {{ request()->is('projectReport') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-credit-card"></i>
                        <p>Project Report</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('flatReport') ? 'menu-open' : '' }}">
                    <a href="{{ url('flatReport') }}" class="nav-link {{ request()->is('flatReport') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-credit-card"></i>
                        <p>Flat Report</p>
                    </a>
                </li> --}}
            </ul>
        </nav>
    </div>
</aside>
<aside class="control-sidebar control-sidebar-dark"></aside>