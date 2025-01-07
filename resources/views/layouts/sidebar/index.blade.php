<div class="sidebar-content" id="nav">
    <ul>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="link">
                <i class="ti-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-category">
            <span class="text-uppercase">Menu</span>
        </li>
        <li>
            <a href="javascript:void" class="main-menu has-dropdown">
                <i class="ti-user"></i>
                <span>User</span>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('user.index') }}" class="link">
                        <span>Kelola User</span></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void" class="main-menu has-dropdown">
                <i class="ti-direction-alt"></i>
                <span>Survey</span>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('admin.layanan') }}" class="link">
                        <span>Kelola Layanan</span></a>
                </li>
                <li><a href="{{ route('admin.question') }}" class="link">
                        <span>Kelola Pertanyaan</span></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void" class="main-menu has-dropdown">
                <i class="ti-email"></i>
                <span>Anyswer</span>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('admin.fill_surveys') }}" class="link">
                        <span>Kelola Laporan</span></a>
                </li>
            </ul>
        </li>

        <li class="menu-category">
            <span class="text-uppercase">Setting</span>
        </li>
        <li>
            <a href="{{ route('logout') }}" class="link">
                <i class="ti-power-off"></i>
                <span>Log out</span>
            </a>
        </li>
    </ul>
</div>
