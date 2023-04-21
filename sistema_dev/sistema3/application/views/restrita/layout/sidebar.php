<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url(); ?>"> <img alt="image" src="<?= base_url("public/assets/img/logo.png"); ?>" class="header-logo" /> <span class="logo-name">WL TOPOS</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="dropdown">
                <?= ($this->router->fetch_class() == 'home' && $this->router->fetch_method() == 'index')? '<div class="active"></div>':''?>
                <a href="<?= base_url("restrita/home"); ?>" class="nav-link"><i data-feather="home"></i><span>Inicio</span></a>
            </li>
            <li class="dropdown">
            <?= ($this->router->fetch_class() == 'usuarios' && $this->router->fetch_method() == 'index')? '<div class="active"></div>':''?>
                <a href="<?= base_url("restrita/usuarios"); ?>" class="nav-link"><i data-feather="users"></i><span>Usuários</span></a>
            </li>
            <li class="dropdown">
                <a href="<?= base_url("restrita/usuarios"); ?>" class="menu-toggle nav-link has-dropdown"><i data-feather="briefcase"></i><span>Usuarios</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url("restrita/usuarios"); ?>">Listar</a></li>
                    <li><a class="nav-link" href="<?= base_url(); ?>widget-data.html">Data Widgets</a></li>
                </ul>
            </li>
            
        </ul>
    </aside>
</div>