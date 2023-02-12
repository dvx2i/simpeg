<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            <?= pegawai_nama_lengkap($pegawai) ?>
        </h1>
    </section>


    <section class="content">

        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body ">
                        <form id="formadd" role="form" action="<?= site_url('pegawai/PegawaiKaryaTulis/add') ?>" method="post" enctype="multipart/form-data">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> RIWAYAT KARYA TULIS</b>
                                    </div>
                                    <div class="panel-body">
                                        <input type="hidden" class="form-control" name="pegawaikaryatulis_id" id="pegawaikaryatulis_id" />

                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input type="text" required="true" class="form-control" name="pegawaikaryatulis_judul" id="pegawaikaryatulis_judul" autocomplete="off" />
                                        </div>

                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <input type="text" required="true" class="form-control" name="pegawaikaryatulis_keterangan" id="pegawaikaryatulis_keterangan" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input type="text" onkeyup="angka(this);" class="form-control " name="pegawaikaryatulis_tahun" id="pegawaikaryatulis_tahun" autocomplete="off" />



                                        </div>


                                        <div class="input-group-addon">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            <button type="button" onclick="refresh()" class="btn btn-default">Reset</button>
                                        </div>

                                    </div>
                                    <!-- /.panel-body -->
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-body">
                        <?= $menu_pegawai ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="riwayat">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <a href="#" onclick="refresh()" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Riwayat
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="max-width: 75px;min-width: 55px" class="text-center">Aksi</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($result->result() as $value) {
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td class="text-left nowrap">

                                                <a href="#formadd" onclick="edit('<?= $value->pegawaikaryatulis_id ?>')" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i></a>
                                                <a href="<?= site_url('pegawai/PegawaiKaryaTulis/delete/' . $value->pegawaikaryatulis_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Menghapus Data.?')"><i class="fa fa-trash-o fa-fw"></i></a>

                                            </td>
                                            <td><?= $value->pegawaikaryatulis_judul ?></td>
                                            <td><?= $value->pegawaikaryatulis_keterangan ?> </td>
                                            <td><?= ($value->pegawaikaryatulis_tahun) ?> </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>



                            </table>

                        </div>

                    </div>
                    <!-- /.panel-body -->
                </div>

            </div>
        </div>
    </section>
</div>
<script>
    function edit(v) {

        $.ajax({

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiKaryaTulisById') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {
                $('#pegawaikaryatulis_id').val(data.pegawaikaryatulis_id);
                $('#pegawaikaryatulis_judul').val(data.pegawaikaryatulis_judul);
                $('#pegawaikaryatulis_tahun').val(data.pegawaikaryatulis_tahun);
                $('#pegawaikaryatulis_keterangan').val(data.pegawaikaryatulis_keterangan);

                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiKaryaTulis/update') ?>');

            }
        });

    }

    function refresh() {
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiKaryaTulis/add') ?>');
        document.getElementById('formadd').reset();
    }
</script>