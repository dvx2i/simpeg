<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Nomnatif Pegawai Pensiun
        </h1>
    </section>

    <section class="content">
        <div class="row" id="filter">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-search fa-fw"></i> Filter
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <div class="form-group">
                                <div class="input-group-addon">
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="btn btn-default">Tahun</div>
                                            </span>
                                            <select class="form-control " name="tahun" id="tahun" required="true">

                                                <!-- <?php
                                                        foreach ($list_tahun->result() as $value) {
                                                        ?>
                                                    <option value="<?= $value->tahun ?>" <?= selected($value->tahun, $tahun, TRUE) ?>><?= $value->tahun ?></option>
                                                <?php } ?> -->
                                                <?php
                                                $year = date('Y');
                                                for ($v = $year; $v > 1950; $v--) {
                                                ?>
                                                    <option value="<?= $v ?>" <?= selected($v, $tahun, TRUE) ?>><?= $v ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 ">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="btn btn-default">Bulan</div>
                                            </span>
                                            <select class="form-control " name="bulan" id="bulan">
                                                <option value="">--Semua--</option>
                                                <?php
                                                for ($bulans = 1; $bulans < 13; $bulans++) {
                                                ?>
                                                    <option value="<?= $bulans ?>" <?= selected($bulans, $bulan, TRUE) ?>><?= bulan($bulans) ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 ">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="btn btn-default">Jenis Pensiun</div>
                                            </span>
                                            <select class="form-control " name="jenis" id="jenis">
                                                <option value="">--Semua--</option>
                                                <?php
                                                foreach ($list_pensiun->result() as $key) {
                                                ?>
                                                    <option value="<?= $key->jenis_pensiun_id ?>" <?= selected($key->jenis_pensiun_id, $jenis, TRUE) ?>><?= $key->jenis_pensiun_nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Tampilkan</button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>


        <div class="row" id="golru">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <button onclick="cetak()" class="btn btn-default"><i class="fa fa-print"></i> Cetak</button>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Nomnatif Pegawai Pensiun
                    </div>
                    <div class="panel-body" id="target_print">
                        <style>
                            th {
                                text-align: center;
                            }

                            td {
                                padding-left: 10px;
                                padding-right: 10px;
                                text-align: left;
                            }
                        </style>
                        <p align="center"><b>DAFTAR NOMINATIF PEGAWAI YANG TELAH PENSIUN PADA TAHUN <?= $tahun ?> <?= $bulan != '' ? 'BULAN ' . strtoupper(bulan($bulan)) : ''; ?>
                                <br />DI LINGKUNGAN PEMERINTAH KABUPATEN SANGGAU
                            </b></p>
                        <div class="table-responsive">
                            <table width="100%" border="1" cellspacing="0">
                                <tr>
                                    <th width="3%" scope="col">NO</th>
                                    <th width="22%" scope="col">NAMA<br>
                                        NIP<br>
                                        TEMPAT / TANGGAL LAHIR</th>
                                    <th width="10%" scope="col">PANGKAT /<br>
                                        GOL. RUANG</th>
                                    <th width="15%" scope="col">JABATAN TERAKHIR</th>
                                    <th width="20%" scope="col">PENDIDIKAN TERAKHIR</th>
                                    <th width="20%" scope="col">UNIT KERJA TERAKHIR</th>
                                    <th width="10%" scope="col">JENIS<br>
                                        PENSIUN</th>
                                    <th width="10%" scope="col">T.M.T<br>
                                        PENSIUN</th>
                                </tr>
                                <tr align="center">
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                </tr>
                                <?php
                                $no = 1;
                                foreach ($result->result() as $value) {
                                ?>
                                    <tr>
                                        <td valign="top"><?= $no++; ?></td>
                                        <td valign="top"><?= pegawai_gelar($value) . '<br/>' . $value->pegawai_nip . '<br/>' . $value->pegawai_tempat_lahir . ', ' . tgl($value->pegawai_tgl_lahir) ?></td>
                                        <td valign="top"><?= $value->pegawai_pangkat_terakhir_nama . '<br/>' . $value->pegawai_pangkat_terakhir_golru ?></td>
                                        <td valign="top"><?= $value->pegawai_jabatan_nama . '<br/>' . tgl($value->pegawai_jabatan_tmt) ?></td>
                                        <td valign="top"><?= $value->pegawai_pendidikan_terakhir_jurusan ?></td>
                                        <td valign="top"><?= $value->pegawai_unit_nama ?></td>
                                        <td valign="top"><?= $value->pegawai_jenis_pensiun_nama ?></td>
                                        <td valign="top"><?= tgl($value->pegawai_pensiun_tmt) ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>



    </section>
</div>

<script>
    function cetak() {
        var content = document.getElementById("target_print").innerHTML;
        var mywindow = window.open('', 'Print', 'height=600,width=800');

        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(content);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus();
        mywindow.print();
        //mywindow.close();
        //return true;
    }
</script>