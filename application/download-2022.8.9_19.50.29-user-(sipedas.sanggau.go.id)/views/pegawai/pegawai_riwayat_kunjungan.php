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
                        <form id="formadd" role="form" action="<?= site_url('pegawai/PegawaiKunjungan/add') ?>" method="post" enctype="multipart/form-data">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> RIWAYAT KUNJUNGAN</b>
                                    </div>
                                    <div class="panel-body">
                                        <input type="hidden" class="form-control" name="pegawaitugas_id" id="pegawaitugas_id" />

                                        <div class="form-group">
                                            <label>Jenis Kunjungan</label>
                                            <select class="form-control" name="pegawaitugas_jenispenugasan_id" id="pegawaitugas_jenispenugasan_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($jenis_kunjungan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jenis_kunjungan_id ?>"><?= $value->jenis_kunjungan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tujuan</label>
                                            <input type="text" required="true" class="form-control" name="pegawaitugas_tujuan" id="pegawaitugas_tujuan" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" name="pegawaitugas_keterangan" id="pegawaitugas_keterangan"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Pejabat Yang Menetapkan</label>
                                            <select class="form-control" name="pegawaitugas_pejabat" id="pegawaitugas_pejabat">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pejabat->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pejabat_nama ?>"><?= $value->pejabat_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>No SK</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="pegawaitugas_nomor" id="pegawaitugas_nomor" autocomplete="off" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal</div>
                                                        </span>
                                                        <input type="text" required="true" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaitugas_tgl" id="pegawaitugas_tgl" value="" autocomplete="off" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar text-danger"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Kunjungan</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Mulai</div>
                                                        </span>
                                                        <input type="text" required="true" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaitugas_mulai" id="pegawaitugas_mulai" value="" autocomplete="off" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar text-danger"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Selesai</div>
                                                        </span>
                                                        <input type="text" required="true" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaitugas_akhir" id="pegawaitugas_akhir" value="" autocomplete="off" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar text-danger"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

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
                                        <th>Jenis, Tujuan Kunjungan</th>
                                        <th>Nomor SK, Tanggal SK</th>
                                        <th>Tanggal Mulai, Selesai</th>
                                        <th>Pejabat</th>
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

                                                <a href="#formadd" onclick="edit('<?= $value->pegawaitugas_id ?>')" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i></a>
                                                <a href="<?= site_url('pegawai/PegawaiKunjungan/delete/' . $value->pegawaitugas_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Menghapus Data.?')"><i class="fa fa-trash-o fa-fw"></i></a>

                                            </td>
                                            <td><?= $value->pegawaitugas_jenispenugasan_nama . ', <br/> ' . $value->pegawaitugas_tujuan ?></td>
                                            <td><?= $value->pegawaitugas_nomor ?>, <?= tgl_indo($value->pegawaitugas_tgl) ?></td>
                                            <td><?= tgl_indo($value->pegawaitugas_mulai) ?> - <br /> <?= tgl_indo($value->pegawaitugas_akhir) ?></td>
                                            <td><?= $value->pegawaitugas_pejabat ?></td>
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

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiKunjunganById') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {
                $('#pegawaitugas_id').val(data.pegawaitugas_id);
                $('#pegawaitugas_tujuan').val(data.pegawaitugas_tujuan);
                $('#pegawaitugas_jenispenugasan_id').val(data.pegawaitugas_jenispenugasan_id).change();
                $('#pegawaitugas_keterangan').val(data.pegawaitugas_keterangan);
                $('#pegawaitugas_pejabat').val(data.pegawaitugas_pejabat).change();
                $('#pegawaitugas_nomor').val(data.pegawaitugas_nomor);
                $('#pegawaitugas_tgl').datetextentry('set_date', data.pegawaitugas_tgl);
                $('#pegawaitugas_mulai').datetextentry('set_date', data.pegawaitugas_mulai);
                $('#pegawaitugas_akhir').datetextentry('set_date', data.pegawaitugas_akhir);

                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiKunjungan/update') ?>');

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
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiKunjungan/add') ?>');
        document.getElementById('formadd').reset();
    }
</script>