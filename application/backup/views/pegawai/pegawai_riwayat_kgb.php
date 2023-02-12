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
                        <form id="formadd" role="form" action="<?= site_url('pegawai/PegawaiRiwayatKgb/add') ?>" method="post" enctype="multipart/form-data">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> RIWAYAT KENAIKAN GAJI BERKALA</b>
                                    </div>
                                    <div class="panel-body">
                                        <input type="hidden" class="form-control" name="pegawaikgb_id" id="pegawaikgb_id" />
<!--                                         <div class="form-group">
                                            <label>Unit Kerja</label>
                                            <select class="form-control select2" name="pegawaikgb_unit_kerja_id" id="pegawaikgb_unit_kerja_id">
                                                <?php
                                                foreach ($unit->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->unit_id ?>" <?php
                                                                                            selected($value->unit_id, $pegawai->pegawai_unit_id);
                                                                                            ?>><?= $value->unit_nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div> -->

                                        <div class="form-group">
                                            <label>Pangkat, Golongan/Ruang</label>
                                            <select class="form-control" name="pegawaikgb_pangkat_id" id="pegawaikgb_pangkat_id" required="true">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pangkat_golongan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pangkat_golongan_id ?>" <?php
                                                                                                        selected($value->pangkat_golongan_id, $pegawai->pegawai_pangkat_terakhir_id);
                                                                                                        ?>><?= $value->pangkat_golongan_text ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>TMT Berkala</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" required="true" name="pegawaikgb_tmt" id="pegawaikgb_tmt" autocomplete="off" value="" />
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar text-danger"></i>
                                                </span>
                                            </div>

                                        </div>

                                        <div class="form-group hide">
                                            <label>Pejabat Yang Menetapkan</label>
                                            <select class="form-control " name="pegawaikgb_pejabat" id="pegawaikgb_pejabat">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pejabat->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pejabat_nama ?>"><?= $value->pejabat_nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>No SK</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control col-lg-6" name="pegawaikgb_sk_no" autocomplete="off" id="pegawaikgb_sk_no" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal</div>
                                                        </span>
                                                        <input type="text" autocomplete="off" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaikgb_sk_tanggal" id="pegawaikgb_sk_tanggal" value="" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar text-danger"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label>Masa Kerja</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tahun</div>
                                                        </span>
                                                        <input type="text" onkeyup="angka(this);" maxlength="2"  class="form-control" id="pegawaikgb_masa_kerja_tahun" name="pegawaikgb_masa_kerja_tahun" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Bulan</div>
                                                        </span>
                                                        <input type="text" onkeyup="angka(this);" maxlength="2"  class="form-control" name="pegawaikgb_masa_kerja_bulan" id="pegawaikgb_masa_kerja_bulan" onautocomplete="false" />
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label>Gaji Pokok</label>
                                            <input type="text" onkeyup="angka(this);" class="form-control" id="pegawaikgb_gaji" name="pegawaikgb_gaji" value="" />
                                        </div>
<!--                                         <div class="form-group">
                                            <label>Jenis Jabatan</label>
                                            <select class="form-control" name="pegawaikgb_jenis_jabatan_id" id="pegawaikgb_jenis_jabatan_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($jenis_jabatan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jeniskedudukan_kode ?>" <?php
                                                                                                        selected($value->jeniskedudukan_kode, $pegawai->pegawai_jenisjabatan_kode);
                                                                                                        ?>><?= $value->jeniskedudukan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Jabatan</label>
                                            <select class="form-control select2" name="pegawaikgb_jabatan_id" id="pegawaikgb_jabatan_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                // foreach ($jabatan->result() as $value) {
                                                // ?>
                                                //     <option value="<?= $value->jabatan_id ?>" <?php
                                                //                                                 selected($value->jabatan_id, $pegawai->pegawai_jabatan_id)
                                                //                                                 ?>><?= $value->jabatan_nama ?></option>
                                                // <?php
                                                // }
                                                ?>
                                            </select>
                                        </div> -->




                                        <div class="input-group-addon">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            <button type="button" onclick="refresh()" class="btn btn-default">Reset</button>
                                        </div>
                                        <?= modalSimpan() ?>

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
                        <a href="#" onclick="formadd.reset()" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Riwayat
                    </div>
                    <div class="panel-body">
                        <div class="box-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gaji</th>
                                        <th>SK</th>
                                        <th>Masa Kerja</th>
                                        <th>Pangkat Golru</th>
<!--                                         <th>Jabatan</th>
                                        <th>OPD/Unit Kerja</th> -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($result->result() as $value) {
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= angka($value->pegawaikgb_gaji) . ' <br/> TMT. ' . tgl_indo($value->pegawaikgb_tmt) ?></td>
                                            <td><?= 'No.' . $value->pegawaikgb_sk_no . '<br/> Tgl. ' . tgl_indo($value->pegawaikgb_sk_tanggal)  ?></td>
                                            <td><?= $value->pegawaikgb_masa_kerja_tahun . ' th ' . $value->pegawaikgb_masa_kerja_bulan . ' bln' ?></td>
                                            <td><?= $value->pegawaikgb_pangkat_text ?></td>
                                            <td style="min-width: 75px">
                                                <a href="#formadd" onclick="edit('<?= $value->pegawaikgb_id ?>');" class="btn btn-warning btn-sm" type="button"><i class="fa fa-edit"></i></a>
                                                <a href="<?= site_url('pegawai/PegawaiRiwayatKgb/delete/' . $value->pegawaikgb_id) ?>" onclick="return confirm('Apakah anda yakin menghapus riwayat kenaikan gaji.?');" class="btn btn-danger btn-sm" type="button"><i class="fa fa-trash-o"></i></a>
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


            $.ajax({
                url: '<?= site_url('referensi/ReferensiJson/listJabatanByKedudukanId/') ?>',
                type: "POST",
                data: {
                    ajax: '1',
                    id: $('#pegawaikgb_jenis_jabatan_id').val()
                },
                dataType: "html",
                success: function(data) {
                    //                                        alert(data.id);
                    $('#pegawaikgb_jabatan_id').html(data);
                    //$('#jenis_kedudukan_nama').val(data.nama);
                }
            });

            $('#pegawaikgb_jenis_jabatan_id').change(
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
                            $('#pegawaikgb_jabatan_id').html(data);
                            //$('#jenis_kedudukan_nama').val(data.nama);
                        }
                    });


                }
            );
        }

    );


            $('#pegawaikgb_pangkat_id').change(
                function() {
                    var pangkat = $(this).val();
                    var masa = $('#pegawaikgb_masa_kerja_tahun').val();
                    // load kedudukan jabatan
                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/getJumlahGajiByPangkatMasaKerja/') ?>',
                        type: "POST",
                        data: {
                            ajax: '1',
                            pangkat: pangkat,
                            masa: masa,
                        },
                        dataType: "html",
                        success: function(data) {
                            $('#pegawaikgb_gaji').val(data);
                        }
                    });


                }
            );


    $('#pegawaikgb_masa_kerja_tahun').keyup(function(e) {
        var target = e.srcElement || e.target;
        var maxLength = parseInt(target.attributes["maxlength"].value, 10);
        var myLength = target.value.length;
        // alert(myLength);
        // return false;
        var masa = $(this).val();
        var pangkat = $('#pegawaikgb_pangkat_id').val();
        // load kedudukan jabatan
        $.ajax({
            url: '<?= site_url('referensi/ReferensiJson/getJumlahGajiByPangkatMasaKerja/') ?>',
            type: "POST",
            data: {
                ajax: '1',
                pangkat: pangkat,
                masa: masa,
            },
            dataType: "html",
            success: function(data) {
                $('#pegawaikgb_gaji').val(data);
            }
        });
    
        if (myLength >= maxLength) {
            var next = $('#pegawaikgb_masa_kerja_bulan');
            next.focus();
        }
    });


    function edit(v) {

        $.ajax({

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiKgbById') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {
                // pegawaikgb_tmt = d_m_y(data.pegawaikgb_tmt);
                // pegawaikgb_sk_tanggal = d_m_y(data.pegawaikgb_sk_tanggal);

                $('#pegawaikgb_id').val(data.pegawaikgb_id);
                $('#pegawaikgb_pangkat_id').val(data.pegawaikgb_pangkat_id).change();
                $('#pegawaijabatan_kenaikan_id').val(data.pegawaijabatan_kenaikan_id).change();
                $('#pegawaikgb_tmt').datetextentry('set_date', data.pegawaikgb_tmt);
                $('#pegawaikgb_sk_tanggal').datetextentry('set_date', data.pegawaikgb_sk_tanggal);
                $('#pegawaikgb_sk_no').val(data.pegawaikgb_sk_no);
                $('#pegawaikgb_masa_kerja_tahun').val(data.pegawaikgb_masa_kerja_tahun);
                $('#pegawaikgb_masa_kerja_bulan').val(data.pegawaikgb_masa_kerja_bulan);
                $('#pegawaikgb_gaji').val(data.pegawaikgb_gaji);
                $('#pegawaikgb_unit_kerja_id').val(data.pegawaikgb_unit_kerja_id).change();
                $('#jenis_jabatan').val(data.pegawaikgb_jenis_jabatan_id);
                var pegawaikgb_jabatan_id = data.pegawaikgb_jabatan_id;
                var jabatan = $('#jenis_jabatan').val();
                $.ajax({
                    url: '<?= site_url('referensi/ReferensiJson/listJabatanByKedudukanId/') ?>',
                    type: "POST",
                    data: {
                        ajax: '1',
                        id: jabatan
                    },
                    dataType: "html",
                    success: function(data) {
                        $('#jabatan').html(data);
                        $('#jabatan').val(pegawaikgb_jabatan_id).change();
                    }
                });
                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiRiwayatKgb/update') ?>');

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
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiRiwayatKgb/add') ?>');
        document.getElementById('formadd').reset();
    }
</script>