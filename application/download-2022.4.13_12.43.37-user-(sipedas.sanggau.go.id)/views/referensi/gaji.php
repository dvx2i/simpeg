<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            List Gaji
        </h1>
    </section>


    <section class="content">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Daftar Gaji</a>
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
                                    <th>Kode Golongan</th>
                                    <th>Nama Golongan</th>
                                    <th>Masa Kerja (Tahun)</th>
                                    <th>Gaji Pokok PNS (Rp))</th>
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
                                        <td><?= $value->gaji_golru_kode ?></td>
                                        <td><?= $value->gaji_pangkat_nama ?></td>
                                        <td><?= $value->gaji_masa_kerja ?></td>
                                        <td><?= $value->gaji_jumlah ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" type="button" onclick="editf('<?= $value->gaji_id ?>', '<?= $value->gaji_golru_kode ?>', '<?= $value->gaji_masa_kerja ?>', '<?= $value->gaji_jumlah ?>')" data-toggle="modal" data-target="#modal-update"><i class="fa fa-edit"></i></a>
                                            <a href="<?= site_url('referensi/Gaji/delete/' . $value->gaji_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data.?')"><i class="fa fa-trash-o fa-fw"></i></a>
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
            <form role="form" action="<?= site_url('referensi/Gaji/add') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Gaji</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Golru</label>
                        <select class="form-control select2" style="width: 100%;" name="gaji_golru_kode" id="golru" autocomplete="off">
                            <?php
                            foreach ($pangkat_golongan->result() as $value) {
                                echo '<option value="' . $value->pangkat_golongan_kode . '">' . $value->pangkat_golongan_text . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Masa Kerja (Tahun)</label>
                        <select class="form-control" style="width: 100%;" name="gaji_masa_kerja" id="masa_kerja" autocomplete="off">
                            <?php
                            for ($i = 0; $i <= 33; $i++) {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gaji</label>
                        <input type="text" onkeyup="angka(this);" class="form-control" name="gaji_jumlah" id="jumlah" autocomplete="off">
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
            <form role="form" action="<?= site_url('referensi/Gaji/update') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Jabatan</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="gaji_id" id="edit_id">

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Golru</label>
                            <select class="form-control select2" style="width: 100%;" name="gaji_golru_kode" id="edit_golru" autocomplete="off">
                                <?php
                                foreach ($pangkat_golongan->result() as $value) {
                                    echo '<option value="' . $value->pangkat_golongan_kode . '">' . $value->pangkat_golongan_text . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Masa Kerja (Tahun)</label>
                            <select class="form-control" style="width: 100%;" name="gaji_masa_kerja" id="edit_masa_kerja" autocomplete="off">
                                <?php
                                for ($i = 0; $i <= 30; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Gaji</label>
                            <input type="text" onkeyup="angka(this);" class="form-control" name="gaji_jumlah" id="edit_jumlah" autocomplete="off">
                        </div>
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
    function editf(id, golru, masa_kerja, jumlah) {
        $('#edit_id').val(id);
        $('#edit_golru').val(golru).change();
        $('#edit_masa_kerja').val(masa_kerja).change();
        $('#edit_jumlah').val(jumlah);
    }
</script>