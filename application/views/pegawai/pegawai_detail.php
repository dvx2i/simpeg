<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            <?= pegawai_nama_lengkap($pegawai) ?>
        </h1>
    </section>


    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <button onclick="cetak()"  class="btn btn-default"><i class="fa fa-print"></i> Cetak</button>
                    	<button  type="button" id="btn_excel" class="btn btn-default"><i class="fa fa-print"></i> Excel</button>
                    </div>
                    <div class="box-body " id="table_identitas">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0" >
                            <tr>
                                <th colspan="5" style="text-align:center" bgcolor="#D6D6D6" scope="col">A. IDENTITAS PEGAWAI</th>
                            </tr>
                            <tr>
                                <td width="3%" nowrap>01</td>
                                <td width="17%" nowrap>NIP Lama</td>
                                <td width="1%" align="center" nowrap>:</td>
                                <td width="58%"><?= $pegawai->pegawai_nip_lama ?></td>
                                <?php
								$JPG = str_replace('.jpg', '.JPG',  $pegawai->pegawai_foto_kpe);
                                //                                                    if (!blank($pegawai->pegawai_foto_kpe)) {
                                if (file_exists(('assets/images/' . $pegawai->pegawai_foto_kpe))) {
                                    $fotokpe = 'assets/images/' . $pegawai->pegawai_foto_kpe;
                                }else if (file_exists(('assets/images/' . $JPG))) {
                                    $fotokpe = 'assets/images/' . $JPG;
                                
                                } else {
                                $foto = str_replace(".jpg",".jpeg", $pegawai->pegawai_foto_kpe);
                                                            if (file_exists(('assets/images/' . $foto))) {
                                                                $fotokpe = 'assets/images/' . $foto;
                                                            } else{
                                                                $fotokpe = 'assets/images/' . 'user.jpg';
                                                            }
                                }
                                //                                                    } else {
                                //                                                        $fotokpe = 'default.jpg';
                                //                                                    }
                                ?>
                                <td width="15%" rowspan="12"><img width="180" class="img-thumbnail" src="<?= base_url($fotokpe) ?>" /><br><span style="font-weight: bold; margin-left: 70px;"><?= $pegawai->pegawai_jabatan_kelas_nama ?></span></td>
                            </tr>
                            <tr>
                                <td nowrap>02</td>
                                <td nowrap>NIP Baru</td>
                                <td align="center" nowrap>:</td>
                                <td><?= $pegawai->pegawai_nip ?></td>
                            </tr>
                            <tr>
                                <td nowrap>03</td>
                                <td nowrap>Nama Pegawai</td>
                                <td align="center" nowrap>:</td>
                                <td><?= pegawai_nama_lengkap($pegawai) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>04</td>
                                <td nowrap>Tempat Lahir</td>
                                <td align="center" nowrap>:</td>
                                <td><?= $pegawai->pegawai_tempat_lahir ?></td>
                            </tr>
                            <tr>
                                <td nowrap>05</td>
                                <td nowrap>Tanggal Lahir</td>
                                <td align="center" nowrap>:</td>
                                <td><?= tgl($pegawai->pegawai_tgl_lahir) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>06</td>
                                <td nowrap>Jenis Kelamin</td>
                                <td align="center" nowrap>:</td>
                                <td><?= $pegawai->pegawai_jenkel_nama ?></td>
                            </tr>
                            <tr>
                                <td nowrap>07</td>
                                <td nowrap>Agama</td>
                                <td align="center" nowrap>:</td>
                                <td><?= $pegawai->pegawai_agama_nama ?></td>
                            </tr>
                            <tr>
                                <td nowrap>08</td>
                                <td nowrap>Status Pegawai</td>
                                <td align="center" nowrap>:</td>
                                <td><?= $pegawai->pegawai_status_kepegawaian_nama ?></td>
                            </tr>
                            <tr>
                                <td nowrap>09</td>
                                <td nowrap>Jenis Kepegawaian</td>
                                <td align="center" nowrap>:</td>
                                <td ><?= 'PNS DAERAH' ?></td>
                            </tr>
                            <tr>
                                <td nowrap>10</td>
                                <td nowrap>Status Perkawinan</td>
                                <td align="center" nowrap>:</td>
                                <td ><?= $pegawai->pegawai_statusperkawinan_nama ?></td>
                            </tr>
                            <tr>
                                <td nowrap>11</td>
                                <td nowrap>Kedudukan Pegawai</td>
                                <td align="center" nowrap>:</td>
                                <td ><?= $pegawai->pegawai_jenisjabatan_nama ?></td>
                            </tr>
                            <tr>
                                <td rowspan="4" valign="top" nowrap>12</td>
                                <td rowspan="4" valign="top" nowrap>Alamat Rumah</td>
                                <td rowspan="4" align="center" valign="top" nowrap>:</td>
                                <td >Jalan :
                                    <?= $pegawai->pegawai_alamat . ' RT ' . $pegawai->pegawai_rt . ' RW ' . $pegawai->pegawai_rw ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Desa / Kelurahan :
                                    <?= $pegawai->pegawai_kelurahan_nama ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Kecamatan :
                                    <?= $pegawai->pegawai_kecamatan_nama ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Kota / Kabupaten :
                                    <?= $pegawai->pegawai_kabupaten_nama ?></td>
                            </tr>
                            <tr>
                                <td nowrap>13</td>
                                <td nowrap>No. Telepon / HP</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_telpon . ' / ' . $pegawai->pegawai_hp ?></td>
                            </tr>
                            <tr>
                                <td nowrap>14</td>
                                <td nowrap>No. Karpeg</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_no_karpeg ?></td>
                            </tr>
                            <tr>
                                <td nowrap>15</td>
                                <td nowrap>No. ASKES / BPJS</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_no_askes ?></td>
                            </tr>
                            <tr>
                                <td nowrap>16</td>
                                <td nowrap>No. Kartu Taspen</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_no_taspen ?></td>
                            </tr>
                            <tr>
                                <td nowrap>17</td>
                                <td nowrap>No. Karis / Karsu</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_no_karis ?></td>
                            </tr>
                            <tr>
                                <td nowrap>18</td>
                                <td nowrap>NPWP</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_no_npwp ?></td>
                            </tr>
                            <tr>
                                <td nowrap>19</td>
                                <td nowrap>NIK</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_no_ktp ?></td>
                            </tr>
                            <tr>
                                <td nowrap>20</td>
                                <td nowrap>Email</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_email ?></td>
                            </tr>
                            <th colspan="5" style="text-align:center" bgcolor="#D6D6D6" scope="col">B. PENGANGKATAN SEBAGAI CPNS</th>
                            <?php
                            //        foreach ($pegawai_jabatan->result() as $value) {
                            //            if ($value->pegawaijabatan_kenaikan_id == 15) {
                            //                $cpns_tmt = $value->pegawaijabatan_tmt;
                            //                $cpns_sk_no = $value->pegawaijabatan_sk_no;
                            //                $cpns_sk_tgl = $value->pegawaijabatan_sk_tanggal;
                            //                $cpns_pejabat = $value->pegawaijabatan_pejabat;
                            //                $cpns_pangkat = $value->pangkat_nama . ', ' . $value->pangkat_kode;
                            //            }
                            //            if ($value->pegawaijabatan_kenaikan_id == 16) {
                            //                $pns_tmt = $value->pegawaijabatan_tmt;
                            //                $pns_sk_no = $value->pegawaijabatan_sk_no;
                            //                $pns_sk_tgl = $value->pegawaijabatan_sk_tanggal;
                            //                $pns_pejabat = $value->pegawaijabatan_pejabat;
                            //                $pns_pangkat = $value->pangkat_nama . ', ' . $value->pangkat_kode;
                            //            }
                            //        }
                            ?>
                            </tr>
                            <tr>
                                <td nowrap>01</td>
                                <td nowrap>Nomor Nota</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_cpns_nota ?></td>
                            </tr>
                            <tr>
                                <td nowrap>02</td>
                                <td nowrap>Tanggal Nota</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= tgl($pegawai->pegawai_cpns_date) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>03</td>
                                <td nowrap>Nomor SK CPNS</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_cpns_sk_no ?></td>
                            </tr>
                            <tr>
                                <td nowrap>04</td>
                                <td nowrap>Tanggal SK CPNS</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= tgl($pegawai->pegawai_cpns_sk_date) //tgl($pegawai->pegawai_cpns_sk_date)    
                                                ?></td>
                            </tr>
                            <tr>
                                <td nowrap>05</td>
                                <td nowrap>Pejabat Pengesah</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_cpns_pejabat //$pegawai->pegawai_cpns_pejabat    
                                                ?></td>
                            </tr>
                            <tr>
                                <td nowrap>06</td>
                                <td nowrap>TMT CPNS</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= tgl($pegawai->pegawai_cpns_tmt) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>07</td>
                                <td nowrap>Pangkat, Golongan/Ruang</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->cpns_pangkat ?></td>
                            </tr>
<!--                             <tr>
                                <td nowrap>08</td>
                                <td nowrap>TMT Honorer</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= tgl($pegawai->pegawai_cpns_tenaga_honor_tmt) ?></td>
                            </tr> -->
                            <tr>
                                <th colspan="5" style="text-align:center" bgcolor="#D6D6D6" scope="col">C. PENGANGKATAN SEBAGAI PNS</th>
                            </tr>
                            <tr>
                                <td nowrap>01</td>
                                <td nowrap>Nomor SK PNS</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_pns_sk_no ?></td>
                            </tr>
                            <tr>
                                <td nowrap>02</td>
                                <td nowrap>Tanggal SK PNS</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= tgl($pegawai->pegawai_pns_sk_date) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>03</td>
                                <td nowrap>Pejabat Pengesah</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_pns_pejabat ?></td>
                            </tr>
                            <tr>
                                <td nowrap>04</td>
                                <td nowrap>TMT PNS</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= tgl($pegawai->pegawai_pns_tmt) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>05</td>
                                <td nowrap>Pangkat, Golongan/Ruang</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pns_pangkat ?></td>
                            </tr>
                            <tr>
                                <td nowrap>06</td>
                                <td nowrap>Sumpah / Janji</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->kondisisumpah_nama ?></td>
                            </tr>
                            <tr>
                                <th colspan="5" style="text-align:center" bgcolor="#D6D6D6" scope="col">D. PANGKAT, GOLONGAN / RUANG TERAKHIR</th>
                            </tr>
                            <?php
                            //        $no = 1;
                            //        foreach ($pegawai_jabatan->result() as $value) {
                            //            if ($value->pegawaijabatan_kenaikan_id == 15 || $value->pegawaijabatan_kenaikan_id == 16) {
                            //                $terakhir_pangkat_nama = $value->pangkat_nama . ', ' . $value->pangkat_kode;
                            //                $terakhir_pangkat_kode = $value->pangkat_kode;
                            //                $terakhir_pangkat_kenaikan = $value->kenaikan_nama;
                            //                $terakhir_pangkat_tmt = tgl($value->pegawaijabatan_tmt);
                            //                $terakhir_pangkat_sk_tgl = tgl($value->pegawaijabatan_sk_tanggal);
                            //                $terakhir_pangkat_sk_no = $value->pegawaijabatan_sk_no;
                            //                $terakhir_pangkat_sk_pejabat = $value->pegawaijabatan_pejabat;
                            //                $terakhir_pangkat_masa_kerja = $value->pegawaijabatan_tahun . ' tahun' . $value->pegawaijabatan_bulan . ' bulan';
                            //                $terakhir_pangkat_angka_kredit = $value->pegawaijabatan_angka_kredit;
                            //                $terakhir_pangkat_gaji = rupiah($value->pegawaijabatan_gaji);
                            //                $terakhir_pangkat_jabatan = $value->nama_jabatan;
                            //                $terakhir_pangkat_unit = $value->UnitName;
                            //                $terakhir_pangkat_sub_unit = $value->sub_unit_name;
                            //            }
                            //        }
                            //        foreach ($riwayat_pangkat_golongan->result() as $value) {
                            //            $terakhir_pangkat_nama = $value->pangkat_nama . ', ' . $value->pangkat_kode;
                            //            $terakhir_pangkat_kode = $value->pangkat_kode;
                            //            $terakhir_pangkat_kenaikan = $value->kenaikan_nama;
                            //            $terakhir_pangkat_tmt = tgl($value->pegawaipangkat_tmt);
                            //            $terakhir_pangkat_sk_tgl = tgl($value->pegawaipangkat_sk_date);
                            //            $terakhir_pangkat_sk_no = $value->pegawaipangkat_sk_no;
                            //            $terakhir_pangkat_sk_pejabat = $value->pegawaipangkat_sk_pejabat;
                            //            $terakhir_pangkat_masa_kerja = $value->pegawaipangkat_masa_kerja_tahun . ' tahun' . $value->pegawaipangkat_masa_kerja_bulan . ' bulan';
                            //            $terakhir_pangkat_angka_kredit = $value->pegawaipangkat_angka_kredit;
                            //            $terakhir_pangkat_gaji = rupiah($value->pegawaipangkat_gaji_pokok);
                            //            $terakhir_pangkat_jabatan = $value->kedudukanjabatan_nama;
                            //            $terakhir_pangkat_unit = $value->UnitName;
                            //            $terakhir_pangkat_sub_unit = $value->sub_unit_name;
                            //        }
                            //        if (ignoreCase($terakhir_pangkat_kode) != ignoreCase($pegawai->pegawai_pangkat_nama_terbaru)) {
                            //            $terakhir_pangkat_nama = $pegawai->pegawai_pangkat_nama_terbaru;
                            //            $terakhir_pangkat_sk_no = $pegawai->pegawai_pangkat_terakhir_sk;
                            //            $terakhir_pangkat_sk_tgl = tgl($pegawai->pegawai_pangkat_terakhir_sk_tanggal);
                            //            $terakhir_pangkat_sk_pejabat = $pegawai->pegawai_pangkat_terakhir_pejabat;
                            //            $terakhir_pangkat_tmt = tgl($pegawai->pegawai_pangkat_terakhir_tmt);
                            //            $terakhir_pangkat_masa_kerja = $pegawai->pegawai_pangkat_terakhir_tahun . ' tahun ' . $pegawai->pegawai_pangkat_terakhir_bulan . ' bulan';
                            //        }
                            ?>
                            <tr>
                                <td nowrap>01</td>
                                <td nowrap>Nomor SK</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_pangkat_terakhir_sk ?></td>
                            </tr>
                            <tr>
                                <td nowrap>02</td>
                                <td nowrap>Tanggal SK</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= tgl_indo($pegawai->pegawai_pangkat_terakhir_sk_tgl) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>03</td>
                                <td nowrap>Pejabat Pengesah</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_pangkat_terakhir_pejabat ?></td>
                            </tr>
                            <tr>
                                <td nowrap>04</td>
                                <td>TMT Pangkat, Golongan/Ruang</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= tgl_indo($pegawai->pegawai_pangkat_terakhir_tmt) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>05</td>
                                <td nowrap>Pangkat, Golongan/Ruang</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_pangkat_terakhir_nama ?> <?= $pegawai->pegawai_pangkat_terakhir_golru ?></td>
                            </tr>
                            <tr>
                                <td nowrap>06</td>
                                <td nowrap>Masa Kerja</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?= $pegawai->pegawai_pangkat_terakhir_tahun . ' tahun ' . $pegawai->pegawai_pangkat_terakhir_bulan . ' bulan' ?></td>
                            </tr>
                            <tr>
                                <th colspan="5" style="text-align:center" bgcolor="#D6D6D6" scope="col">E. KENAIKAN GAJI BERKALA TERAKHIR</th>
                            </tr>
                            <tr>
                                <td nowrap>01</td>
                                <td nowrap>Nomor SK</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($kgb_terakhir)) echo $kgb_terakhir->pegawaikgb_sk_no; ?></td>
                            </tr>
                            <tr>
                                <td nowrap>02</td>
                                <td nowrap>Tanggal SK</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($kgb_terakhir)) echo tgl($kgb_terakhir->pegawaikgb_sk_tanggal) ?></td>
                            </tr>

                            <tr>
                                <td nowrap>04</td>
                                <td nowrap>TMT KGB</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($kgb_terakhir)) echo tgl($kgb_terakhir->pegawaikgb_tmt) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>05</td>
                                <td nowrap>Pangkat, Golongan/Ruang</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($kgb_terakhir)) echo $kgb_terakhir->pegawaikgb_pangkat_text ?></td>
                            </tr>
                            <tr>
                                <td nowrap>06</td>
                                <td nowrap>Masa Kerja</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($kgb_terakhir)) echo $kgb_terakhir->pegawaikgb_masa_kerja_tahun . ' tahun ' . $kgb_terakhir->pegawaikgb_masa_kerja_bulan . ' bulan' ?></td>
                            </tr>
                            <tr>
                                <td nowrap>07</td>
                                <td nowrap>Gaji Pokok</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($kgb_terakhir)) echo rupiah($kgb_terakhir->pegawaikgb_gaji) ?></td>
                            </tr>
                            <tr>
                                <th colspan="5" style="text-align:center" bgcolor="#D6D6D6" scope="col">F. JABATAN TERAKHIR</th>
                            </tr>
                            <tr>
                                <td nowrap>01</td>
                                <td nowrap>Nomor SK</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($jabatan_terakhir)) echo $jabatan_terakhir->pegawaijabatan_sk_no ?></td>
                            </tr>
                            <tr>
                                <td nowrap>02</td>
                                <td nowrap>Tanggal SK</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($jabatan_terakhir)) echo tgl($jabatan_terakhir->pegawaijabatan_sk_tanggal) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>03</td>
                                <td nowrap>Pejabat Pengesah</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($jabatan_terakhir)) echo $jabatan_terakhir->pegawaijabatan_pejabat ?></td>
                            </tr>
                            <tr>
                                <td nowrap>04</td>
                                <td nowrap>TMT Jabatan</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($jabatan_terakhir)) echo tgl($jabatan_terakhir->pegawaijabatan_tmt) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>05</td>
                                <td nowrap>Jabatan Terakhir</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($jabatan_terakhir)) echo $jabatan_terakhir->pegawaijabatan_jabatan_nama ?></td>
                            </tr>
                            <tr>
                                <td nowrap>06</td>
                                <td nowrap>Unit Kerja</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($jabatan_terakhir)) echo $jabatan_terakhir->pegawaijabatan_unit_kerja_nama ?></td>
                            </tr>
                            <tr>
                                <td nowrap>07</td>
                                <td nowrap>Eselon</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($jabatan_terakhir)) echo $jabatan_terakhir->pegawaijabatan_eselon_nama ?></td>
                            </tr>
                            <tr>
                                <th colspan="5" style="text-align:center" bgcolor="#D6D6D6" scope="col">G. PENDIDIKAN UMUM TERAKHIR</th>
                            </tr>

                            <tr>
                                <td nowrap>01</td>
                                <td nowrap>Tingkat</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($pendidikan_terakhir)) echo $pendidikan_terakhir->pegawaipendidikan_pendidikan_tingkat_nama ?></td>
                            </tr>
                            <tr>
                                <td nowrap>02</td>
                                <td nowrap>Nama Pendidikan</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($pendidikan_terakhir)) echo $pendidikan_terakhir->pegawaipendidikan_pendidikan_nama ?></td>
                            </tr>
                            <tr>
                                <td nowrap>03</td>
                                <td nowrap>Fakultas</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($pendidikan_terakhir)) echo $pendidikan_terakhir->pegawaipendidikan_rumpun_nama ?></td>
                            </tr>
<!--                             <tr>
                                <td nowrap>04</td>
                                <td nowrap>Jurusan / Prodi</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($pendidikan_terakhir)) echo $pendidikan_terakhir->pegawaipendidikan_jurusan_nama ?></td>
                            </tr>
                            <tr>
                                <td nowrap>05</td>
                                <td nowrap>Status Pendidikan</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($pendidikan_terakhir)) echo $pendidikan_terakhir->pegawaipendidikan_jenis ?></td>
                            </tr>
                            <tr>
                                <td nowrap>06</td>
                                <td nowrap>Tempat</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($pendidikan_terakhir)) echo $pendidikan_terakhir->pegawaipendidikan_tempat ?></td>
                            </tr> -->
                            <tr>
                                <td nowrap>07</td>
                                <td nowrap>Kasek/Rektor/Dir</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($pendidikan_terakhir)) echo $pendidikan_terakhir->pegawaipendidikan_nama_pimpinan ?></td>
                            </tr>
                            <tr>
                                <td nowrap>08</td>
                                <td nowrap>No. Ijazah</td>
                                <td align="center" nowrap>&nbsp;</td>
                                <td colspan="2"><?php if (!blank($pendidikan_terakhir)) echo $pendidikan_terakhir->pegawaipendidikan_nomor_ijazah ?></td>
                            </tr>
                            <tr>
                                <td nowrap>09</td>
                                <td nowrap>Tanggal Ijazah</td>
                                <td align="center" nowrap>&nbsp;</td>
                                <td colspan="2"><?php if (!blank($pendidikan_terakhir)) echo tgl($pendidikan_terakhir->pegawaipendidikan_tanggal_ijazah) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>10</td>
                                <td nowrap>Nilai</td>
                                <td align="center" nowrap>&nbsp;</td>
                                <td colspan="2"><?php if (!blank($pendidikan_terakhir)) echo $pendidikan_terakhir->pegawaipendidikan_nilai ?></td>
                            </tr>
                            <tr>
                                <th colspan="5" style="text-align:center" bgcolor="#D6D6D6" scope="col">H. DIKLAT PENJENJANGAN TERAKHIR</th>
                            </tr>

                            <tr>
                                <td nowrap>01</td>
                                <td nowrap>Tingkat</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($diklat_terakhir)) echo $diklat_terakhir->diklat_nama ?></td>
                            </tr>
                            <tr>
                                <td nowrap>02</td>
                                <td nowrap>Tempat</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($diklat_terakhir)) echo $diklat_terakhir->diklat_tempat ?></td>
                            </tr>
                            <tr>
                                <td nowrap>03</td>
                                <td nowrap>Penyelenggara</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($diklat_terakhir)) echo $diklat_terakhir->diklat_penyelenggara ?></td>
                            </tr>
                            <tr>
                                <td nowrap>04</td>
                                <td nowrap>Angkatan</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($diklat_terakhir)) echo $diklat_terakhir->diklat_angkatan ?></td>
                            </tr>
                            <tr>
                                <td nowrap>05</td>
                                <td nowrap>Tanggal Mulai</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($diklat_terakhir)) echo tgl($diklat_terakhir->diklat_tanggal_mulai) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>06</td>
                                <td nowrap>Tanggal Selesai</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($diklat_terakhir)) echo tgl($diklat_terakhir->diklat_tanggal_selesai) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>07</td>
                                <td nowrap>Jam</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($diklat_terakhir)) echo tgl($diklat_terakhir->diklat_jam) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>08</td>
                                <td nowrap>Hari</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($diklat_terakhir)) echo $diklat_terakhir->diklat_hari ?></td>
                            </tr>
                            <tr>
                                <td nowrap>09</td>
                                <td nowrap>Bulan</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($diklat_terakhir)) echo $diklat_terakhir->diklat_bulan ?></td>
                            </tr>
                            <tr>
                                <td nowrap>10</td>
                                <td nowrap>STPL No</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($diklat_terakhir)) echo $diklat_terakhir->diklat_sttpl_no ?></td>
                            </tr>
                            <tr>
                                <td nowrap>11</td>
                                <td nowrap>STPL Tanggal</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($diklat_terakhir)) echo tgl($diklat_terakhir->diklat_sttpl_tanggal) ?></td>
                            </tr>
                            <tr>
                                <td nowrap>12</td>
                                <td nowrap>Keterangan</td>
                                <td align="center" nowrap>:</td>
                                <td colspan="2"><?php if (!blank($diklat_terakhir)) echo $diklat_terakhir->diklat_keterangan ?></td>
                            </tr>


                        </table>
                    </div>

                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="13" style="text-align:center" bgcolor="#D6D6D6" scope="col">I. RIWAYAT KEPANGKATAN</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">PANGKAT, GOL/RUANG</th>
                                <th scope="col" style="text-align: center">JENIS KENAIKAN</th>
                                <th scope="col" style="text-align: center">TMT</th>
                                <th scope="col" style="text-align: center">TGL SK</th>
                                <th scope="col" style="text-align: center">NO SK</th>
                                <th scope="col" style="text-align: center">PEJABAT PENGESAH</th>
                                <th scope="col" style="text-align: center">MASA KERJA</th>
                                <th scope="col" style="text-align: center">JUMLAH KREDIT</th>
                                <th scope="col" style="text-align: center">GAJI POKOK</th>
<!--                                 <th>JABATAN</th> -->
<!--                                 <th>UNIT KERJA</th> -->
                            </tr>
                            <?php
                            $no = 1;

                            foreach ($pegawai_pangkat->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $value->pegawaipangkat_pangkat_nama ?>, <?= $value->pegawaipangkat_pangkat_golru ?></td>
                                    <td><?= $value->pegawaipangkat_kenaikan_nama ?></td>
                                    <td><?= tgl($value->pegawaipangkat_tmt) ?></td>
                                    <td><?= tgl($value->pegawaipangkat_sk_date) ?></td>
                                    <td><?= $value->pegawaipangkat_sk_no ?></td>
                                    <td><?= $value->pegawaipangkat_sk_pejabat ?></td>
                                    <td><?= $value->pegawaipangkat_masa_kerja_tahun ?> tahun <?= $value->pegawaipangkat_masa_kerja_bulan ?> bulan</td>
                                    <td><?= $value->pegawaipangkat_angka_kredit ?></td>
                                    <td><?= rupiah($value->pegawaipangkat_gaji_pokok) ?></td>
<!--                                     <td><?= $value->pegawaipangkat_jabatan_nama ?></td> -->
<!--                                     <td><?= $value->pegawaipangkat_unit_kerja_nama ?></td> -->
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>

                    <!-- START RIWAYAT JABATAN -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">J. RIWAYAT JABATAN</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">NAMA JABATAN, UNIT KERJA</th>
<!--                                 <th scope="col" style="text-align: center">JENIS PERUBAHAN JABATAN</th> -->
                                <th scope="col" style="text-align: center">ESELON</th>
<!--                                 <th scope="col" style="text-align: center">PANGKAT, GOL/RUANG</th> -->
<!--                                 <th scope="col" style="text-align: center">MASA KERJA</th> -->
                                <th scope="col" style="text-align: center">JUMLAH KREDIT</th>
                                <th scope="col" style="text-align: center">NO SK, TANGGAL SK, PEJABAT PENGESAH</th>
                                <th scope="col" style="text-align: center">TMT</th>
                                <th scope="col" style="text-align: center">TANGGAL PELANTIKAN</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($pegawai_jabatan->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $value->pegawaijabatan_jabatan_nama ?><br /> <?= $value->pegawaijabatan_unit_kerja_nama ?> </td>
<!--                                     <td><?= $value->pegawaijabatan_kenaikan_nama ?></td> -->
                                    <td><?= $value->pegawaijabatan_eselon_nama ?></td>
<!--                                     <td><?= $value->pegawaijabatan_pangkat_text ?></td> -->
<!--                                     <td><?= $value->pegawaijabatan_tahun . ' tahun ' . $value->pegawaijabatan_bulan . ' bulan' ?></td> -->
                                    <td><?= $value->pegawaijabatan_angka_kredit ?></td>
                                    <td><?= $value->pegawaijabatan_sk_no ?>, <?= tgl($value->pegawaijabatan_sk_tanggal) ?>, <?= $value->pegawaijabatan_pejabat ?></td>
                                    <td><?= tgl($value->pegawaijabatan_tmt) ?></td>
                                    <td><?= tgl($value->pegawaijabatan_tgl_pelantikan) ?></td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END RIWAYAT JABATAN -->

                    <!-- START RIWAYAT PENDIDIKAN -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">K. RIWAYAT PENDIDIKAN</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">TINGKAT</th>
                                <th scope="col" style="text-align: center">NAMA PENDIDIKAN<br>FAKULTAS<br>JURUSAN</th>
<!--                                 <th scope="col" style="text-align: center">TEMPAT</th> -->
                                <th scope="col" style="text-align: center">NOMOR IJAZAH<br>TANGGAL IJAZAH<br>NILAI</th>
<!--                                 <th scope="col" style="text-align: center">STATUS</th> -->
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($pegawai_pendidikan->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $value->pegawaipendidikan_pendidikan_tingkat_nama ?> </td>
                                    <td><?= $value->pegawaipendidikan_pendidikan_nama ?><br><?= $value->pegawaipendidikan_rumpun_nama ?><br><?= $value->pegawaipendidikan_jurusan_nama ?></td>
<!--                                     <td><?= $value->pegawaipendidikan_tempat ?></td> -->
                                    <td><?= $value->pegawaipendidikan_nomor_ijazah ?><br><?= tgl($value->pegawaipendidikan_tanggal_ijazah) ?><br><?= $value->pegawaipendidikan_nilai ?></td>
<!--                                     <td><?= $value->pegawaipendidikan_jenis ?></td> -->
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END RIWAYAT PENDIDIKAN -->

                    <!-- START RIWAYAT DIKLAT PENJENJANGAN -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">L. RIWAYAT DIKLAT PENJENJANGAN</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" rowspan="2" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">DIKLAT</th>
                                <th scope="col" style="text-align: center">TANGGAL</th>
                                <th scope="col" style="text-align: center">STPP</th>
                            </tr>
                            <tr style="text-align: center">
                                <th scope="col" style="text-align: center">NAMA <br>TEMPAT<br>PENYELENGGARA<br>ANGKATAN</th>
                                <th scope="col" style="text-align: center">MULAI<br>SELESAI<br>JML JAM, HARI, BULAN</th>
                                <th scope="col" style="text-align: center">NOMOR<br>TANGGAL<br>KETERANGAN</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($pegawai_diklat_penjenjangan->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?= $value->diklat_nama ?><br>
                                        <?= $value->diklat_tempat ?><br>
                                        <?= $value->diklat_penyelenggara ?><br>
                                        <?= $value->diklat_angkatan ?>
                                    </td>
                                    <td>
                                        <?= tgl($value->diklat_tanggal_mulai) ?><br>
                                        <?= tgl($value->diklat_tanggal_selesai) ?><br>
                                        <?= $value->diklat_jam ?> jam <br> <?= $value->diklat_hari ?> hari <br> <?= $value->diklat_bulan ?> bulan
                                    </td>
                                    <td>
                                        <?= $value->diklat_sttpl_no ?><br>
                                        <?= tgl($value->diklat_sttpl_tanggal) ?><br>
                                        <?= $value->diklat_keterangan ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END RIWAYAT PENJENJANGAN -->

                    <!-- START RIWAYAT DIKLAT FUNGSIONAL -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">M. RIWAYAT DIKLAT FUNGSIONAL</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" rowspan="2" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">DIKLAT</th>
                                <th scope="col" style="text-align: center">TANGGAL</th>
                                <th scope="col" style="text-align: center">STPP</th>
                            </tr>
                            <tr style="text-align: center">
                                <th scope="col" style="text-align: center">NAMA <br>TEMPAT<br>PENYELENGGARA<br>ANGKATAN</th>
                                <th scope="col" style="text-align: center">MULAI<br>SELESAI<br>JML JAM, HARI, BULAN</th>
                                <th scope="col" style="text-align: center">NOMOR<br>TANGGAL<br>KETERANGAN</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($pegawai_diklat_fungsional->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?= $value->diklat_nama ?><br>
                                        <?= $value->diklat_tempat ?><br>
                                        <?= $value->diklat_penyelenggara ?><br>
                                        <?= $value->diklat_angkatan ?>
                                    </td>
                                    <td>
                                        <?= tgl($value->diklat_tanggal_mulai) ?><br>
                                        <?= tgl($value->diklat_tanggal_selesai) ?><br>
                                        <?= $value->diklat_jam ?> jam <br> <?= $value->diklat_hari ?> hari <br> <?= $value->diklat_bulan ?> bulan
                                    </td>
                                    <td>
                                        <?= $value->diklat_sttpl_no ?><br>
                                        <?= tgl($value->diklat_sttpl_tanggal) ?><br>
                                        <?= $value->diklat_keterangan ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END RIWAYAT FUNGSIONAL -->

                    <!-- START RIWAYAT DIKLAT TEKNIS -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">N. RIWAYAT DIKLAT TEKNIS</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" rowspan="2" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">DIKLAT</th>
                                <th scope="col" style="text-align: center">TANGGAL</th>
                                <th scope="col" style="text-align: center">STPP</th>
                            </tr>
                            <tr style="text-align: center">
                                <th scope="col" style="text-align: center">NAMA <br>TEMPAT<br>PENYELENGGARA<br>ANGKATAN</th>
                                <th scope="col" style="text-align: center">MULAI<br>SELESAI<br>JML JAM, HARI, BULAN</th>
                                <th scope="col" style="text-align: center">NOMOR<br>TANGGAL<br>KETERANGAN</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($riwayat_diklat_teknis->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?= $value->diklat_nama ?><br>
                                        <?= $value->diklat_tempat ?><br>
                                        <?= $value->diklat_penyelenggara ?><br>
                                        <?= $value->diklat_angkatan ?>
                                    </td>
                                    <td>
                                        <?= tgl($value->diklat_tanggal_mulai) ?><br>
                                        <?= tgl($value->diklat_tanggal_selesai) ?><br>
                                        <?= $value->diklat_jam ?> jam <br> <?= $value->diklat_hari ?> hari <br> <?= $value->diklat_bulan ?> bulan
                                    </td>
                                    <td>
                                        <?= $value->diklat_sttpl_no ?><br>
                                        <?= tgl($value->diklat_sttpl_tanggal) ?><br>
                                        <?= $value->diklat_keterangan ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END RIWAYAT TEKNIS -->

                    <!-- START RIWAYAT DIKLAT PENATARAN -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">O. RIWAYAT PENATARAN</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" rowspan="2" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">DIKLAT</th>
                                <th scope="col" style="text-align: center">TANGGAL</th>
                                <th scope="col" style="text-align: center">STPP</th>
                            </tr>
                            <tr style="text-align: center">
                                <th scope="col" style="text-align: center">NAMA <br>TEMPAT<br>PENYELENGGARA<br>ANGKATAN</th>
                                <th scope="col" style="text-align: center">MULAI<br>SELESAI<br>JML JAM, HARI, BULAN</th>
                                <th scope="col" style="text-align: center">NOMOR<br>TANGGAL<br>KETERANGAN</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($riwayat_diklat_penataran->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?= $value->diklat_nama ?><br>
                                        <?= $value->diklat_tempat ?><br>
                                        <?= $value->diklat_penyelenggara ?><br>
                                        <?= $value->diklat_angkatan ?>
                                    </td>
                                    <td>
                                        <?= tgl($value->diklat_tanggal_mulai) ?><br>
                                        <?= tgl($value->diklat_tanggal_selesai) ?><br>
                                        <?= $value->diklat_jam ?> jam <br> <?= $value->diklat_hari ?> hari <br> <?= $value->diklat_bulan ?> bulan
                                    </td>
                                    <td>
                                        <?= $value->diklat_sttpl_no ?><br>
                                        <?= tgl($value->diklat_sttpl_tanggal) ?><br>
                                        <?= $value->diklat_keterangan ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END RIWAYAT PENATARAN -->

                    <!-- START RIWAYAT DIKLAT SEMINAR -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">P. RIWAYAT SEMINAR / LOKAKARYA / SIMPOSIUM</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" rowspan="2" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">DIKLAT</th>
                                <th scope="col" style="text-align: center">TANGGAL</th>
                                <th scope="col" style="text-align: center">STPP</th>
                            </tr>
                            <tr style="text-align: center">
                                <th scope="col" style="text-align: center">NAMA <br>TEMPAT<br>PENYELENGGARA<br>ANGKATAN</th>
                                <th scope="col" style="text-align: center">MULAI<br>SELESAI<br>JML JAM, HARI, BULAN</th>
                                <th scope="col" style="text-align: center">NOMOR<br>TANGGAL<br>KETERANGAN</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($riwayat_diklat_seminar->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?= $value->diklat_nama ?><br>
                                        <?= $value->diklat_tempat ?><br>
                                        <?= $value->diklat_penyelenggara ?><br>
                                        <?= $value->diklat_angkatan ?>
                                    </td>
                                    <td>
                                        <?= tgl($value->diklat_tanggal_mulai) ?><br>
                                        <?= tgl($value->diklat_tanggal_selesai) ?><br>
                                        <?= $value->diklat_jam ?> jam <br> <?= $value->diklat_hari ?> hari <br> <?= $value->diklat_bulan ?> bulan
                                    </td>
                                    <td>
                                        <?= $value->diklat_sttpl_no ?><br>
                                        <?= tgl($value->diklat_sttpl_tanggal) ?><br>
                                        <?= $value->diklat_keterangan ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END RIWAYAT SEMINAR -->

                    <!-- START RIWAYAT DIKLAT KURSUS -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">Q. RIWAYAT KURSUS KE LUAR NEGERI</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" rowspan="2" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">DIKLAT</th>
                                <th scope="col" style="text-align: center">TANGGAL</th>
                                <th scope="col" style="text-align: center">STPP</th>
                            </tr>
                            <tr style="text-align: center">
                                <th scope="col" style="text-align: center">NAMA <br>TEMPAT<br>PENYELENGGARA<br>ANGKATAN</th>
                                <th scope="col" style="text-align: center">MULAI<br>SELESAI<br>JML JAM, HARI, BULAN</th>
                                <th scope="col" style="text-align: center">NOMOR<br>TANGGAL<br>KETERANGAN</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($riwayat_diklat_kursus->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?= $value->diklat_nama ?><br>
                                        <?= $value->diklat_tempat ?><br>
                                        <?= $value->diklat_penyelenggara ?><br>
                                        <?= $value->diklat_angkatan ?>
                                    </td>
                                    <td>
                                        <?= tgl($value->diklat_tanggal_mulai) ?><br>
                                        <?= tgl($value->diklat_tanggal_selesai) ?><br>
                                        <?= $value->diklat_jam ?> jam <br> <?= $value->diklat_hari ?> hari <br> <?= $value->diklat_bulan ?> bulan
                                    </td>
                                    <td>
                                        <?= $value->diklat_sttpl_no ?><br>
                                        <?= tgl($value->diklat_sttpl_tanggal) ?><br>
                                        <?= $value->diklat_keterangan ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END RIWAYAT KURSUS -->

                    <!-- START RIWAYAT TANDA JASA PENGHARGAAN -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">R. TANDA JASA / PENGHARGAAN / SATYA LENCANA</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">NAMA PENGHARGAAN</th>
                                <th scope="col" style="text-align: center">NOMOR SK, TANGGAL</th>
                                <th scope="col" style="text-align: center">TAHUN</th>
                                <th scope="col" style="text-align: center">ASAL</th>
                            </tr>

                            <?php
                            $no = 1;
                            foreach ($riwayat_penghargaan->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?= $value->pegawaijasa_nama ?>

                                    </td>
                                    <td>
                                        <?= $value->pegawaijasa_nomor ?>,
                                        <?= tgl($value->pegawaijasa_tanggal) ?>
                                    </td>
                                    <td>
                                        <?= $value->pegawaijasa_tahun ?>
                                    </td>
                                    <td><?= $value->pegawaijasa_asal ?></td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END RIWAYAT TANDA JASA -->

                    <!-- START RIWAYAT KUNJUNGAN -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">S. PENGALAMAN KUNJUNGAN KE LUAR NEGERI</th>
                            </tr>
                            <tr>
                                <th width="3%" nowrap rowspan="2" style="text-align: center">NO</th>
                                <th rowspan="2" style="text-align: center">NEGARA TUJUAN</th>
                                <th rowspan="2" style="text-align: center">JENIS PENUGASAN</th>
                                <th rowspan="2" style="text-align: center">KETERANGAN</th>
                                <th colspan="2" style="text-align: center">SURAT PENUGASAN</th>
                                <th rowspan="2" style="text-align: center">TANGGAL</th>
                                <th colspan="2" style="text-align: center">LAMA PENUGASAN</th>

                            </tr>
                            <tr>
                                <th style="text-align: center">YANG MENETAPKAN</th>
                                <th style="text-align: center">NOMOR SK</th>
                                <th style="width:130px;">TGL. MULAI</th>
                                <th style="width:130px;">TGL. SELESAI</th>
                            </tr>

                            <?php
                            $no = 1;
                            foreach ($riwayat_penugasan->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $value->pegawaitugas_tujuan ?></td>
                                    <td><?= $value->pegawaitugas_jenispenugasan_nama ?></td>
                                    <td><?= $value->pegawaitugas_keterangan ?></td>
                                    <td><?= $value->pegawaitugas_pejabat ?></td>
                                    <td><?= $value->pegawaitugas_nomor ?></td>
                                    <td><?= tgl($value->pegawaitugas_tgl) ?></td>
                                    <td><?= tgl($value->pegawaitugas_mulai) ?></td>
                                    <td><?= tgl($value->pegawaitugas_akhir) ?></td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END RIWAYAT KUNJUNGAN -->

                    <!-- START RIWAYAT ORGANISASI -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">T. KEANGGOTAAN ORGANISASI</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">JENIS ORGANISASI</th>
                                <th scope="col" style="text-align: center">NAMA ORGANISASI</th>
                                <th scope="col" style="text-align: center">JABATAN</th>
                                <th scope="col" style="text-align: center">TANGGAL MULAI, SELESAI</th>
                                <th scope="col" style="text-align: center">TEMPAT</th>
                            </tr>

                            <?php
                            $no = 1;
                            foreach ($riwayat_organisasi->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $value->pegawaiorg_jenisorganisasi_nama ?></td>
                                    <td><?= $value->pegawaiorg_organisasi ?></td>
                                    <td><?= $value->pegawaiorg_jabatan ?></td>
                                    <td>
                                        <?= tgl($value->pegawaiorg_mulai) ?>,
                                        <?= tgl($value->pegawaiorg_selesai) ?>
                                    </td>
                                    <td>
                                        <?= $value->pegawaiorg_alamat ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END RIWAYAT ORGANISASI -->

                    <!-- START PENGALAMAN KERJA -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="5" style="text-align:center" bgcolor="#D6D6D6" scope="col">U. PENGALAMAN KERJA</th>
                            </tr>
                            <tr>
                                <th width="3%" nowrap>No</th>
                                <th>Instansi</th>
                                <th>Jabatan</th>
                                <th>Tahun</th>
                                <th>Bulan</th>
                            </tr>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($riwayat_pengalaman_kerja->result() as $value) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->pegawaikerja_nama ?></td>
                                        <td><?= $value->pegawaikerja_jabatan ?></td>
                                        <td><?= $value->pegawaikerja_tahun ?></td>
                                        <td><?= $value->pegawaikerja_bulan ?></td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- END PENGUASAAN BAHASA -->

                    <!-- START PENGUASAAN BAHASA -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="3" style="text-align:center" bgcolor="#D6D6D6" scope="col">V. PENGUASAAN BAHASA</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">NAMA BAHASA</th>
                                <th scope="col" style="text-align: center">KEMAMPUAN</th>
                            </tr>

                            <?php
                            $no = 1;
                            foreach ($riwayat_penguasaan_bahasa->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $value->pegawaibahasa_bahasa_nama ?></td>
                                    <td><?= $value->pegawaibahasa_status ?></td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END PENGUASAAN BAHASA -->

                    <!-- START RIWAYAT TUGAS BELAJAR -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">W. IZIN / TUGAS BELAJAR / UJIAN DINAS</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">NOMOR<br>TANGGAL<br>MULAI, SELESAI</th>
                                <th scope="col" style="text-align: center">PEJABAT PENGESAH</th>
                                <th scope="col" style="text-align: center">TINGKAT</th>
                                <th scope="col" style="text-align: center">NAMA PENDIDIKAN<br>FAKULTAS<br>JURUSAN</th>
                                <th scope="col" style="text-align: center">KETERANGAN</th>
                            </tr>

                            <?php
                            $no = 1;
                            foreach ($riwayat_tugas_belajar->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?= $value->tugasbelajar_no_sk ?><br>
                                        <?= tgl($value->tugasbelajar_tanggal_sk) ?><br>
                                        <?= tgl($value->tugasbelajar_mulai) ?><br>
                                        <?= tgl($value->tugasbelajar_selesai) ?>
                                    </td>
                                    <td><?= $value->tugasbelajar_pejabat ?></td>
                                    <td><?= $value->tugasbelajar_pendidikan_tingkat_nama ?></td>
                                    <td>
                                        <?= $value->tugasbelajar_pendidikan_nama ?><br>
                                        <?= $value->tugasbelajar_nama_pendidikan ?><br>
                                        <?= $value->tugasbelajar_jurusan_nama ?>
                                    </td>
                                    <td>
                                        <?= $value->tugasbelajar_keterangan ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END RIWAYAT TUGAS BELAJAR -->

                    <!-- START RIWAYAT HUKUMAN DISIPLIN -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">X. RIWAYAT SANKSI ADMINISTRATIF</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">HUKUMAN<br>TINGKAT</th>
                                <th scope="col" style="text-align: center">NOMOR<br>TANGGAL<br>MULAI<br>SELESAI</th>
                                <th scope="col" style="text-align: center">PEJABAT PENGESAH</th>
                                <th scope="col" style="text-align: center">KETERANGAN</th>
                            </tr>

                            <?php
                            $no = 1;
                            foreach ($riwayat_hukuman->result() as $value) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?= $value->pegawaidisiplin_jenishukuman_nama ?><br>
                                        <?= '' ?>
                                    </td>
                                    <td>
                                        <?= $value->pegawaidisiplin_no_sk ?><br>
                                        <?= tgl($value->pegawaidisiplin_tanggal) ?><br>
                                        <?= tgl($value->pegawaidisiplin_mulai) ?><br>
                                        <?= tgl($value->pegawaidisiplin_selesai) ?>
                                    </td>
                                    <td><?= $value->pegawaidisiplin_pejabat ?></td>
                                    <td>
                                        <?= $value->pegawaidisiplin_keterangan ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- END RIWAYAT HUKUMAN -->



                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">Y. DATA SUAMI / ISTERI</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">NAMA</th>
                                <th scope="col" style="text-align: center">STATUS KELUARGA</th>
                                <th scope="col" style="text-align: center">TEMPAT, TGL LAHIR</th>
                                <th scope="col" style="text-align: center">TINGKAT PENDIDIKAN</th>
                                <th scope="col" style="text-align: center">STATUS PERKAWINAN</th>
                                <th scope="col" style="text-align: center">TANGGAL PERNIKAHAN</th>
                                <th scope="col" style="text-align: center">PEKERJAAN</th>
                                <th scope="col" style="text-align: center">NIP/NRP</th>
<!--                                 <th scope="col" style="text-align: center">STATUS TUNJANGAN</th> -->
                                <th scope="col" style="text-align: center">KET</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($keluarga->result() as $value) {
                                if ($value->pegawaikeluarga_status_keluarga_id > 20 && $value->pegawaikeluarga_status_keluarga_id < 30) {
                            ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->pegawaikeluarga_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_status_keluarga_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_tempat_lahir ?>, <?= tgl($value->pegawaikeluarga_tanggal_lahir) ?></td>
                                        <td><?= $value->pegawaikeluarga_pendidikan_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_status_perkawinan_nama ?></td>
                                        <td><?= tgl($value->pegawaikeluarga_tanggal_menikah) ?></td>
                                        <td><?= $value->pegawaikeluarga_pekerjaan ?></td>
                                        <td><?= $value->pegawaikeluarga_nip_nrp ?></td>
<!--                                         <td><?= $value->pegawaikeluarga_status_tunjangan ?></td> -->
                                        <td><?= $value->pegawaikeluarga_keterangan ?></td>
                                    </tr>
                            <?php
                                    $no++;
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">Z. DATA ANAK</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">NAMA</th>
                                <th scope="col" style="text-align: center">STATUS KELUARGA</th>
                                <th scope="col" style="text-align: center">TEMPAT, TGL LAHIR</th>
                                <th scope="col" style="text-align: center">TINGKAT PENDIDIKAN</th>
                                <th scope="col" style="text-align: center">STATUS PERKAWINAN</th>
                                <th scope="col" style="text-align: center">TANGGAL PERNIKAHAN</th>
                                <th scope="col" style="text-align: center">PEKERJAAN</th>
                                <th scope="col" style="text-align: center">NIP/NRP</th>
<!--                                 <th scope="col" style="text-align: center">STATUS TUNJANGAN</th> -->
                                <th scope="col" style="text-align: center">KET</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($keluarga->result() as $value) {
                                if ($value->pegawaikeluarga_status_keluarga_id > 30 && $value->pegawaikeluarga_status_keluarga_id < 40) {
                            ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->pegawaikeluarga_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_status_keluarga_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_tempat_lahir ?>, <?= tgl($value->pegawaikeluarga_tanggal_lahir) ?></td>
                                        <td><?= $value->pegawaikeluarga_pendidikan_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_status_perkawinan_nama ?></td>
                                        <td><?= tgl($value->pegawaikeluarga_tanggal_menikah) ?></td>
                                        <td><?= $value->pegawaikeluarga_pekerjaan ?></td>
                                        <td><?= $value->pegawaikeluarga_nip_nrp ?></td>
                                        <td><?= $value->pegawaikeluarga_keterangan ?></td>
                                    </tr>
                            <?php
                                    $no++;
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <!-- <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">AA. DATA SAUDARA</th>
                            </tr>
                            <tr style="text-align: center">
                                <th width="3%" nowrap scope="col" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">NAMA</th>
                                <th scope="col" style="text-align: center">STATUS KELUARGA</th>
                                <th scope="col" style="text-align: center">TEMPAT, TGL LAHIR</th>
                                <th scope="col" style="text-align: center">TINGKAT PENDIDIKAN</th>
                                <th scope="col" style="text-align: center">STATUS PERKAWINAN</th>
                                <th scope="col" style="text-align: center">TANGGAL PERNIKAHAN</th>
                                <th scope="col" style="text-align: center">PEKERJAAN</th>
                                <th scope="col" style="text-align: center">NIP/NRP</th>
                                <th scope="col" style="text-align: center">STATUS TUNJANGAN</th>
                                <th scope="col" style="text-align: center">KET</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($keluarga->result() as $value) {
                                if ($value->pegawaikeluarga_status_keluarga_id > 40 && $value->pegawaikeluarga_status_keluarga_id < 50) {
                            ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->pegawaikeluarga_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_status_keluarga_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_tempat_lahir ?>, <?= tgl($value->pegawaikeluarga_tanggal_lahir) ?></td>
                                        <td><?= $value->pegawaikeluarga_pendidikan_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_status_perkawinan_nama ?></td>
                                        <td><?= tgl($value->pegawaikeluarga_tanggal_menikah) ?></td>
                                        <td><?= $value->pegawaikeluarga_pekerjaan ?></td>
                                        <td><?= $value->pegawaikeluarga_nip_nrp ?></td>
                                        <td><?= $value->pegawaikeluarga_keterangan ?></td>
                                    </tr>
                            <?php
                                    $no++;
                                }
                            }
                            ?>
                        </table>
                    </div> -->
                    <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">AA. DATA ORANG TUA KANDUNG</th>
                            </tr>
                            <tr>
                                <th width="3%" nowrap scope="col" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">NAMA</th>
                                <th scope="col" style="text-align: center">STATUS KELUARGA</th>
                                <th scope="col" style="text-align: center">TEMPAT, TGL LAHIR</th>
                                <th scope="col" style="text-align: center">TINGKAT PENDIDIKAN</th>
                                <th scope="col" style="text-align: center">STATUS PERKAWINAN</th>
                                <th scope="col" style="text-align: center">TANGGAL PERNIKAHAN</th>
                                <th scope="col" style="text-align: center">PEKERJAAN</th>
                                <th scope="col" style="text-align: center">NIP/NRP</th>
<!--                                 <th scope="col" style="text-align: center">STATUS TUNJANGAN</th> -->
                                <th scope="col" style="text-align: center">KET</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($keluarga->result() as $value) {
                                if ($value->pegawaikeluarga_status_keluarga_id > 10 && $value->pegawaikeluarga_status_keluarga_id < 20) {
                            ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->pegawaikeluarga_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_status_keluarga_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_tempat_lahir ?>, <?= tgl($value->pegawaikeluarga_tanggal_lahir) ?></td>
                                        <td><?= $value->pegawaikeluarga_pendidikan_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_status_perkawinan_nama ?></td>
                                        <td><?= tgl($value->pegawaikeluarga_tanggal_menikah) ?></td>
                                        <td><?= $value->pegawaikeluarga_pekerjaan ?></td>
                                        <td><?= $value->pegawaikeluarga_nip_nrp ?></td>
                                        <td><?= $value->pegawaikeluarga_keterangan ?></td>
                                    </tr>
                            <?php
                                    $no++;
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <!-- <div class="panel panel-default">
                        <table width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="11" style="text-align:center" bgcolor="#D6D6D6" scope="col">AC. DATA MERTUA</th>
                            </tr>
                            <tr>
                                <th width="3%" nowrap scope="col" style="text-align: center">NO</th>
                                <th scope="col" style="text-align: center">NAMA</th>
                                <th scope="col" style="text-align: center">STATUS KELUARGA</th>
                                <th scope="col" style="text-align: center">TEMPAT, TGL LAHIR</th>
                                <th scope="col" style="text-align: center">TINGKAT PENDIDIKAN</th>
                                <th scope="col" style="text-align: center">STATUS PERKAWINAN</th>
                                <th scope="col" style="text-align: center">TANGGAL PERNIKAHAN</th>
                                <th scope="col" style="text-align: center">PEKERJAAN</th>
                                <th scope="col" style="text-align: center">NIP/NRP</th>
                                <th scope="col" style="text-align: center">STATUS TUNJANGAN</th>
                                <th scope="col" style="text-align: center">KET</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($keluarga->result() as $value) {
                                if ($value->pegawaikeluarga_status_keluarga_id > 50 && $value->pegawaikeluarga_status_keluarga_id < 60) {
                            ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->pegawaikeluarga_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_status_keluarga_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_tempat_lahir ?>, <?= tgl($value->pegawaikeluarga_tanggal_lahir) ?></td>
                                        <td><?= $value->pegawaikeluarga_pendidikan_nama ?></td>
                                        <td><?= $value->pegawaikeluarga_status_perkawinan_nama ?></td>
                                        <td><?= tgl($value->pegawaikeluarga_tanggal_menikah) ?></td>
                                        <td><?= $value->pegawaikeluarga_pekerjaan ?></td>
                                        <td><?= $value->pegawaikeluarga_nip_nrp ?></td>
                                        <td><?= $value->pegawaikeluarga_keterangan ?></td>
                                    </tr>
                            <?php
                                    $no++;
                                }
                            }
                            ?>

                        </table>
                    </div> -->
                </div>
            </div>

        </div>

    </section>
</div>

<script>
    function cetak() {
        var content = document.getElementById("table_identitas").innerHTML;
        var mywindow = window.open('', 'Print', 'height = 600, width = 800');

        mywindow.document.write('<html><head><title>Simpeg</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(content);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus()
        mywindow.print();
        //mywindow.close();
        //return true;
    }

	$("#btn_excel").click(function(e) {   
   // window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#target_print').html())); // content is the id of the DIV element  
   //getting values of current time for generating the file name
        var dt = new Date();
        var day = dt.getDate();
        var month = dt.getMonth() + 1;
        var year = dt.getFullYear();
        var hour = dt.getHours();
        var mins = dt.getMinutes();
        var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
        //creating a temporary HTML link element (they support setting file names)
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        // var table_div = document.getElementById('target_print');
        var table_html = encodeURIComponent($('#table_identitas').html());
        a.href = data_type + ', ' + table_html;
        //setting the file name
        a.download = '<?= $pegawai->pegawai_nip ?>' + postfix + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
    e.preventDefault();   
});   
</script>