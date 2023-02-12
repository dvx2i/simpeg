<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=daftar_nominatif_pegawai.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
 
?>
<p align="center"><span style="font-size:22pt;"><font color="black" size="4" face="Times New Roman, Times, serif"><strong><font face="Arial, Helvetica, sans-serif">
                                NOMINATIF PEGAWAI</font></strong></font></span><font color="black" face="Arial, Helvetica, sans-serif"><br>
                        <strong><font color="black" size="2" id="targetopdnama"></font><font color="black" size="2">
                            Keadaan : <?= tgl_indo(date('Y-m-d')) ?>&nbsp;</font></strong></font></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr bgcolor="white">
                                <td bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">No</font></div></b></td>
                                <td width="200" bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Nama 
                                            Pegawai<br>
                                            NIP / No.KARPEG<br>
                                            Tgl. Lahir/Sta.Kawin</font></div></b></td>
                                <td width="100" bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Pangkat<br>
                                            TMT<br>
                                            Masa Kerja</font></div></b></td>
                                <td width="300" bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Jabatan<br>
                                            Eselon/TMT</font></div></b></td>
                                <td width="150" bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Pendidikan<br>
                                            Terakhir</font></div></b></td>
                                <td width="200" bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Diklat 
                                            Struktural<br>
                                            Diklat Teknis Fungs.<br>
                                            Tahun</font></div></b></td>
                                <td width="200" bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Alamat</font></div></b></td>
                                <td bgcolor="white"><b><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Keterangan</font></div></b></td>
                            </tr>
                        </thead>
                        <tbody id="content">
                            <?php
                            $no = 0;
                            if(!empty($result)){
                            foreach ($result->result() as $value) {
                                $no++;
                                ?>
                                <tr bgcolor="white">
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $no ?></font></div></td>
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_nama ?><br><?= "=\"$value->pegawai_nip\"" ?><br><?= $value->pegawai_nip_lama ?> / <?= $value->pegawai_no_karpeg ?><br><?= $value->pegawai_tempat_lahir ?>, <?= tgl($value->pegawai_tgl_lahir) ?><br><?= $value->pegawai_statusperkawinan_nama ?><br><?= $value->pegawai_agama_nama ?></font></div></td>
                                    <td><div align="center"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_pangkat_terakhir_golru ?><br><?= tgl($value->pegawai_pangkat_terakhir_tmt) ?><br><?= $value->pegawai_pangkat_terakhir_tahun . ' th ' . $value->pegawai_pangkat_terakhir_bulan . ' bln' ?></font></div></td>
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_jabatan_nama ?><br><?= $value->pegawai_unit_nama ?><br><?= $value->pegawai_eselon_nama . ' ' ?></font></div></td>
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_pendidikan_terakhir_tingkat ?><br><?= $value->pegawai_pendidikan_terakhir_nama ?> <br><?= $value->pegawai_pendidikan_terakhir_rumpun ?><br><?= tgl($value->pegawai_pendidikan_terakhir_tgl_ijazah) ?></font></div></td>
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_diklat_struktural_terakhir ?><br><?= $value->pegawai_diklat_struktural_terakhir_tahun ?></font></div></td>
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_alamat ?><br>RT : <?= $value->pegawai_rt ?>/RW : <?= $value->pegawai_rw ?><br><?= $value->pegawai_kelurahan_nama ?><br><?= $value->pegawai_kecamatan_nama ?><br><?= $value->pegawai_kabupaten_nama ?><br><?= $value->pegawai_propinsi_nama ?><br>Telp. : <?= $value->pegawai_hp ?></font></div></td>
                                    <td><div align="left"><font color="black" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?= $value->pegawai_keterangan ?></font></div></td>
                                </tr>
                            <?php }
                            }?>
                        </tbody>
                    </table>