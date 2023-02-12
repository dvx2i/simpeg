<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            List Kabupaten
        </h1>
    </section>


    <section class="content">
        <?php
        if(!empty($propinsi_id)){
        ?>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Kabupaten</a>
        <br />
        <br />
        <?php } ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box">                    
                    <div class="box-body ">
                        <div class="col-md-4">
                        <div class="form-group">
                            <label>Propinsi</label>
                            <select class="form-control select2" name="propinsi_id" id="propinsi">
                                <option value="">--Pilih Propinsi--</option>
                                <?php
                                foreach ($propinsi->result() as $value) {
                                    ?>
                                <option value="<?= $value->propinsi_id ?>" <?php selected($propinsi_id, $value->propinsi_id) ?>><?= $value->propinsi_nama ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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
                                        <td><?= $value->kabupaten_nama ?></td>

                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit('<?= $value->kabupaten_id ?>', '<?= $value->kabupaten_nama ?>')" data-toggle="modal" data-target="#modal-update"><i class="fa fa-edit"></i></a>
                                            <a href="<?= site_url('referensi/Kabupaten/delete/' . $value->kabupaten_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data.?')"><i class="fa fa-trash-o fa-fw"></i></a>
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
            <form role="form" action="<?= site_url('referensi/Kabupaten/add') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Kabupaten</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="propinsi" value="<?=$propinsi_id?>"/>
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="nama" required="true" autocomplete="off">
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
            <form role="form" action="<?= site_url('referensi/Kabupaten/update') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Kabupaten</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="id" id="edit_id">
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="nama" id="edit_nama" autocomplete="off">
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
    function edit(id, nama) {
        $('#edit_id').val(id);
        $('#edit_nama').val(nama);
    }
</script>
<script>

    $(document).ready(
            function () {
                
                $('#propinsi').change(
                        function () {
                            window.location = '<?= site_url('referensi/Kabupaten/index').'/'?>'+$('#propinsi').val();
                        }
                );
            
                $('#propinsi1').change(
                        function () {
                            $.ajax({
                                url: '<?= site_url('referensi/ReferensiJson/listKabupatenByIdPropinsi/') ?>' + $('#propinsi').val(),
                                type: "POST",
                                data: {ajax: '1'},
                                dataType: "html",
                                success: function (data) {
                                    $('#kabupaten').html(data);
                                }
                            });
                        }
                );

                $('#kabupaten').change(
                        function () {
                            $.ajax({
                                url: '<?= site_url('referensi/ReferensiJson/listKecamatanByIdKabupaten/') ?>' + $('#kabupaten').val(),
                                type: "POST",
                                data: {ajax: '1'},
                                dataType: "html",
                                success: function (data) {
                                    $('#kecamatan').html(data);
                                }
                            });
                        }
                );

                $('#kecamatan').change(
                        function () {
                            $.ajax({
                                url: '<?= site_url('referensi/ReferensiJson/listKelurahanByIdKecamatan/') ?>' + $('#kecamatan').val(),
                                type: "POST",
                                data: {ajax: '1'},
                                dataType: "html",
                                success: function (data) {
                                    $('#kelurahan').html(data);
                                }
                            });
                        }
                );

                
                
                
                
            }

    );

</script>