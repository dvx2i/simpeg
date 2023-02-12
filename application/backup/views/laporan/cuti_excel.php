<?php defined('BASEPATH') or exit('No direct script access allowed');
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=daftar_nominatif_pegawai_cuti.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

?>
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