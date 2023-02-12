<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Daftar Jumlah Diklat Struktual
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
                                                <label>Jenis Diklat</label>
                                                <select required class="form-control select2" id="diklat_struktural_kode" name="diklat_struktural_kode">
                                                    <option value="">-- PILIH --</option>
                                                    <?php foreach ($diklat_kode->result() as $value) { ?>
                                                        <option value="<?= $value->diklat_struktural_kode ?>" <?php if (isset($where['diklat_struktural_kode'])) echo selected($value->diklat_struktural_kode, $where['diklat_struktural_kode']) ?>><?= $value->diklat_struktural_nama ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun</label>
                                                <!-- <input type="number" onkeydown="return (event.which < 100)" max="<?= date('Y') ?>" class="form-control" name="pegawaijasa_tahun" id="pegawaijasa_tahun"  autocomplete="off"/> -->
                                                <select class="form-control" name="tahun" id="tahun">
                                                    <option value="">--Pilih--</option>
                                                    <?php
                                                    $year = date('Y');
                                                    for ($v = $year; $v > 1950; $v--) {
                                                    ?>
                                                        <option value="<?= $v ?>" <?= selected($v, $tahun, TRUE) ?>><?= $v ?></option>
                                                    <?php } ?>
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
                        <form action="<?= site_url('laporan/DiklatPim/excel/') ?>" target="_blank" method="post" enctype="multipart/form-data">
                            <?php
                            foreach ($where as $key => $value) {
                                echo '<input type="hidden" value="' . $value . '" name="' . $key . '"/>';
                            }
                            ?>

                            <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</button>
                        </form>

                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Daftar Jumlah Diklat Struktual
                    </div>
                    <div class="panel-body">
                        <p align="center"><span style="font-size:22pt;">
                                <font color="black" size="4" face="Times New Roman, Times, serif"><strong>
                                        <font face="Arial, Helvetica, sans-serif">
                                            Jumlah Diklat Struktual</font>
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
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">DIKLAT<br>
                                                JUMLAH DIKLAT</font>
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
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->diklat_struktural_nama ?> <br> <?= $value->jumlah ?></font>
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