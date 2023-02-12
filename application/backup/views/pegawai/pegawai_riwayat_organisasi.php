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
                        <form id="formadd" role="form" action="<?= site_url('pegawai/PegawaiOrganisasi/add') ?>" method="post" enctype="multipart/form-data">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> RIWAYAT ORGANISASI</b>
                                    </div>
                                    <div class="panel-body">
                                        <input type="hidden" class="form-control" name="pegawaiorg_id" id="pegawaiorg_id" />

                                        <div class="form-group">
                                            <label>Jenis Organisasi</label>
                                            <select class="form-control" name="pegawaiorg_jenisorganisasi_id" id="pegawaiorg_jenisorganisasi_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($jenis_organisasi->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jenis_organisasi_id ?>"><?= $value->jenis_organisasi_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Organisasi</label>
                                            <input type="text" required="true" class="form-control" name="pegawaiorg_organisasi" id="pegawaiorg_organisasi" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Anggota</label>
                                            <input type="text" class="form-control" name="pegawaiorg_no_anggota" id="pegawaiorg_no_anggota" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <input type="text" class="form-control" name="pegawaiorg_jabatan" id="pegawaiorg_jabatan" autocomplete="off" />
                                        </div>


                                        <div class="form-group">
                                            <label>Mulai</label>
                                            <div class="input-group">

                                                <input type="text" required="true" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaiorg_mulai" id="pegawaiorg_mulai" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>Selesai</label>
                                            <div class="input-group">
                                                <input type="text" required="true" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaiorg_selesai" id="pegawaiorg_selesai" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" name="pegawaiorg_alamat" id="pegawaiorg_alamat" autocomplete="off" />
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
                                        <th>Jenis</th>
                                        <th>Nama Organisasi</th>
                                        <th>No. Anggota, Jabatan</th>
                                        <th>Tanggal Masuk, Selesai</th>
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

                                                <a href="#formadd" onclick="edit('<?= $value->pegawaiorg_id ?>')" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i></a>
                                                <a href="<?= site_url('pegawai/PegawaiOrganisasi/delete/' . $value->pegawaiorg_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Menghapus Data.?')"><i class="fa fa-trash-o fa-fw"></i></a>

                                            </td>
                                            <td><?= $value->pegawaiorg_jenisorganisasi_nama ?></td>
                                            <td><?= $value->pegawaiorg_organisasi ?></td>
                                            <td><?= $value->pegawaiorg_no_anggota ?>, <br /><?= ($value->pegawaiorg_jabatan) ?></td>
                                            <td><?= tgl_indo($value->pegawaiorg_mulai) ?> - <br /> <?= tgl_indo($value->pegawaiorg_selesai) ?></td>
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

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiOrganisasiById') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {
                $('#pegawaiorg_id').val(data.pegawaiorg_id);
                $('#pegawaiorg_organisasi').val(data.pegawaiorg_organisasi);
                $('#pegawaiorg_jenisorganisasi_id').val(data.pegawaiorg_jenisorganisasi_id).change();
                $('#pegawaiorg_jabatan').val(data.pegawaiorg_jabatan);
                $('#pegawaiorg_mulai').datetextentry('set_date', data.pegawaiorg_mulai);
                $('#pegawaiorg_selesai').datetextentry('set_date', data.pegawaiorg_selesai);
                $('#pegawaiorg_alamat').val(data.pegawaiorg_alamat);
                $('#pegawaiorg_no_anggota').val(data.pegawaiorg_no_anggota);

                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiOrganisasi/update') ?>');

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
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiOrganisasi/add') ?>');
        document.getElementById('formadd').reset();
    }
</script>