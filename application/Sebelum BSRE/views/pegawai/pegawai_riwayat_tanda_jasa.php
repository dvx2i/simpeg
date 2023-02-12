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
                        <form id="formadd" role="form" action="<?= site_url('pegawai/PegawaiTandaJasa/add') ?>" method="post" enctype="multipart/form-data">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> RIWAYAT TANDA JASA / PENGHARGAAN /KEHORMATAN</b>
                                    </div>
                                    <div class="panel-body">
                                        <input type="hidden" class="form-control" name="pegawaijasa_id" id="pegawaijasa_id" autocomplete="off" />

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" required="true" class="form-control" name="pegawaijasa_nama" id="pegawaijasa_nama" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>No. SK</label>
                                            <input type="text" required="true" class="form-control" name="pegawaijasa_nomor" id="pegawaijasa_nomor" autocomplete="off" />
                                        </div>

                                        <div class="form-group">
                                            <label>Tgl SK</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" required="true" autocomplete="off" name="pegawaijasa_tanggal" id="pegawaijasa_tanggal" value="" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <!-- <input type="number" onkeydown="return (event.which < 100)" max="<?= date('Y') ?>" class="form-control" name="pegawaijasa_tahun" id="pegawaijasa_tahun"  autocomplete="off"/> -->
                                            <select class="form-control" name="pegawaijasa_tahun" id="pegawaijasa_tahun">
                                                <option value="">--Pilih--</option>
                                                <option value="10">10 Tahun</option>
                                                <option value="20">20 Tahun</option>
                                                <option value="30">30 Tahun</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Asal Peroleh</label>
                                            <input type="text" class="form-control" name="pegawaijasa_asal" id="pegawaijasa_asal" autocomplete="off" />
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
                                        <th>Nama Penghargaan</th>
                                        <th>Nomor SK, Tanggal</th>
                                        <th>Tahun</th>
                                        <th>Asal</th>
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

                                                <a href="#formadd" onclick="edit('<?= $value->pegawaijasa_id ?>')" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i></a>
                                                <a href="<?= site_url('pegawai/PegawaiTandaJasa/delete/' . $value->pegawaijasa_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Menghapus Data.?')"><i class="fa fa-trash-o fa-fw"></i></a>

                                            </td>
                                            <td><?= $value->pegawaijasa_nama ?></td>
                                            <td><?= $value->pegawaijasa_nomor ?>, <?= tgl_indo($value->pegawaijasa_tanggal) ?></td>
                                            <td><?= $value->pegawaijasa_tahun ?></td>
                                            <td><?= $value->pegawaijasa_asal ?></td>
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

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiTandaJasaById') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {
                $('#pegawaijasa_id').val(data.pegawaijasa_id);
                $('#pegawaijasa_tahun').val(data.pegawaijasa_tahun);
                $('#pegawaijasa_nama').val(data.pegawaijasa_nama);
                $('#pegawaijasa_asal').val(data.pegawaijasa_asal);
                $('#pegawaijasa_nomor').val(data.pegawaijasa_nomor);
                $('#pegawaijasa_tanggal').datetextentry('set_date', data.pegawaijasa_tanggal);

                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiTandaJasa/update') ?>');

            }
        });

    }

    function d_m_y(date) {
        if (date != null) {
            var from = date.split("-");
            return from[2] + "/" + from[1] + "/" + from[0];
        } else {
            return date;
        }
    }

    function refresh() {
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiTandaJasa/add') ?>');
        document.getElementById('formadd').reset();
    }
</script>