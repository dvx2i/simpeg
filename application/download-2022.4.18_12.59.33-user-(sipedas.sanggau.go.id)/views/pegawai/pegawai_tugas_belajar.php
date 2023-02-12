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
                        <form id="formadd" role="form" action="<?= site_url('pegawai/PegawaiTugasBelajar/add') ?>" method="post" enctype="multipart/form-data">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> RIWAYAT TUGAS BELAJAR</b>
                                    </div>
                                    <div class="panel-body">
                                        <input type="hidden" class="form-control" name="tugasbelajar_id" id="tugasbelajar_id" />


                                        <div class="form-group">
                                            <label>No. SK</label>
                                            <input type="text" class="form-control" name="tugasbelajar_no_sk" id="tugasbelajar_no_sk" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tgl SK</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="tugasbelajar_tanggal_sk" id="tugasbelajar_tanggal_sk" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Mulai</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="tugasbelajar_mulai" id="tugasbelajar_mulai" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Selesai</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="tugasbelajar_selesai" id="tugasbelajar_selesai" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <label>Pejabat Pengesah</label>
                                            <select class="form-control select2" name="tugasbelajar_pejabat" id="tugasbelajar_pejabat">
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
                                            <label>Jenjang Pendidikan</label>
                                            <select class="form-control" name="tugasbelajar_pendidikan_tingkat_id" id="tugasbelajar_pendidikan_tingkat_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pendidikan_tingkat->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pendidikan_tingkat_id ?>"><?= $value->pendidikan_tingkat_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Instansi Pendidikan</label>
                                            <input type="text" class="form-control" name="tugasbelajar_nama_pendidikan" id="tugasbelajar_nama_pendidikan" />
                                        </div>
                                        <div class="form-group">
                                            <label>Fakultas</label>
                                            <select class="form-control select2" data-live-search="true" name="tugasbelajar_pendidikan_id" id="tugasbelajar_pendidikan_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pendidikan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pendidikan_id ?>"><?= $value->pendidikan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label>Jurusan</label>
                                            <select class="form-control select2" data-live-search="true" name="tugasbelajar_jurusan_id" id="tugasbelajar_jurusan_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($jurusan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jurusan_id ?>"><?= $value->jurusan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Pendanaan</label>
                                            <select class="form-control" name="tugasbelajar_pendanaan_id" id="tugasbelajar_pendanaan_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pendanaan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pendanaan_id ?>"><?= $value->pendanaan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis</label>
                                            <select class="form-control" name="tugasbelajar_jenis" id="tugasbelajar_jenis">
                                                <option value="">--Pilih--</option>
                                                <option value="NEGERI">NEGERI</option>
                                                <option value="SWASTA">SWASTA</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input type="text" onkeyup="angka(this);" class="form-control" name="tugasbelajar_tahun" id="tugasbelajar_tahun" />
                                        </div>
                                        <div class="form-group">
                                            <label>Nilai</label>
                                            <input type="text" onkeyup="angka(this);" class="form-control" step="0.01" name="tugasbelajar_nilai" id="tugasbelajar_nilai" />
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" name="tugasbelajar_keterangan" id="tugasbelajar_keterangan"></textarea>
                                        </div> -->

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
                                        <th>Nomor, Tanggal, <br />Mulai, Selesai</th>
                                        <th>Pejabat Pengesah</th>
                                        <th>Tingkat Pendidikan, <br /> Nama Instansi</th>
                                        <th>Fakultas,<br /> Jurusan</th>
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

                                                <a href="#formadd" onclick="edit('<?= $value->tugasbelajar_id ?>')" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i></a>
                                                <a href="<?= site_url('pegawai/PegawaiTugasBelajar/delete/' . $value->tugasbelajar_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Menghapus Data.?')"><i class="fa fa-trash-o fa-fw"></i></a>

                                            </td>
                                            <td><?= $value->tugasbelajar_no_sk . ', ' . tgl_indo($value->tugasbelajar_tanggal_sk) . ', ' . tgl_indo($value->tugasbelajar_mulai) ?></td>
                                            <td><?= $value->tugasbelajar_pejabat ?></td>
                                            <td><?= $value->tugasbelajar_pendidikan_tingkat_nama ?>, <br /><?= ($value->tugasbelajar_nama_pendidikan) ?></td>
                                            <td><?= ($value->tugasbelajar_pendidikan_nama) ?> - <br /> <?= ($value->tugasbelajar_jurusan_nama) ?></td>
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

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiTugasBelajarById') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {
            console.log(data);
                $('#tugasbelajar_id').val(data.tugasbelajar_id);
                $('#tugasbelajar_no_sk').val(data.tugasbelajar_no_sk);
                $('#tugasbelajar_tanggal_sk').datetextentry('set_date', data.tugasbelajar_tanggal_sk);
                $('#tugasbelajar_mulai').datetextentry('set_date', data.tugasbelajar_mulai);
                $('#tugasbelajar_selesai').datetextentry('set_date', data.tugasbelajar_selesai);
                $('#tugasbelajar_pendanaan_id').val(data.tugasbelajar_pendanaan_id).change();
                $('#tugasbelajar_pendidikan_id').val(data.tugasbelajar_pendidikan_id).change();
                $('#tugasbelajar_jurusan_id').val(data.tugasbelajar_jurusan_id).change();
                $('#tugasbelajar_pendidikan_tingkat_id').val(data.tugasbelajar_pendidikan_tingkat_id).change();
                $('#tugasbelajar_nama_pendidikan').val(data.tugasbelajar_nama_pendidikan);
                $('#tugasbelajar_keterangan').val(data.tugasbelajar_keterangan);
                $('#tugasbelajar_jenis').val(data.tugasbelajar_jenis).change();
                $('#tugasbelajar_tahun').val(data.tugasbelajar_tahun);
                $('#tugasbelajar_nilai').val(data.tugasbelajar_nilai);
                $('#tugasbelajar_pejabat').val(data.tugasbelajar_pejabat).change();

                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiTugasBelajar/update') ?>');

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
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiTugasBelajar/add') ?>');
        document.getElementById('formadd').reset();
    }

    $('#tugasbelajar_pendidikan_tingkat_id').change(
        function() {
            var tingkat = $(this).val();
            // load kedudukan jabatan
            $.ajax({
                url: '<?= site_url('referensi/ReferensiJson/listPendidikanByTingkat/') ?>',
                type: "POST",
                data: {
                    ajax: '1',
                    id: tingkat
                },
                dataType: "html",
                success: function(data) {
                    //                                        alert(data.id);
                    $('#tugasbelajar_pendidikan_id').html(data);
                    //$('#jenis_kedudukan_nama').val(data.nama);
                }
            });

        }
    );
</script>