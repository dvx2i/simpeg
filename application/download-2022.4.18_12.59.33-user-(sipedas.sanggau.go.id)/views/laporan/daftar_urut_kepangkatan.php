<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Daftar Urut Kepangkatan
        </h1>
    </section>


    <section class="content">

        <div class="row" id="panel_filter">
            <div class="col-md-12">
                <div class="box">

                    <div class="box-body ">

                        <form id="formadd" role="form"  method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <b> FILTER</b>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label>Unit Kerja</label>
                                                <select class="form-control select2"  id="pegawai_unit_id" name="pegawai_unit_id">
                                                    <option value="">-- PILIH --</option>
                                                    <?php foreach ($unit->result() as $value) { ?>   
                                                        <option value="<?= $value->unit_id ?>" <?php if (isset($where['pegawai_unit_id'])) echo selected($value->unit_id, $where['pegawai_unit_id']) ?>><?= $value->unit_nama ?></option>
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
        <?php if (isset($where)) { ?>
            <div class="row" id="riwayat">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div style="float: right;padding-top: 3px;padding-right: 13px">
                            <form action="<?= site_url('laporan/DaftarUrutKepangkatan/cetak/') ?>" target="_blank" method="post" enctype="multipart/form-data">
                                <?php
                                foreach ($where as $key => $value) {
                                    echo '<input type="hidden" value="' . $value . '" name="' . $key . '"/>';
                                }
                                ?>

                                <button type="submit" class="btn btn-default"><i class="fa fa-print"></i> Cetak</button>
                            </form>

                        </div>
                        <div class="panel-heading">
                            <i class="fa fa-users fa-fw"></i> DAFTAR URUT KEPANGKATAN 
                        </div>
                        <div class="panel-body">
                            <p align="center"><b>DAFTAR URUT KEPANGKATAN PEGAWAI NEGERI SIPIL
                                    <br/>UNIT ORGANISASI : <?= $unit_select->unit_nama ?>
                                    <br/>TEMPAT : <?= $unit_select->unit_alamat ?></b></p>
                            <p>  
                            <table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tr>
    <td rowspan="2" align="center" scope="col">NO</td>
    <td rowspan="2" align="center" scope="col">NAMA</td>
    <td rowspan="2" align="center" scope="col">NIP</td>
    <td colspan="2" align="center" scope="col">PANGKAT</td>
    <td colspan="2" align="center" scope="col">JABATAN</td>
    <td colspan="2" align="center" scope="col">MASA<br />
      KERJA<br />
      TOTAL</td>
    <td colspan="3" align="center" scope="col">LATIHAN JABATAN</td>
    <td colspan="3" align="center" scope="col">PENDIDIKAN</td>
    <td rowspan="2" align="center" scope="col">USIA</td>
  </tr>
  <tr>
    <td align="center" scope="col">GOL/<br />
    RUANG</td>
    <td align="center" scope="col">TMT</td>
    <td align="center" scope="col">NAMA/TMT, JABATAN</td>
    <td align="center" scope="col">TMT<br />
    ESELON</td>
    <td align="center" scope="col">THN</td>
    <td align="center" scope="col">BLN</td>
    <td align="center" scope="col">NAMA</td>
    <td align="center" scope="col">THN</td>
    <td align="center" scope="col">JAM</td>
    <td align="center" scope="col">NAMA</td>
    <td align="center" scope="col">TAHUN<br />
    LULUS</td>
    <td align="center" scope="col">TINGKAT<br />
      IJAZAH</td>
  </tr>
  <tr>
    <td align="center" scope="col">1</td>
    <td align="center" scope="col">2</td>
    <td align="center" scope="col">3</td>
    <td align="center" scope="col">4</td>
    <td align="center" scope="col">5</td>
    <td align="center" scope="col">6</td>
    <td align="center" scope="col">7</td>
    <td align="center" scope="col">8</td>
    <td align="center" scope="col">9</td>
    <td align="center" scope="col">10</td>
    <td align="center" scope="col">11</td>
    <td align="center" scope="col">12</td>
    <td align="center" scope="col">13</td>
    <td align="center" scope="col">14</td>
    <td align="center" scope="col">15</td>
    <td align="center" scope="col">16</td>
  </tr>
                                <?php
                                $no = 0;
                                if (!empty($result)) {
                                    foreach ($result->result() as $value) {
                                        $usia = diffMasa($value->pegawai_tgl_lahir, date('Y-m-d'));
                                        $no++;
                                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $value->pegawai_nama ?></td>
                                            <td><?= $value->pegawai_nip ?></td>
                                            <td><?= $value->pegawai_pangkat_terakhir_golru ?></td>
                                            <td><?= tgl($value->pegawai_pangkat_terakhir_tmt) ?></td>
                                            <td><?= $value->pegawai_jabatan_nama ?></td>
                                            <td><?php if($value->pegawai_eselon_id != '99' && !empty($value->pegawai_eselon_id)) echo tgl($value->pegawai_jabatan_tmt); ?></td>
                                            <td><?= $value->Tahun ?></td>
                                            <td><?=$value->Bulan ?></td>
                                            <td><?= $value->pegawai_diklat_struktural_terakhir ?></td>
                                            <td><?= $value->pegawai_diklat_struktural_terakhir_tahun ?></td>
                                            <td>&nbsp;</td>
                                            <td><?= $value->pegawai_pendidikan_terakhir_nama ?> </td>
                                            <td><?= tgl($value->pegawai_pendidikan_terakhir_tgl_ijazah) ?></td>
                                            <td><?= $value->pegawai_pendidikan_terakhir_tingkat ?></td>
                                            <td><?= $value->pegawai_tgl_lahir ?><br/><?= $usia['tahun'].' TH '.$usia['bulan'].' BLN' ?></td>
                                        </tr>
                                    <?php
                                    }
                                }
                                ?>
                            </table>
                            

                        </div>
                        <!-- /.panel-body -->
                    </div>

                </div>
            </div>
<?php } ?>
    </section>
</div>
