<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('adm.index') }}" class="brand-link">
        <img src="{{ asset('assets/img/AdminLTELogo.png') }}"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8; background-color: #fff"/>
        <span class="brand-text font-weight-light">Admin - {{ $wtitle ?? env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" data-id="adm-sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            {{-- <div class="image">
                <img src="{{ asset('assets/adm/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div> --}}
            <div class="info-wrapper">
                <div class="info">
                    <a href="javascript:void(0)" class="d-block">{ User }</a>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('adm.index') }}" class="nav-link d-flex align-items-center {{ !empty($sidebar_menu) ? ($sidebar_menu == 'dashboard' ? 'active' : '') : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{ !empty($sidebar_menu) ? ($sidebar_menu === 'location' ? 'menu-open' : '') : '' }}">
                    <a href="#" class="nav-link {{ !empty($sidebar_menu) ? ($sidebar_menu === 'location' ? 'active' : '') : '' }}">
                        <i class="nav-icon fas fa-map-marker"></i>
                        <p>
                            Location
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('adm.province.index') }}" class="nav-link  {{ !empty($sidebar_menu) && !empty($sidebar_submenu) ? ($sidebar_menu === 'location' && $sidebar_submenu === 'province' ? 'active' : '') : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Province</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('adm.regency.index') }}" class="nav-link  {{ !empty($sidebar_menu) && !empty($sidebar_submenu) ? ($sidebar_menu === 'location' && $sidebar_submenu === 'regency' ? 'active' : '') : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Regency</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>