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
                        <form id="formadd" role="form" action="<?= site_url('pegawai/PegawaiRiwayatKursus/add') ?>" method="post" enctype="multipart/form-data">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> RIWAYAT KURSUS</b>
                                    </div>
                                    <div class="panel-body">
                                        <input type="hidden" class="form-control" name="diklat_id" id="diklat_id" />


                                        <div class="form-group">
                                            <label>Nama Diklat</label>
                                            <input type="text" class="form-control" name="diklat_nama" id="diklat_nama" autocomplete="off" required="true" />

                                        </div>
                                        <div class="form-group">
                                            <label>Tempat</label>
                                            <input type="text" class="form-control" name="diklat_tempat" id="diklat_tempat" autocomplete="off" required="true" />
                                        </div>
                                        <div class="form-group">
                                            <label>Penyelenggara</label>
                                            <input type="text" class="form-control" name="diklat_penyelenggara" id="diklat_penyelenggara" autocomplete="off" required="true" />
                                        </div>
                                        <div class="form-group">
                                            <label>Angkatan</label>
                                            <input type="text" class="form-control" name="diklat_angkatan" id="diklat_angkatan" autocomplete="off" />
                                        </div>

                                        <div class="form-group">
                                            <label>Mulai</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="diklat_tanggal_mulai" id="diklat_tanggal_mulai" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Selesai</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="diklat_tanggal_selesai" id="diklat_tanggal_selesai" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Bulan</label>
                                            <input type="text" onkeyup="angka(this);" class="form-control" name="diklat_bulan" id="diklat_bulan" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Hari</label>
                                            <input type="text" onkeyup="angka(this);" class="form-control" name="diklat_hari" id="diklat_hari" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Jam</label>
                                            <input type="text" onkeyup="angka(this);" class="form-control" name="diklat_jam" id="diklat_jam" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>No. STPL</label>
                                            <input type="text" class="form-control" name="diklat_sttpl_no" id="diklat_sttpl_no" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tgl STPL</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="diklat_sttpl_tanggal" id="diklat_sttpl_tanggal" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Lulus</label>
                                            <input type="text" onkeyup="angka(this);" maxlength="4" max="<?= date('Y') ?>" class="form-control" name="diklat_tahun" id="diklat_tahun" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" name="diklat_keterangan" id="diklat_keterangan"></textarea>
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
                                    <tr style="text-align: center">
                                        <th scope="col" style="text-align: center;min-width: 30px;width: 50px" rowspan="2" style="text-align: center">NO</th>
                                        <th rowspan="2" style="min-width: 60px;width: 75px" class="text-center">Aksi</th>
                                        <th scope="col" style="text-align: center">DIKLAT</th>
                                        <th scope="col" style="text-align: center">TANGGAL</th>
                                        <th scope="col" style="text-align: center">STPP</th>
                                    </tr>
                                    <tr style="text-align: center">
                                        <th scope="col" style="text-align: center">NAMA <br>TEMPAT<br>PENYELENGGARA<br>ANGKATAN</th>
                                        <th scope="col" style="text-align: center">MULAI<br>SELESAI<br>JML JAM, HARI, BULAN</th>
                                        <th scope="col" style="text-align: center">NOMOR<br>TANGGAL<br>KETERANGAN</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($result->result() as $value) {
                                    ?>
                                        <tr>
                                            <td class="text-center nowrap"><?= $no ?></td>
                                            <td class="text-left nowrap">

                                                <a href="#formadd" onclick="edit('<?= $value->diklat_id ?>')" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i></a>
                                                <a href="<?= site_url('pegawai/PegawaiRiwayatKursus/delete/' . $value->diklat_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Menghapus Data.?')"><i class="fa fa-trash-o fa-fw"></i></a>

                                            </td>
                                            <td>
                                                <?= $value->diklat_nama ?><br>
                                                <?= $value->diklat_tempat ?><br>
                                                <?= $value->diklat_penyelenggara ?><br>
                                                <?= $value->diklat_angkatan ?>
                                            </td>
                                            <td>
                                                <?= tgl_indo($value->diklat_tanggal_mulai) ?><br>
                                                <?= tgl_indo($value->diklat_tanggal_selesai) ?><br>
                                                <?= $value->diklat_jam ?> jam , <?= $value->diklat_hari ?> hari , <?= $value->diklat_bulan ?> bulan
                                            </td>
                                            <td>
                                                <?= $value->diklat_sttpl_no ?><br>
                                                <?= tgl_indo($value->diklat_sttpl_tanggal) ?><br>
                                                <?= $value->diklat_keterangan ?>
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
                    <!-- /.panel-body -->
                </div>

            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(
        function() {


            $('#jenis_jabatan').change(
                function() {
                    var jabatan = $(this).val();
                    // load kedudukan jabatan
                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listJabatanByKedudukanId/') ?>',
                        type: "POST",
                        data: {
                            ajax: '1',
                            id: jabatan
                        },
                        dataType: "html",
                        success: function(data) {
                            //                                        alert(data.id);
                            $('#jabatan').html(data);
                            //$('#jenis_kedudukan_nama').val(data.nama);
                        }
                    });


                }
            );
        }

    );

    function edit(v) {

        $.ajax({

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiDiklatById') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {
                $('#diklat_id').val(data.diklat_id);
                $('#diklat_kode').val(data.diklat_kode).change();
                $('#diklat_keterangan').val(data.diklat_keterangan);
                $('#diklat_nama').val(data.diklat_nama);
                $('#diklat_tempat').val(data.diklat_tempat);
                $('#diklat_penyelenggara').val(data.diklat_penyelenggara);
                $('#diklat_angkatan').val(data.diklat_angkatan);
                $('#diklat_tanggal_mulai').datetextentry('set_date', data.diklat_tanggal_mulai);
                $('#diklat_tanggal_selesai').datetextentry('set_date', data.diklat_tanggal_selesai);
                $('#diklat_jam').val(data.diklat_jam);
                $('#diklat_hari').val(data.diklat_hari);
                $('#diklat_bulan').val(data.diklat_bulan);
                $('#diklat_sttpl_no').val(data.diklat_sttpl_no);
                $('#diklat_sttpl_tanggal').datetextentry('set_date', data.diklat_sttpl_tanggal);
                $('#diklat_tahun').val(data.diklat_tahun);

                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiRiwayatKursus/update') ?>');

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
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiRiwayatKursus/add') ?>');
        document.getElementById('formadd').reset();
    }
</script>