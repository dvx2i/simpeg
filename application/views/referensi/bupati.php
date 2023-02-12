<?php 
$row = $result->result_array();
?>
<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Data Bupati & Wakil Bupati
        </h1>
    </section>


    <section class="content">
        <!-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Berkas</a> -->
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
                                    <th>Nama Bupati</th>
                                    <th>Nama Wakil Bupati</th>

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
                                        <td><?= $value->bupati_nama ?></td>
                                        <td><?= $value->wabupati_nama ?></td>

                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit('<?= $value->id ?>','<?= $value->bupati_nama ?>','<?= $value->bupati_no_ktp ?>','<?= $value->bupati_no_hp ?>','<?= $value->bupati_image ?>','<?= $value->wabupati_nama ?>','<?= $value->wabupati_no_ktp ?>','<?= $value->wabupati_no_hp ?>','<?= $value->wabupati_image ?>')" data-toggle="modal" data-target="#modal-update"><i class="fa fa-edit"></i></a>
                                            <!-- <a href="<?= site_url('referensi/Bupati/delete/' . $value->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data.?')"><i class="fa fa-trash-o fa-fw"></i></a> -->
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


<div class="modal fade" id="modal-update">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?= site_url('referensi/Bupati/update') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="1" name="id" id="id">
                    
                    <div class="form-group">
                        <label>Nama Bupati</label>
                        <input class="form-control" value="" name="bupati_nama" id="bupati_nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>No KTP Bupati</label>
                        <input class="form-control" value="" name="bupati_no_ktp" id="bupati_no_ktp" type="text" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>No Telp. Bupati</label>
                        <input class="form-control" value="" name="bupati_no_hp" id="bupati_no_hp" type="text" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Foto Bupati</label>
                        <?php


                            $fotobup = 'assets/images/user.jpg';

                            if (file_exists(('assets/images/'.$row[0]['bupati_image']))) {
                                $fotobup = 'assets/images/'.$row[0]['bupati_image'];
                            } else if (file_exists(('assets/images/'.$row[0]['bupati_image']))) {
                                $fotobup = 'assets/images/'.$row[0]['bupati_image'];
                            } else 
                        if (file_exists(('assets/images/BUPATI.jpeg'))) {
                                $fotobup = 'assets/images/BUPATI.jpeg';
                            }


                            ?>
                            <p>
                                <img style="height: 100px;" src="<?= base_url($fotobup) ?>">
                            </p>
                        <input class="form-control" value="" name="bupati_image" type="file" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Nama Wakil Bupati</label>
                        <input class="form-control" value="" name="wabupati_nama" id="wabupati_nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>No KTP Wakil Bupati</label>
                        <input class="form-control" value="" name="wabupati_no_ktp" id="wabupati_no_ktp" type="text" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>No Telp. Wakil Bupati</label>
                        <input class="form-control" value="" name="wabupati_no_hp" id="wabupati_no_hp" type="text" required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Foto Wakil Bupati</label>
                        <?php


                            $fotobup = 'assets/images/user.jpg';

                            if (file_exists(('assets/images/'.$row[0]['wabupati_image']))) {
                                $fotobup = 'assets/images/'.$row[0]['wabupati_image'];
                            } else if (file_exists(('assets/images/'.$row[0]['wabupati_image']))) {
                                $fotobup = 'assets/images/'.$row[0]['wabupati_image'];
                            } else 
                        if (file_exists(('assets/images/WABUP.jpeg'))) {
                                $fotobup = 'assets/images/WABUP.jpeg';
                            }


                            ?>
                            <p>
                                <img style="height: 100px;" src="<?= base_url($fotobup) ?>">
                            </p>
                        <input class="form-control" value="" name="wabupati_image" type="file" autocomplete="off">
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
    function edit(id, bupati_nama, bupati_no_ktp, bupati_no_hp,bupati_image, wabupati_nama, wabupati_no_ktp, wabupati_no_hp,wabupati_image) {
        $('#id').val(id);
        $('#bupati_nama').val(bupati_nama);
        $('#bupati_no_ktp').val(bupati_no_ktp);
        $('#bupati_no_hp').val(bupati_no_hp);
        $('#bupati_image').val(bupati_image);
        $('#wabupati_nama').val(wabupati_nama);
        $('#wabupati_no_ktp').val(wabupati_no_ktp);
        $('#wabupati_no_hp').val(wabupati_no_hp);
        $('#wabupati_image').val(wabupati_image);
    }
</script>