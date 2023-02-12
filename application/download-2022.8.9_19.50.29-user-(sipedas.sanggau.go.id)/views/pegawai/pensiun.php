<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            List Pegawai Pensiun
        </h1>
    </section>


    <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Pangkat / Golru</th>
                                    <th>Jabatan</th>
                                    <th>OPD/Unit Kerja</th>
                                    <th>Jenis Pensiun</th>
                                    <th>TMT Pensiun</th>
                                    <th>Administrator</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($result->result() as $value) {
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->pegawai_nip ?></td>
                                        <td><?= $value->pegawai_nama ?></td>
                                        <td><?= $value->pegawai_pangkat_terakhir_nama.'<br/> ( '.$value->pegawai_pangkat_terakhir_golru .' )' ?></td>
                                        <td><?= $value->pegawai_jabatan_nama != 0 ? $value->pegawai_jabatan_nama : ''; ?></td>
                                        <td><?= $value->pegawai_unit_nama ?></td>
                                        <td><?= $value->jenis_pensiun_nama ?> <?= $value->pegawai_jabatan_prov_kab_kota != null ? 'PINDAH INSTANSI KERJA ('.$value->pegawai_jabatan_prov_kab_kota.')' : '' ?> <br> <?= $value->pegawai_pensiun_tmt != NULL ? '('.tgl_indo($value->pegawai_pensiun_tanggal).')' : '' ?></td>
                                    	<td><?= $value->pegawai_jenis_pensiun_nama == 'Pindah Instansi Kerja' ? tgl_indo($value->pegawai_jabatan_tmt) : tgl_indo($value->pegawai_pensiun_tmt); ?></td>
                                        <td>
                                            
                                            <a href="<?= site_url('pegawai/Pensiun/delete/' . $value->pegawai_nip) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menjadikan Pegawai Aktif Kembali.?')"><i class="fa fa-trash-o fa-fw"></i> Batal Pensiun</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
