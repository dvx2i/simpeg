<?php defined('BASEPATH') or exit('No direct script access allowed');
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=daftar_nominatif_pegawai.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

?>
<p align="center"><span style="font-size:22pt;">
        <font color="black" size="4" face="Times New Roman, Times, serif"><strong>
                <font face="Arial, Helvetica, sans-serif">
                    Nominatif Pegawai Satya Lancana</font>
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