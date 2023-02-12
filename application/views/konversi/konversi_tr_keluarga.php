<?php
defined('BASEPATH') or exit('No direct script access allowed');
$modul = 'Konversi Data Pegawai Keluarga';
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <i class="fa fa-list fa-fw"></i> <?= $modul ?> 
                    </div>
                    <div class="panel-body">
                        <form role="form" onsubmit="return loading()" action="<?php echo site_url('konversi/TrKeluarga/add'); ?>" enctype="multipart/form-data" method="POST">
                            <div class="box-body">

                                <div class="form-group">
                                    <label>File EXCEL</label>
                                    <input type="file" required="" class="form-control" name="userfile" placeholder="" autocomplete="off" />
                                    <small>proses konversi mungkin membutuhkan waktu lebih lama tergantung jumlah data excel yang di upload</small>
                                    <br/>
                                    <a href="<?= base_url('assets/files/excel/TR_KELUARGA.xlsx')?>" target="_blank"><i class="fa fa-file-excel-o"></i> Dowload Format Excel Disini</a>
                                </div>

                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <i class="fa fa-list fa-fw"></i> Hasil <?= $modul ?> 
                    </div>
                    <div class="panel-body">
                        <i id="loading" class="fa-spin"> </i><span id="loadname"><?php echo $konversi; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
