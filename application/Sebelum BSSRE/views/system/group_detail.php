<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Group
        </h1>
    </section>


    <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body table-responsive">
                        <form role="form" method="post" action="<?= site_url('system/Group/save/'.$group->GroupId)?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <?php
                            //MENU
                            $no1=0;
                             foreach ($menu->result() as $menu1) {
                                 if(blank($menu1->parent)){
                                     echo '<b><input type="checkbox" id="menu_'.++$no1.'" onClick="Cek('.$no1.')">'.$menu1->menu.'</b><br/>';
                                     //SUB MENU
                                     $menu_id = $menu1->menu_id;
                                     $no2=0;
                                     foreach ($menu->result() as $menu2) {
                                         if($menu2->parent == $menu1->menu_id && $menu2->menu_id != $menu_id){
                                             $menu_id = $menu2->menu_id;
                                             echo '&nbsp;&nbsp;&nbsp;&nbsp;'.'<b><input type="checkbox" id="menu_'.$no1.'_'.++$no2.'" onClick="CekSub('.$no1.','.$no2.')">'.$menu2->menu.'</b><br/>';
                                             //AKSI
                                             $no3=0;
                                             foreach ($menu->result() as $menu3) {
                                                 if($menu3->menu_id == $menu2->menu_id){
                                                     if(in_array($menu3->aksi_id, $detail)){
                                                         $check = 'checked="checked"';
                                                     }else{
                                                         $check = '';
                                                     }
                                                     echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<input type="checkbox" name="aksi[]" value="'.$menu3->aksi_id.'" id="menu_'.$no1.'_'.$no2.'_'.++$no3.'" onClick="" '.$check.'>'.$menu3->aksi.'&nbsp;&nbsp;&nbsp;&nbsp;';
                                                 }
                                                 
                                             }
                                             echo '<br/>';
                                         }
                                         
                                     }
                                 }
                                                                                                 
                             }
                            ?>
                            
                        </div>
                        <button type="submit" class="btn btn-default">Simpan</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>   
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function Cek(m) {
        var sel;
        if (document.getElementById('menu_' + m).checked)
            sel = 'checked';
        else
            sel = '';
        for (var i = 1; i < 100; i++) {
            if (document.getElementById('menu_' + m + '_' + i) != null) {
                document.getElementById('menu_' + m + '_' + i).checked = sel;
                CekSub(m, i);
            } else{
                break;
            }
        }
    }

    function CekSub(m, s) {
        var sel;
        if (document.getElementById('menu_' + m + '_' + s).checked)
            sel = 'checked';
        else
            sel = '';
        for (var i = 0; i < 100; i++) {
            if (document.getElementById('menu_' + m + '_' + s + '_' + i) != null)
                document.getElementById('menu_' + m + '_' + s + '_' + i).checked = sel;
            
        }
        
    }

    function CekSubSub(m, s, c) {
        var sel;
        if (document.getElementById('menu_' + m + '_' + s + '_' + c).checked)
            sel = 'checked';
        else
            sel = '';
        if (sel == '') {
            var se;
            for (var i = 0; i < 100; i++) {
                if (document.getElementById('menu_' + m + '_' + s + '_' + i) != null) {
                    if (document.getElementById('menu_' + m + '_' + s + '_' + i).checked) {
                        se = 'checked';
                        break;
                    }
                } else
                    break;
            }
            document.getElementById('menu_' + m + '_' + s).checked = se;
            var ss;
            for (var i = 0; i < 100; i++) {
                if (document.getElementById('menu_' + m + '_' + i) != null) {
                    if (document.getElementById('menu_' + m + '_' + i).checked) {
                        ss = 'checked';
                        break;
                    }
                } else
                    break;
            }
            document.getElementById('menu_' + m).checked = ss;
        } else {
            document.getElementById('menu_' + m + '_' + s).checked = sel;
            document.getElementById('menu_' + m).checked = sel;
        }
    }
</script>