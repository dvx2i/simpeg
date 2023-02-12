<?php 

$nama = '';
if (!empty($pegawai->pegawai_gelar_depan)) {
 $nama .= $pegawai->pegawai_gelar_depan . '. ';
}
$nama .= ucwords(strtoupper($pegawai->pegawai_nama));
if (!empty($pegawai->pegawai_gelar_belakang)) {
 $nama .= ', ' . $pegawai->pegawai_gelar_belakang;
}

?>

<table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td style="width: 58.367%; text-align: center;">
<table>
<tbody>
<tr>
<td>
<p style="font-size: 10px; text-align: center;"><img src="<?= encode_img_base64('assets/images/icon.png','png') ?>" width="155" height="187" /></p>
</td>
<td>
<p style="font-size: 10px; text-align: center;">PEMERINTAH KABUPATEN SANGGAU</p>
<p style="text-align: center;">BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</p>
<p style="font-size: 10px;text-align: center;">Jln. KH. Dewantara No. 35 Sanggau ( 75812)</p>
<p style="font-size: 10px;text-align: center;">Telpon ( 0564 ) 21193 Fax ( 0564 ) 23801 e-mail : <a href="mailto:bkpsdm@sanggau.go.id">bkpsdm@sanggau.com</a></p>
<p style="font-size: 10px;text-align: center;">Website : http://bkpsdm.sanggau.go.id</p>
</td>
</tr>
</tbody>
</table>
</td>
<td style="width: 19.758%; text-align: center;">
<p style="font-size: 12px;">Lembar Untuk :<br /><strong>Pemohon</strong> <br />Dicetak Tanggal :<br /><strong> <?= $tgl_surat ?></strong> <br />Nomor Permohonan :<br /><strong> <?= $no_permohonan ?> </strong></p>
</td>
</tr>
</tbody>
</table>
<p style="text-align: center;"><strong>BUKTI PERMOHONAN MUTASI</strong></p>
<table style="width: 100%; border-collapse: collapse;">
<tbody>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Nama</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $nama ?></td>
</tr>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Nomor Induk Pegawai</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $pegawai->pegawai_nip;  ?></td>
</tr>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Pangkat / Jabatan</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $pegawai->pegawai_pangkat_terakhir_nama.' / '.$pegawai->pegawai_jabatan_nama;  ?></td>
</tr>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Golongan</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $pegawai->pegawai_pangkat_terakhir_golru;  ?></td>
</tr>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Kantor / Tempat Kerja</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $pegawai->pegawai_unit_nama;  ?></td>
</tr>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Jenis Mutasi</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $usulan_jenis == '2' ? 'Antar Instansi' : 'Keluar Kabupaten / Kota' ?></td>
</tr>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Tujuan Mutasi</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $usulan_jenis == '2' ? $nama_unit_tujuan : $nama_propinsi.', '.$nama_kabupaten ?></td>
</tr>
</tbody>
</table>
<p style="padding-left: 40px; font-size: 12px;">Pemohon datang ke Kantor Badan Kepegawaian dan Pengembangan Sumber Daya Manusia untuk proses penyerahan berkas.</p>
<hr />
<table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td style="width: 58.367%; text-align: center;">
<table>
<tbody>
<tr>
<td>
<p style="font-size: 10px; text-align: center;"><img src="<?= encode_img_base64('assets/images/icon.png','png') ?>" width="155" height="187" /></p>
</td>
<td>
<p style="font-size: 10px; text-align: center;">PEMERINTAH KABUPATEN SANGGAU</p>
<p style="text-align: center;">BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</p>
<p style="font-size: 10px;text-align: center;">Jln. KH. Dewantara No. 35 Sanggau ( 75812)</p>
<p style="font-size: 10px;text-align: center;">Telpon ( 0564 ) 21193 Fax ( 0564 ) 23801 e-mail : <a href="mailto:bkpsdm@sanggau.go.id">bkpsdm@sanggau.com</a></p>
<p style="font-size: 10px;text-align: center;">Website : http://bkpsdm.sanggau.go.id</p>
</td>
</tr>
</tbody>
</table>
</td>
<td style="width: 19.758%; text-align: center;">
<p style="font-size: 12px;">Lembar Untuk :<br /><strong>Petugas</strong> <br />Dicetak Tanggal :<br /><strong> <?= $tgl_surat ?></strong> <br />Nomor Permohonan :<br /><strong> <?= $no_permohonan ?> </strong></p>
</td>
</tr>
</tbody>
</table>
<p style="text-align: center;"><strong>BUKTI PERMOHONAN MUTASI</strong></p>
<table style="width: 100%; border-collapse: collapse;">
<tbody>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Nama</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $nama ?></td>
</tr>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Nomor Induk Pegawai</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $pegawai->pegawai_nip;  ?></td>
</tr>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Pangkat / Jabatan</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $pegawai->pegawai_pangkat_terakhir_nama.' / '.$pegawai->pegawai_jabatan_nama;  ?></td>
</tr>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Golongan</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $pegawai->pegawai_pangkat_terakhir_golru;  ?></td>
</tr>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Kantor / Tempat Kerja</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $pegawai->pegawai_unit_nama;  ?></td>
</tr>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Jenis Mutasi</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $usulan_jenis == '2' ? 'Antar Instansi' : 'Keluar Kabupaten / Kota' ?></td>
</tr>
<tr>
<td style="width: 41.2009%; padding-left: 40px; font-size: 12px;">Tujuan Mutasi</td>
<td style="width: 2.82258%; font-size: 12px;">:</td>
<td style="width: 68.1286%; font-size: 12px;"><?= $usulan_jenis == '2' ? $nama_unit_tujuan : $nama_propinsi.', '.$nama_kabupaten ?></td>
</tr>
</tbody>
</table>
<p style="padding-left: 40px; font-size: 12px;">Pemohon datang ke Kantor Badan Kepegawaian dan Pengembangan Sumber Daya Manusia untuk proses penyerahan berkas.</p>