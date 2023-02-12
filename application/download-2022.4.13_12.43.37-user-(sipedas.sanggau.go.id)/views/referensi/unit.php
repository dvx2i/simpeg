<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            List Unit
        </h1>
    </section>


    <section class="content">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Unit</a>
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
                                    <th>Nama Unit Kerja</th>
                                    <th>Induk Unit Kerja</th>
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
                                        <td><?= $value->unit_nama ?></td>
                                        <td><?= $value->induk ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit('<?= $value->unit_id ?>', '<?= $value->unit_nama ?>', '<?= $value->induk_id ?>','<?= $value->unit_perda_no ?>', '<?= $value->unit_perda_tanggal ?>', '<?= $value->unit_perda_dari ?>', '<?= $value->unit_kpok?>', '<?= $value->unit_is_unit_kerja ?>')" data-toggle="modal" data-target="#modal-update"><i class="fa fa-edit"></i></a>
                                            <a href="<?= site_url('referensi/Unit/delete/' . $value->unit_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data.?')"><i class="fa fa-trash-o fa-fw"></i></a>
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
            <form role="form" action="<?= site_url('referensi/Unit/add') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Unit</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="nama" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label >Induk Unit Kerja</label>
                        <select class="form-control select2" style="width: 100%" name="unit_parent_id" id="unit_induk">
                            <option value="">--Pilih Unit Induk--</option>
                            <?php
                            foreach ($result->result() as $value) {
                                ?>
                                <option value="<?= $value->unit_id ?>" ><?= $value->unit_nama ?></option>
                            <?php } ?>    
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. Perda</label>
                        <input class="form-control" value="" name="unit_perda_no" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tgl. Perda</label>
                        <input class="form-control date" value="" name="unit_perda_tanggal" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Perda dari</label>
                        <input class="form-control" value="" name="unit_perda_dari" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Unit Kpok</label>
                        <input class="form-control"  type="number" value="" name="unit_kpok" required="true" autocomplete="off">
                    </div>
<!--                     <div class="form-group">
                        <label >Unit Eselon</label>
                        <select class="form-control select2" style="width: 100%" name="unit_parent_id" id="unit_induk">
                            <option value="">--Pilih Unit Induk--</option>
                            <?php
                            foreach ($result->result() as $value) {
                                ?>
                                <option value="<?= $value->unit_id ?>" ><?= $value->unit_nama ?></option>
                            <?php } ?>    
                        </select>
                    </div>
 -->
                    <div class="form-group">
                        <label>Tampil di Rekap</label>
                        <input type="radio" value="1" name="unit_is_unit_kerja" autocomplete="off"> Ya
                        <input type="radio" value="0" checked name="unit_is_unit_kerja" autocomplete="off"> Tidak
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
            <form role="form" action="<?= site_url('referensi/Unit/update') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Unit</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="id" id="edit_id">
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="nama" id="edit_nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label >Induk Unit Kerja</label>
                        <select class="form-control select2" style="width: 100%" name="unit_parent_id" id="edit_induk">
                            <option value="">--Pilih Unit Induk--</option>
                            <?php
                            foreach ($result->result() as $value) {
                                ?>
                                <option value="<?= $value->unit_id ?>" ><?= $value->unit_nama ?></option>
                            <?php } ?>    
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. Perda</label>
                        <input class="form-control" value="" name="unit_perda_no" id="edit_no"  autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tgl. Perda</label>
                        <input class="form-control date" value="" name="unit_perda_tanggal" id="edit_tanggal"  autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Perda dari</label>
                        <input class="form-control" value="" name="unit_perda_dari" id="edit_dari" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Unit Kpok</label>
                        <input class="form-control" type="number" value="" name="unit_kpok" id="edit_kpok" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tampil di Rekap</label>
                        <input type="radio" value="1" name="unit_is_unit_kerja" id="radio1" autocomplete="off"> Ya
                        <input type="radio" value="0" name="unit_is_unit_kerja" id="radio2" autocomplete="off"> Tidak
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
    function edit(id, nama,induk,no,tanggal,dari,kpok,unit_kerja) {
        $('#edit_id').val(id);
        $('#edit_nama').val(nama);
        $('#edit_induk').val(induk).change();
        $('#edit_no').val(no);
        $('#edit_tanggal').val(tanggal);
        $('#edit_dari').val(dari);
        $('#edit_kpok').val(kpok);
    
    if(unit_kerja == '1'){
    	$("#radio1").attr('checked', 'checked');
    }else if(unit_kerja == '0'){
    	$("#radio2").attr('checked', 'checked');
    }
    }
</script>