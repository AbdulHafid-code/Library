<div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto" method="get" action="<?= base_url('search') ?>">
          <?= csrf_field() ?>
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" name="keyword" placeholder="Search..." aria-label="Search" data-width="250">
            <button class="btn" type="submit" ><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <!-- <div class="search-result"></div> -->
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="/foto_siswa/<?= $userLogin['foto_siswa'] ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?= $userLogin['nama_user'] ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- <a href="/profil/<?= $userLogin['id_user'] ?>" class="dropdown-item has-icon">
                
              </a> -->

              <form action="/profil" method="post">
                  <?= csrf_field() ?>
                  <button type="submit"><i class="far fa-user"></i> Profile</button>
              </form>


              <div class="dropdown-divider"></div>
              <a href="/logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Log Out
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Library</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">LB</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="active">
              <a href="/" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <!-- <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
              </ul>
            </li> -->
            <li><a class="nav-link" href="/favorit"><i class="far fa-square"></i> <span>Favorit</span></a></li>
          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div>        
        </aside>
      </div>