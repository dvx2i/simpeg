<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Penjagaan Kenaikan Gaji Berkala
        </h1>
    </section>


    <section class="content">

        
        <div class="row" id="riwayat">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <form action="<?= site_url('laporan/PenjagaanKgb/excel/') ?>" target="_blank" method="post" enctype="multipart/form-data">
                            
                            
                            <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</button>
                        </form>
                        
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Daftar Kenaikan Gaji Berkala
                    </div>
                    <div class="panel-body">
                        <?php
                        echo tableBuilder($result,NULL,'html');
                        ?>

                    </div>
                    <!-- /.panel-body -->
                </div>

            </div>
        </div>
    </section>
</div>
