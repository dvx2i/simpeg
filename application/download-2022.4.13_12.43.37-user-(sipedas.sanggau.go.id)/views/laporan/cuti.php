<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Daftar Pegawai Cuti
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
                                                <select class="form-control" name="pegawaicuti_tahun" id="pegawaicuti_tahun">
                                                    <?php for ($y = date('Y'); $y >= 1950; $y--) : ?>
                                                        <option <?= $where['pegawaicuti_tahun'] == $y ? 'selected' : ''; ?> value="<?= $y ?>"><?= $y ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Cuti</label>
                                                <select class="form-control select2" id="pegawaicuti_jeniscuti_id" name="pegawaicuti_jeniscuti_id">
                                                    <option value="">-- PILIH --</option>
                                                    <?php foreach ($jenis_cuti->result() as $value) { ?>
                                                        <option value="<?= $value->jenis_cuti_id ?>" <?php if (isset($where['pegawaicuti_jeniscuti_id'])) echo selected($value->jenis_cuti_id, $where['pegawaicuti_jeniscuti_id']) ?>><?= $value->jenis_cuti_nama ?></option>
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
                        <form action="<?= site_url('laporan/Cuti/excel/') ?>" target="_blank" method="post" enctype="multipart/form-data">
                            <?php
                            foreach ($where as $key => $value) {
                                echo '<input type="hidden" value="' . $value . '" name="' . $key . '"/>';
                            }
                            ?>

                            <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</button>
                        </form>

                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Daftar Pegawai Cuti
                    </div>
                    <div class="panel-body">
                        <p align="center"><span style="font-size:22pt;">
                                <font color="black" size="4" face="Times New Roman, Times, serif"><strong>
                                        <font face="Arial, Helvetica, sans-serif">
                                            DAFTAR NOMINATIF PNS YANG TELAH MELAKSANAKAN CUTI PADA TAHUN <?= isset($where['pegawaicuti_tahun']) ? $where['pegawaicuti_tahun'] : date('Y'); ?><br>
                                            DI LINGKUNGAN PEMERINTAH KABUPATEN SANGGAU</font>
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
                                                    NIP</font>
                                            </div>
                                        </b></td>
                                    <td width="200" bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">UNIT KERJA</font>
                                            </div>
                                        </b></td>
                                    <td width="100" bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                                    GOL. RUANG</font>
                                            </div>
                                        </b></td>
                                    <td width="300" bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">LAMANYA</font>
                                            </div>
                                        </b></td>
                                    <td width="150" bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">NOMOR/TANGAL<br>
                                                    SURAT IZIN CUTI</font>
                                            </div>
                                        </b></td>
                                    <td width="200" bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">TANGGAL MULAI</font>
                                            </div>
                                        </b></td>
                                    <td width="200" bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">TANGGAL SELESAI</font>
                                            </div>
                                        </b></td>
                                    <td bgcolor="white"><b>
                                            <div align="center">
                                                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">JENIS CUTI</font>
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
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_nama . ' ' . $value->pegawai_gelar_belakang ?><br><?= $value->pegawai_nip ?></font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_unit_nama ?></font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="center">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_pangkat_terakhir_golru ?></font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawaicuti_lama_cuti ?> Hari Kerja</font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawaicuti_sk_no ?> THN<br><?= $value->pegawaicuti_sk_tanggal ?> BLN</font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= tgl($value->pegawaicuti_lama_cuti_mulai) ?></font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= tgl($value->pegawaicuti_lama_cuti_selesai) ?></font>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    <font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->jenis_cuti_nama ?></font>
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