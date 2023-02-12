<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            List Jabatan Fungsional
        </h1>
    </section>


    <section class="content">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Jabatan</a>
        <br />
        <br />
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
                                    <th>Nama Jabatan</th>
                                    <th>Golru Awal</th>
                                    <th>Golru Akhir</th>
                                    <th>Tunjangan</th>
                                    <th>Tingkat Pendidikan</th>
                                    <th>AK</th>
                                    <th>BUP</th>
                                    <th>Administrator</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($result as $value) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->jabatan_nama ?></td>
                                        <td><?= $value->jabatan_golru_awal_nama ?></td>
                                        <td><?= $value->jabatan_golru_akhir_nama ?></td>
                                        <td><?= $value->jabatan_tunjangan ?></td>
                                        <td><?= $value->jabatan_pendidikan_nama ?></td>
                                        <td><?= $value->jabatan_angka_kredit ?></td>
                                        <td><?= $value->jabatan_usia_pensiun ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" type="button" onclick="editf('<?= $value->jabatan_id ?>', '<?= $value->jabatan_kode ?>', '<?= $value->jabatan_nama ?>', '<?= $value->jabatan_golru_awal ?>', '<?= $value->jabatan_golru_akhir ?>', '<?= $value->jabatan_tunjangan ?>', '<?= $value->jabatan_pendidikan_kode ?>', '<?= $value->jabatan_angka_kredit ?>', '<?= $value->jabatan_usia_pensiun ?>')" data-toggle="modal" data-target="#modal-update"><i class="fa fa-edit"></i></a>
                                            <a href="<?= site_url('referensi/JabatanFungsional/delete/' . $value->jabatan_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data.?')"><i class="fa fa-trash-o fa-fw"></i></a>
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

<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?= site_url('referensi/JabatanFungsional/add') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Jabatan</h4>
                </div>
                <div class="modal-body">
                    <!-- <div class="form-group">
                        <label>Kode Jabatan</label>
                        <input class="form-control" value="" name="jabatan_kode" id="kode" autocomplete="off">
                    </div> -->
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="jabatan_nama" id="nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Golru Awal</label>
                        <select class="form-control select2" style="width: 100%;" name="jabatan_golru_awal" id="awal" autocomplete="off">
                            <?php
                            foreach ($pangkat_golongan->result() as $value) {
                                echo '<option value="' . $value->pangkat_golongan_kode . '">' . $value->pangkat_golongan_text . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Golru Akhir</label>
                        <select class="form-control select2" style="width: 100%;" name="jabatan_golru_akhir" id="akhir" autocomplete="off">
                            <?php
                            foreach ($pangkat_golongan->result() as $value) {
                                echo '<option value="' . $value->pangkat_golongan_kode . '">' . $value->pangkat_golongan_text . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tunjangan</label>
                        <input class="form-control" name="jabatan_tunjangan" id="tunjangan" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Pendidikan Umum</label>
                        <select class="form-control select2" style="width: 100%;" name="jabatan_pendidikan_kode" id="pendidikan" autocomplete="off">
                            <?php
                            foreach ($pendidikan_tingkat->result() as $value) {
                                echo '<option value="' . $value->pendidikan_tingkat_kode . '">' . $value->pendidikan_tingkat_nama . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Angka Kredit</label>
                        <input type="text" onkeyup="angka(this);" maxlength="6" class="form-control" value="" name="jabatan_angka_kredit" id="ak" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Pensiun</label>
                        <input type="text" onkeyup="angka(this);" maxlength="2" class="form-control" value="" name="jabatan_usia_pensiun" id="pensiun" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-update">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?= site_url('referensi/JabatanFungsional/update') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Jabatan</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="jabatan_id" id="edit_id">
                    <div class="form-group">
                        <label>Kode Jabatan</label>
                        <input class="form-control" value="" name="jabatan_kode" id="edit_kode" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="jabatan_nama" id="edit_nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Golru Awal</label>
                        <select class="form-control select2" style="width: 100%;" name="jabatan_golru_awal" id="edit_awal" autocomplete="off">
                            <?php
                            foreach ($pangkat_golongan->result() as $value) {
                                echo '<option value="' . $value->pangkat_golongan_kode . '">' . $value->pangkat_golongan_text . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Golru Akhir</label>
                        <select class="form-control select2" style="width: 100%;" name="jabatan_golru_akhir" id="edit_akhir" autocomplete="off">
                            <?php
                            foreach ($pangkat_golongan->result() as $value) {
                                echo '<option value="' . $value->pangkat_golongan_kode . '">' . $value->pangkat_golongan_text . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tunjangan</label>
                        <input class="form-control" name="jabatan_tunjangan" id="edit_tunjangan" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Pendidikan Umum</label>
                        <select class="form-control select2" style="width: 100%;" name="jabatan_pendidikan_kode" id="edit_pendidikan" autocomplete="off">
                            <?php
                            foreach ($pendidikan_tingkat->result() as $value) {
                                echo '<option value="' . $value->pendidikan_tingkat_kode . '">' . $value->pendidikan_tingkat_nama . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Angka Kredit</label>
                        <input type="text" onkeyup="angka(this);" maxlength="6" class="form-control" value="" name="jabatan_angka_kredit" id="edit_ak" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Pensiun</label>
                        <input type="text" onkeyup="angka(this);" maxlength="2" class="form-control" value="" name="jabatan_usia_pensiun" id="edit_pensiun" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    function editf(id, kode, nama, awal, akhir, tunjangan, pendidikan, ak, pensiun) {
        $('#edit_id').val(id);
        $('#edit_nama').val(nama);
        $('#edit_kode').val(kode);
        $('#edit_awal').val(awal).change();
        $('#edit_akhir').val(akhir).change();
        $('#edit_tunjangan').val(tunjangan);
        $('#edit_pendidikan').val(pendidikan).change();
        $('#edit_ak').val(ak);
        $('#edit_pensiun').val(pensiun);
    }
</script>