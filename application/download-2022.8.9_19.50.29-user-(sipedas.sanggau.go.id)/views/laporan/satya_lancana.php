<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Daftar Nominatif Pegawai Satya Lencana
        </h1>
    </section>


    <section class="content">

        <div class="row" id="riwayat">
            <div class="col-md-12">
                <div class="box">

                    <div class="box-body ">

                        <form id="formadd" role="form" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <b> FILTER</b>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label>Unit Kerja</label>
                                                <select class="form-control select2" id="pegawai_unit_id" name="pegawai_unit_id">
                                                    <option value="">-- PILIH --</option>
                                                    <?php foreach ($unit->result() as $value) { ?>
                                                        <option value="<?= $value->unit_id ?>" <?php if (isset($where['pegawai_unit_id'])) echo selected($value->unit_id, $where['pegawai_unit_id']) ?>><?= $value->unit_nama ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun</label>
                                                <!-- <input type="number" onkeydown="return (event.which < 100)" max="<?= date('Y') ?>" class="form-control" name="pegawaijasa_tahun" id="pegawaijasa_tahun"  autocomplete="off"/> -->
                                                <select class="form-control" name="pegawaijasa_tahun" id="pegawaijasa_tahun">
                                                    <option value="">--Pilih--</option>
                                                    <option value="10">10 Tahun</option>
                                                    <option value="20">20 Tahun</option>
                                                    <option value="30">30 Tahun</option>
                                                </select>
                                            </div>
                                            <div class="input-group-addon">
                                                <button type="submit" class="btn btn-success" id="tampil">Tampilkan</button>
                                            </div>
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>

                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

        </div>
        <div class="row" id="riwayat">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <form action="<?= site_url('laporan/SatyaLancana/excel/') ?>" target="_blank" method="post" enctype="multipart/form-data">
                            <?php
                            foreach ($where as $key => $value) {
                                echo '<input type="hidden" value="' . $value . '" name="' . $key . '"/>';
                            }
                            ?>

                            <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</button>
                        </form>

                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Daftar Nominatif Pegawai Satya Lencana
                    </div>
                    <div class="panel-body">
                        <p align="center"><span style="font-size:22pt;">
                                <font color="black" size="4" face="Times New Roman, Times, serif"><strong>
                                        <font face="Arial, Helvetica, sans-serif">
                                            Nominatif Pegawai Satya Lencana</font>
                                    </strong></font>
                            </span>
                            <font color="black" face="Arial, Helvetica, sans-serif"><br>
                                <strong>
                                    <font color="black" size="2" id="targetopdnama"></font>
                                    <font color="black" size="2">
                                        Keadaan : <?= tgl_indo(date('Y-m-d')) ?>&nbsp;</font>
                                </strong>
                            </font>
                        </p>
                        <p>
                        <table width="100%" border="1" cellpadding="0" cellspacing="0" class="table">
                            <thead>
                                <tr bgcolor="white">
                                    <td bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">No</font>
                                            </div>
                                        </b></td>
                                    <td width="200" bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">NAMA LENGKAP<br>
                                                    NIP<br>
                                                    TEMPAT DAN TANGGAL LAHIR</font>
                                            </div>
                                        </b></td>
                                    <td width="100" bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                                    GOL. RUANG<br>
                                                    T.M.T</font>
                                            </div>
                                        </b></td>
                                    <td width="300" bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">JABATAN TERAKHIR<br>
                                                    T.M.T</font>
                                            </div>
                                        </b></td>
                                    <td width="150" bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">MASA<br>
                                                    KERJA</font>
                                            </div>
                                        </b></td>
                                    <td width="200" bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">USIA</font>
                                            </div>
                                        </b></td>
                                    <td width="200" bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">SATYA LENCANA<br>YANG TELAH<br>DIPEROLEH</font>
                                            </div>
                                        </b></td>
                                    <td width="200" bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">UNIT KERJA</font>
                                            </div>
                                        </b></td>
                                    <td bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Keterangan</font>
                                            </div>
                                        </b></td>
                                </tr>
                            </thead>
                            <tbody id="content">
                                <?php
                                $no = 0;
                                if (!empty($result)) {
                                    foreach ($result->result() as $value) {
                                        $no++;
                                ?>
                                        <tr bgcolor="white">
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $no ?></font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_nama . ' ' . $value->pegawai_gelar_belakang ?><br><?= $value->pegawai_nip ?><br><?= $value->pegawai_tempat_lahir ?>, <?= tgl($value->pegawai_tgl_lahir) ?></font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="center">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_pangkat_terakhir_golru ?><br><?= tgl($value->pegawai_pangkat_terakhir_tmt) ?></font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_jabatan_nama ?><br><?= tgl($value->pegawai_jabatan_tmt) ?></font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->MK_TAHUN ?> THN<br><?= $value->MK_BULAN ?> BLN</font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->USIA_TAHUN ?> THN<br><?= $value->USIA_BULAN ?> BLN</font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawaijasa_nama ?></font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_unit_nama ?></font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_keterangan ?></font>
                                                </div>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.panel-body -->
                </div>

            </div>
        </div>
    </section>
</div>