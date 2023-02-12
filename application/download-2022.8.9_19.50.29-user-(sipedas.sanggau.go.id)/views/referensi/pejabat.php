<?php
defined('BASEPATH') or exit('No direct script access allowed');
$modul = 'Pejabat';
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus fa-fw"></i> Tambah <?= $modul ?></a>
                <br/><br/> 
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <i class="fa fa-list fa-fw"></i> List <?= $modul ?> 
                    </div>
                    <div class="panel-body">
                        <div class="box-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered table-striped tabel">
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
                                            <td><?= $value->pejabat_nama ?></td>
                                            <td>

                                                <a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit('<?= $value->pejabat_id ?>','<?= $value->pejabat_nama ?>')" data-toggle="modal" data-target="#modal-update"><i class="fa fa-edit"></i> Edit</a>

                                                <a href="<?= current_url() . '/delete/' . $value->pejabat_id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data.?')"><i class="fa fa-trash-o fa-fw"></i> Hapus</a>

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
        </div>
    </section>
</div>

<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?= current_url() . '/add' ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah <?= $modul ?></h4>
                </div>
                <div class="modal-body">                    
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
            <form role="form" action="<?= current_url() . '/update' ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit <?= $modul ?></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="id" id="edit_id">
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" id="edit_nama" name="nama" required="true" autocomplete="off">
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
    function edit(id,nama) {
        $('#edit_id').val(id);
        $('#edit_nama').val(nama);
    }
</script>