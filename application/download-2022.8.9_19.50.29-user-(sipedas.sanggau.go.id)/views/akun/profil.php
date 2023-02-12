<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Profil
        </h1>
    </section>


    <section class="content">

        
        <div class="row" id="riwayat">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
<!--                        <form action="<?= site_url('laporan/DaftarJabatan/excel/') ?>" target="_blank" method="post" enctype="multipart/form-data">
                            <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</button>
                        </form>-->
                        
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Profil
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo site_url('user/Profil/update');?>" enctype="multipart/form-data" method="POST">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="hidden" name="kode" value="<?=$login['user_id'] ?>" />
                                            <input type="text" required="" class="form-control" name="nama_lengkap" value="<?=$login['fullname'] ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" disabled="" class="form-control" name="username" value="<?=$login['username'] ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Password Baru</label>
                                            <input type="text"  class="form-control" name="password" placeholder="" autocomplete="off" />
                                            <small>isi jika password akan di ganti</small>
                                        </div>


                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>


                    </div>
                    <!-- /.panel-body -->
                </div>

            </div>
        </div>
    </section>
</div>
