<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
            <img src="<?= base_url()?>/assets/images/user.jpg" width="160px" height="160px" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p style="font-size: 16px;"><?= $login['fullname'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li >
          <a href="<?php echo site_url(); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              
            </span>
          </a>
          
        </li>
        <?php
        $segmen1 = '';
        $segmen2 = '';
        if(!blank($this->uri->segment(1))){
            $segmen1 = $this->uri->segment(1);
        }
        if(!blank($this->uri->segment(2))){
            $segmen2 = $this->uri->segment(2);
        }
                foreach ($menu->result() as $value) {
                    
                    if (empty($value->parent)) {
                        $aktif = '';
                        $has_sub = 0;
                            if(strtolower($value->menu) == strtolower($segmen1)){
                                $aktif = ' active';
                            }
                        $echo = '<li class="treeview '.$aktif.'" >
                                        <a href="#">
                                            <i class="fa '.$value->icon.'"></i>
                                            <span>' . $value->menu . '</span>
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </a>
                                        <ul class="treeview-menu">';
                        foreach ($menu->result() as $v) {
                            
                            if ($v->parent == $value->menu_id && $v->aksi == 'view') {
                                $has_sub++;
                                $echo .= '<li> 
                                    <a href="' . site_url($v->modul) . '">
                                        <i class="fa fa-circle-o"></i> <span>' . $v->menu . '</span> 
                                    </a>
                                </li>';
                            }
                        }
                        $echo .= '</ul>
                                    </li>';
                        if($has_sub > 0){
                            echo $echo;
                        }
                    }
                }
                ?>
      
        <li >
          <a href="<?php echo site_url('system/Kritik_saran'); ?>">
            <i class="fa fa-comments"></i> <span>Kritik dan Saran</span>
            <span class="pull-right-container">
              
            </span>
          </a>
          
        </li>
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>