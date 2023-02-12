<style>
  img.profile-picture {
    /* width: 100%; */
    /* height: 50%; */
    /* max-width: 53px; */
    /* max-height: 53px; */
    object-fit: cover;
    display: block;
}
.profile-picture {
    border-radius: 50%;
    margin-top: 0;
    border: 1px solid black;
    margin-bottom: 20px;
    height: 56px;
    width: 56px;
    overflow: hidden;

}

</style>
<?php 
$session = $this->session->userdata('login');
if(isset($session['foto'])){
  $foto = $session['foto'];
}else{
  $foto = base_url()."/assets/images/user.jpg";
}
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left">
            <img src="<?= $foto ?>" width="60px" height="60px" class="profile-picture" alt="User Image">
        </div>
        <div class="pull-left info" style="white-space: normal;">
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
                            if(strtolower($value->menu) == strtolower($segmen1) || (strtolower($value->menu) == 'penandatanganan' && $segmen1 == 'esign' ) ){
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
                                
                                  $modul = explode('/',$v->modul);
                                if ($modul[2] == '#') {
                                  $aktif2 = '';
                                  $has_sub2 = 0;
                                  if($modul[1] == strtolower($segmen2)){
                                      $aktif2 = ' active';
                                  }
                                  $echo .= '<li class="treeview '.$aktif2.'" >
                                                  <a href="#">
                                                  <i class="fa fa-circle-o"></i> 
                                                      <span>' . $v->menu . '</span>
                                                      <i class="fa fa-angle-left pull-right"></i>
                                                  </a>
                                                  <ul class="treeview-menu">';
                                                  
                                  foreach ($menu->result() as $v2) {
                              
                                    if ($v2->parent == $v->menu_id && $v2->aksi == 'view') {
                                        $has_sub2++;
                                        $echo .= '<li> 
                                            <a href="' . site_url($v2->modul) . '">
                                                <i class="fa fa-circle-o"></i> <span>' . $v2->menu . '</span> 
                                            </a>
                                        </li>';
                                    }
                                }
                                $echo .= '</ul>
                                            </li>';

                                }else{
                                  
                                    if($v->menu_id == '174' || $v->menu_id == '152'){

                                      $echo .= '<li> 
                                      <a href="' . site_url($v->modul) . '">
                                          <i class="fa fa-circle-o"></i> <span>' . $v->menu . ' '. $label['kgb'] .'</span>
                                      </a>
                                  </li>';
                                    }elseif($v->menu_id == '175' || $v->menu_id == '148'){

                                      $echo .= '<li> 
                                      <a href="' . site_url($v->modul) . '">
                                          <i class="fa fa-circle-o"></i> <span>' . $v->menu . ' '. $label['cuti'] .'</span>
                                      </a>
                                  </li>';
                                    }elseif($v->menu_id == '178'){

                                      $echo .= '<li> 
                                      <a href="' . site_url($v->modul) . '">
                                          <i class="fa fa-circle-o"></i> <span>' . $v->menu . ' '. $label['pensiun'] .'</span>
                                      </a>
                                  </li>';
                                    }elseif($v->menu_id == '182'){

                                      $echo .= '<li> 
                                      <a href="' . site_url($v->modul) . '">
                                          <i class="fa fa-circle-o"></i> <span>' . $v->menu . ' '. $label['pangkat'] .'</span>
                                      </a>
                                  </li>';
                                    }
                                    else{
                                    $echo .= '<li> 
                                    <a href="' . site_url($v->modul) . '">
                                        <i class="fa fa-circle-o"></i> <span>' . $v->menu . '</span>
                                    </a>
                                </li>';
                                    }
                                }
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
          <a href="<?php echo site_url('cuti/Pengajuan'); ?>">
            <i class="fa fa-file"></i> <span>Cuti Online</span>
            <span class="pull-right-container">
              
            </span>
          </a>
          
        </li>
      <?php if($login['group_id'] == '1') : ?>
        <li >
          <a href="<?php echo site_url('system/Kritik_saran'); ?>">
            <i class="fa fa-comments"></i> <span>Kritik dan Saran</span>
            <span class="pull-right-container">
              
            </span>
          </a>
          
        </li>
      <?php endif; ?>
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>