<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            User
        </h1>
    </section>


    <section class="content">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah User</a>
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
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th>Group</th>
                                    <th>Unit Kerja</th>
                                    <th>Administrator</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($user->result() as $value) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->user_name ?></td>
                                        <td><?= $value->user_nama_lengkap ?></td>
                                        <td><?php foreach ($group->result() as $val) {
                                                if ($val->GroupId == $value->UserGroupGroupId) {
                                                    echo $val->GroupName . ' ';
                                                }
                                            } ?></td>
                                        <td><?= $value->unit_nama ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit('<?= $value->user_id ?>', '<?= $value->user_name ?>', '<?= $value->user_nama_lengkap ?>', '<?= $value->user_unit_id ?>', '<?= $value->UserGroupGroupId ?>')" data-toggle="modal" data-target="#modal-update" rel="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                            <?php if (empty($value->GroupIsAdmin)) { ?>
                                                <a href="<?= site_url('system/User/delete/' . $value->user_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data Group ini.?')" rel="tooltip" data-original-title="Hapus"><i class="fa fa-trash-o fa-fw"></i></a>
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
            <form action="<?= site_url('system/User/add') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah User</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Username (NIP)</label>
                        <input class="form-control" value="" id="nama" name="nama" required="true" autocomplete="off">
                        <button type="button" class="btn btn-defaul btn-small" id="cek_nip">Cek NIP</button>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" value="" name="password" required="true" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <textarea class="form-control" rows="3" name="nama_lengkap" id="nama_lengkap"></textarea>
                    </div>
                    <div class="form-group">
                        <label>OPD</label>
                        <select class="form-control select2 col-md-12" style="width: 100%;" name="unit" id="opd">
                            <?php
                            foreach ($unit->result() as $value) {
                            ?>
                                <option value="<?= $value->unit_id ?>"><?= $value->unit_nama ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Group</label>
                        <select class="form-control" style="width: 100%;" name="group" id="group">
                            <?php
                            foreach ($group->result() as $value) {
                            ?>
                                <option value="<?= $value->GroupId ?>"><?= $value->GroupName ?></option>
                            <?php } ?>
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
            <form role="form" action="<?= site_url('system/User/update') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah User</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="id" id="edit_id">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" readonly value="" name="nama" id="edit_nama" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" value="" name="password" id="edit_password" autocomplete="off">
                        <span class="text-sm">Isi hanya jika password akan diganti</span>
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <textarea class="form-control" rows="3" id="edit_nama_lengkap" name="nama_lengkap"></textarea>
                    </div>
                    <div class="form-group">
                        <label>OPD</label>
                        <select class="form-control select2 col-md-12" style="width: 100%;" name="unit" id="edit_unit">
                            <?php
                            foreach ($unit->result() as $value) {
                            ?>
                                <option value="<?= $value->unit_id ?>"><?= $value->unit_nama ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Group</label>
                        <select class="form-control" style="width: 100%;" name="group" id="edit_group">
                            <?php
                            foreach ($group->result() as $value) {
                            ?>
                                <option value="<?= $value->GroupId ?>"><?= $value->GroupName ?></option>
                            <?php } ?>
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
    function edit(id, nama, deskripsi, unit, group) {
        $('#edit_id').val(id);
        $('#edit_nama').val(nama);
        $('#edit_nama_lengkap').val(deskripsi);
        $('#edit_unit').val(unit).change();
        $('#edit_group').val(group).change();
    }


    $('#cek_nip').on('click', function(e) {
        var id = $('#nama').val();
        url = '<?= site_url('system/User/index/nip') ?>';
        $.post(url, {
            nip: id,
        }, function(respon) {
            obj_respon = jQuery.parseJSON(respon);
            // alert(obj_respon['pegawai_nama']);
            // return false;
            if (obj_respon.pegawai_nama != null) {
                $('#nama_lengkap').val(obj_respon.pegawai_nama);
                $('#opd').val(obj_respon.pegawai_unit_id).change();
                // alert("Data ditemukan");
            } else {
                alert(obj_respon.message);
            }

        });
    })
</script>