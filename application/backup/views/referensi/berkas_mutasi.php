<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            List Berkas Pengajuan Mutasi Online
        </h1>
    </section>


    <section class="content">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Berkas</a>
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
                                        <td><?= $value->berkas_nama ?></td>
                                        
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit('<?= $value->berkas_id ?>','<?= $value->berkas_nama ?>','<?= $value->berkas_urut ?>','<?= $value->berkas_contoh ?>')" data-toggle="modal" data-target="#modal-update"><i class="fa fa-edit"></i></a>
                                                <a href="<?= site_url('referensi/BerkasMutasi/delete/' . $value->berkas_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data.?')"><i class="fa fa-trash-o fa-fw"></i></a>
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
            <form role="form" action="<?= site_url('referensi/BerkasMutasi/add') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Berkas</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="nama" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Urutan</label>
                        <input class="form-control" value="" name="urut" type="number" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Contoh Berkas</label>
                        <input class="form-control" value="" name="contoh" type="file" autocomplete="off">
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
            <form role="form" action="<?= site_url('referensi/BerkasMutasi/update') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Berkas</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="id" id="edit_id">
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" value="" name="nama" id="edit_nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Urutan</label>
                        <input class="form-control" value="" name="urut" id="edit_urut" type="number"  required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Contoh Berkas</label>
                        <input class="form-control" value="" name="contoh" type="file" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label><a href="#" id="berkas_contoh" class="btn btn-success btn-sm" target="_blank">Unduh Contoh Berkas</a></label>
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
    function edit(id,nama,urut,contoh) {
        $('#edit_id').val(id);
        $('#edit_nama').val(nama);
        $('#edit_urut').val(urut);
        console.log(contoh)
        if(contoh.length > 0){
            document.getElementById("berkas_contoh").href="<?= base_url('assets/files') ?>/"+contoh; 
        }else{
            document.getElementById("berkas_contoh").href="#"; 
        }
    }
</script>