<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            List Jabatan Struktural
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
                                    <th>Eselon</th>
                                    <th>Unit Kerja</th>
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
                                        <td><?= $value->jabatan_nama ?></td>
                                        <td><?= $value->jabatan_eselon_nama ?></td>
                                        <td><?= $value->jabatan_unit_nama ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit('<?= $value->jabatan_id ?>', '<?= $value->jabatan_kode ?>', '<?= $value->jabatan_nama ?>', '<?= $value->jabatan_eselon_kode ?>', '<?= $value->jabatan_unit_kode ?>')" data-toggle="modal" data-target="#modal-update"><i class="fa fa-edit"></i></a>
                                            <a href="<?= site_url('referensi/JabatanStruktural/delete/' . $value->jabatan_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data.?')"><i class="fa fa-trash-o fa-fw"></i></a>
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
            <form role="form" action="<?= site_url('referensi/JabatanStruktural/add') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Jabatan</h4>
                </div>
                <div class="modal-body">
<!--                     <div class="form-group">
                        <label>Kode Jabatan</label>
                        <input class="form-control" value="" name="jabatan_kode" id="jabatan_kode" autocomplete="off">
                    </div> -->
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="jabatan_nama" id="jabatan_nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Unit Kerja</label>
                        <select class="form-control select2custom" style="width: 100%;" name="jabatan_unit_kode" id="jabatan_unit_kode" >
                            <?php
                            foreach ($unit->result() as $value) {
                            $bold = '0~'.$value->unit_nama;
                            if(empty($value->unit_parent_id)){
                            $bold = '1~'.$value->unit_nama;
                            }
                                echo '<option value="' . $value->unit_id . '">' . $bold . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Eselon</label>
                        <select class="form-control select2" style="width: 100%;" value=""name="jabatan_eselon_kode" id="jabatan_eselon_kode" >
                            <?php
                            foreach ($eselon->result() as $value) {
                                echo '<option value="' . $value->eselon_kode . '">' . $value->eselon_nama . '</option>';
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
            <form role="form" action="<?= site_url('referensi/JabatanStruktural/update') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Jabatan</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="jabatan_id" id="edit_id">
<!--                     <div class="form-group">
                        <label>Kode Jabatan</label>
                        <input class="form-control" value="" name="jabatan_kode" id="edit_kode" autocomplete="off">
                    </div> -->
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="jabatan_nama" id="edit_nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Unit Kerja</label>
                        <select class="form-control select2custom" style="width: 100%;" name="jabatan_unit_kode" id="edit_unit" >
                             <?php
                            foreach ($unit->result() as $value) {
                            $bold = '0~'.$value->unit_nama;
                            if(empty($value->unit_parent_id)){
                            $bold = '1~'.$value->unit_nama;
                            }
                                echo '<option value="' . $value->unit_id . '">' . $bold . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Eselon</label>
                        <select class="form-control " style="width: 100%;" value=""name="jabatan_eselon_kode" id="edit_eselon" >
                            <?php
                            foreach ($eselon->result() as $value) {
                                echo '<option value="' . $value->eselon_kode . '">' . $value->eselon_nama . '</option>';
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
    function edit(id,kode,nama,eselon,unit) {
        $('#edit_id').val(id);
        $('#edit_nama').val(nama);
        // $('#edit_kode').val(kode);
        $('#edit_eselon').val(eselon).change();
        $('#edit_unit').val(unit).change();
    }



</script>