<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            List Pendidikan
        </h1>
    </section>


    <section class="content">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Pendidikan</a>
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
                                    <th>Nama</th>

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
                                        <td><?= $value->pendidikan_nama ?></td>

                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit('<?= $value->pendidikan_id ?>','<?= $value->pendidikan_nama ?>','<?= $value->pendidikan_tingkat_id ?>','<?= $value->pendidikan_golru_awal ?>','<?= $value->pendidikan_golru_akhir ?>')" data-toggle="modal" data-target="#modal-update"><i class="fa fa-edit"></i></a>
                                            <a href="<?= site_url('referensi/Pendidikan/delete/' . $value->pendidikan_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data.?')"><i class="fa fa-trash-o fa-fw"></i></a>
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
            <form role="form" action="<?= site_url('referensi/Pendidikan/add') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Pendidikan</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="pendidikan_nama" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tingkat Pendidikan</label>
                        <select class="form-control select2" style="width: 100%;" name="pendidikan_tingkat_id" id="pendidikan_tingkat_id" autocomplete="off">
                            <?php
                            foreach ($pendidikan_tingkat->result() as $value) {
                                echo '<option value="' . $value->pendidikan_tingkat_id . '">' . $value->pendidikan_tingkat_nama . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Golru Awal</label>
                        <select class="form-control select2" style="width: 100%;" name="pendidikan_golru_awal" id="add_awal" autocomplete="off">
                            <?php
                            foreach ($pangkat_golongan->result() as $value) {
                                echo '<option value="' . $value->pangkat_golongan_kode . '">' . $value->pangkat_golongan_text . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Golru Akhir</label>
                        <select class="form-control select2" style="width: 100%;" name="pendidikan_golru_akhir" id="add_akhir" autocomplete="off">
                            <?php
                            foreach ($pangkat_golongan->result() as $value) {
                                echo '<option value="' . $value->pangkat_golongan_kode . '">' . $value->pangkat_golongan_text . '</option>';
                            }
                            ?>
                        </select>
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
            <form role="form" action="<?= site_url('referensi/Pendidikan/update') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Pendidikan</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="id" id="edit_id">
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="pendidikan_nama" id="edit_nama" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tingkat Pendidikan</label>
                        <select class="form-control select2" style="width: 100%;" name="pendidikan_tingkat_id" id="edit_tingkat" autocomplete="off">
                            <?php
                            foreach ($pendidikan_tingkat->result() as $value) {
                                echo '<option value="' . $value->pendidikan_tingkat_id . '">' . $value->pendidikan_tingkat_nama . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Golru Awal</label>
                        <select class="form-control select2" style="width: 100%;" name="pendidikan_golru_awal" id="edit_awal" autocomplete="off">
                            <?php
                            foreach ($pangkat_golongan->result() as $value) {
                                echo '<option value="' . $value->pangkat_golongan_kode . '">' . $value->pangkat_golongan_text . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Golru Akhir</label>
                        <select class="form-control select2" style="width: 100%;" name="pendidikan_golru_akhir" id="edit_akhir" autocomplete="off">
                            <?php
                            foreach ($pangkat_golongan->result() as $value) {
                                echo '<option value="' . $value->pangkat_golongan_kode . '">' . $value->pangkat_golongan_text . '</option>';
                            }
                            ?>
                        </select>
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
    function edit(id, nama, tingkat, golru_awal, golru_akhir) {
        $('#edit_id').val(id);
        $('#edit_nama').val(nama);
        $('#edit_tingkat').val(tingkat).change();
        $('#edit_awal').val(golru_awal).change();
        $('#edit_akhir').val(golru_akhir).change();
    }
</script>