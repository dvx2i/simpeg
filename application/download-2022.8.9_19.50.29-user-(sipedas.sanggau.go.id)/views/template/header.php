        
        <header class="main-header">
    <!-- Logo -->
    <a href="<?= site_url('Home')?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>IMPEG</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sistem Kepegawaian</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Administrator<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">

                                <li class="user-header bg-light-blue">
                                    <img src="<?= base_url() ?>assets/images/user.jpg" class="img-circle" alt="User Image" />
                                    <p>
                                        <?= $login['fullname'] ?>
                                    </p>
                                </li>

                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('user/Profil'); ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('Akun/logout'); ?>" class="btn btn-default btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
          <!-- Notifications: style can be found in dropdown.less -->
          
        </ul>
      </div>
    </nav>
  </header>