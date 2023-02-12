<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Group
        </h1>
    </section>


    <section class="content">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Group</a>
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
                                    <th>Deskripsi</th>
                                    <th>Administrator</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($group->result() as $value) {
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->GroupName ?></td>
                                        <td><?= $value->GroupDescription ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit('<?= $value->GroupId ?>','<?= $value->GroupName ?>','<?= $value->GroupDescription ?>')" data-toggle="modal" data-target="#modal-update" rel="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                            <?php if (empty($value->GroupIsAdmin)) { ?>
                                                <a href="<?= site_url('system/Group/delete/' . $value->GroupId) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data Group ini.?')" data-toggle="tooltip" data-original-title="Hapus"><i class="fa fa-trash-o fa-fw"></i></a>
                                                <a href="<?= site_url('system/Group/detail/' . $value->GroupId) ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Detail Hak Akses"><i class="fa fa-address-card fa-fw" ></i></a>
                                            <?php } ?>
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
            <form role="form" action="<?= site_url('system/Group/add') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Group</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="nama" required="true" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" rows="3" name="deskripsi"></textarea>
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
            <form role="form" action="<?= site_url('system/Group/update') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Group</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="id" id="edit_id">
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="nama" id="edit_nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" rows="3" name="deskripsi" id="edit_deskripsi"></textarea>
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
    function edit(id,nama,deskripsi) {
        $('#edit_id').val(id);
        $('#edit_nama').val(nama);
        $('#edit_deskripsi').val(deskripsi);
    }
</script>