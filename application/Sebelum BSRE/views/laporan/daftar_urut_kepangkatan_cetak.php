<style type="text/css">
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: x-small;
}
</style>
<body onload="print()">
<?php if (isset($where)) { ?>
            <div class="row" id="riwayat">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div style="float: right;padding-top: 3px;padding-right: 13px">
                            

                        </div>
                        
                        <div class="panel-body">
                            <p align="center"><b>DAFTAR URUT KEPANGKATAN PEGAWAI NEGERI SIPIL
                                    <br/>UNIT ORGANISASI : <?= $unit_select->unit_nama ?>
                                    <br/>TEMPAT : <?= $unit_select->unit_alamat ?></b></p>
                            <p>  
                            <table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <thead>
                                <tr>
    <th rowspan="2" align="center" scope="col">NO</th>
    <th rowspan="2" align="center" scope="col">NAMA</th>
    <th rowspan="2" align="center" scope="col">NIP</th>
    <th colspan="2" align="center" scope="col">PANGKAT</th>
    <th colspan="2" align="center" scope="col">JABATAN</th>
    <th colspan="2" align="center" scope="col">MASA<br />
      KERJA<br />
      TOTAL</th>
    <th colspan="3" align="center" scope="col">LATIHAN JABATAN</th>
    <th colspan="3" align="center" scope="col">PENDIDIKAN</th>
    <th rowspan="2" align="center" scope="col">USIA</th>
  </tr>
  <tr>
    <th align="center" scope="col">GOL/<br />
    RUANG</th>
    <th align="center" scope="col">TMT</th>
    <th align="center" scope="col">NAMA/TMT, JABATAN</th>
    <th align="center" scope="col">TMT<br />
    ESELON</th>
    <th align="center" scope="col">THN</th>
    <th align="center" scope="col">BLN</th>
    <th align="center" scope="col">NAMA</th>
    <th align="center" scope="col">THN</th>
    <th align="center" scope="col">JAM</th>
    <th align="center" scope="col">NAMA</th>
    <th align="center" scope="col">TAHUN<br />
    LULUS</th>
    <th align="center" scope="col">TINGKAT<br />
      IJAZAH</th>
  </tr>
  <tr>
    <th align="center" scope="col">1</th>
    <th align="center" scope="col">2</th>
    <th align="center" scope="col">3</th>
    <th align="center" scope="col">4</th>
    <th align="center" scope="col">5</th>
    <th align="center" scope="col">6</th>
    <th align="center" scope="col">7</th>
    <th align="center" scope="col">8</th>
    <th align="center" scope="col">9</th>
    <th align="center" scope="col">10</th>
    <th align="center" scope="col">11</th>
    <th align="center" scope="col">12</th>
    <th align="center" scope="col">13</th>
    <th align="center" scope="col">14</th>
    <th align="center" scope="col">15</th>
    <th align="center" scope="col">16</th>
  </tr>
  </thead>
                                <?php
                                $no = 0;
                                if (!empty($result)) {
                                    foreach ($result->result() as $value) {
                                        $usia = diffMasa($value->pegawai_tgl_lahir, date('Y-m-d'));
                                        $no++;
                                        ?>
                                        <tr>
                                            <td align="center"><?= $no ?></td>
                                            <td><?= $value->pegawai_nama ?></td>
                                            <td><?= $value->pegawai_nip ?></td>
                                            <td><?= $value->pegawai_pangkat_terakhir_golru ?></td>
                                            <td><?= tgl($value->pegawai_pangkat_terakhir_tmt) ?></td>
                                            <td><?= $value->pegawai_jabatan_nama ?></td>
                                            <td><?php if($value->pegawai_eselon_id != '99' && !empty($value->pegawai_eselon_id)) echo $value->pegawai_jabatan_tmt; ?></td>
                                            <td align="center"><?= $value->pegawai_pangkat_terakhir_tahun ?></td>
                                            <td align="center"><?=$value->pegawai_pangkat_terakhir_bulan?></td>
                                            <td><?= $value->pegawai_diklat_struktural_terakhir ?></td>
                                            <td align="center"><?= $value->pegawai_diklat_struktural_terakhir_tahun ?></td>
                                            <td align="center">&nbsp;</td>
                                            <td><?= $value->pegawai_pendidikan_terakhir_nama ?> </td>
                                            <td><?= $value->pegawai_pendidikan_terakhir_tgl_ijazah ?></td>
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
</body>