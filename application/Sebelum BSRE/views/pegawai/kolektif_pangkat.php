<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            KENAIKAN PANGKAT
        </h1>
    </section>


    <section class="content">

        <div class="row" id="filter">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-search fa-fw"></i> PENCARIAN
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <div class="form-group">
                                <div class="input-group-addon">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="btn btn-default">NIP</div>
                                            </span>
                                            <input type="text" class="form-control" name="nip" id="nip" value="" required="true" />

                                            <p class="help-block text-danger" id="msgnip"></p>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Tampilkan</button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
        <?php
        if (isset($pegawai)) {
        ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                        </div>
                        <div class="box-body ">
                            <form id="formadd" role="form" action="<?= site_url('pegawai/PegawaiRiwayatPangkat/add') ?>" method="post" enctype="multipart/form-data">
                                <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <b> KEADAAN LAMA</b>
                                        </div>
                                        <div class="panel-body">

                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input type="text" class="form-control" value="<?= $pegawai->pegawai_nip ?>" readonly="true" />
                                            </div>

                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" value="<?= pegawai_nama_lengkap($pegawai) ?>" readonly="true" />
                                            </div>

                                            <div class="form-group">
                                                <label>Pangkat, Golongan/Ruang</label>
                                                <input type="text" class="form-control" value="<?= $pegawai->pegawai_pangkat_terakhir_nama . ', ' . $pegawai->pegawai_pangkat_terakhir_golru ?>" readonly="true" />
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Kenaikan</label>
                                                <input type="text" class="form-control" value="<?= !empty($lama) ? $lama->pegawaipangkat_kenaikan_nama : ''; ?>" readonly="true" />
                                            </div>

                                            <div class="form-group">
                                                <label>TMT</label>
                                                <input type="text" class="form-control" value="<?= d_m_y($pegawai->pegawai_pangkat_terakhir_tmt) ?>" readonly="true" />

                                            </div>

                                            <div class="form-group">
                                                <label>Pejabat Yang Menetapkan</label>
                                                <input type="text" class="form-control" value="<?= $pegawai->pegawai_pangkat_terakhir_pejabat ?>" readonly="true" />

                                            </div>

                                            <div class="form-group">
                                                <label>No SK</label>
                                                <input type="text" class="form-control" name="pegawaipangkat_sk_no" id="pegawaipangkat_sk_no" autocomplete="off" value="<?= $pegawai->pegawai_pangkat_terakhir_sk ?>" />
                                            </div>

                                            <div class="form-group">
                                                <label>Tgl SK</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="off" class="form-control" name="pegawaipangkat_sk_date" id="pegawaipangkat_sk_date" value="<?= d_m_y($pegawai->pegawai_pangkat_terakhir_sk_tgl) ?>" />
                                                    <!-- <span class="input-group-addon">
                                                        <i class="fa fa-calendar text-danger"></i>
                                                    </span> -->
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
                                                            <input type="text" class="form-control" value="<?= $pegawai->pegawai_pangkat_terakhir_tahun ?>" readonly="true" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <div class="btn btn-default">Bulan</div>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $pegawai->pegawai_pangkat_terakhir_bulan ?>" readonly="true" />
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label>Gaji Pokok</label>
                                                <input type="text" class="form-control" value="<?= !empty($lama) ? $lama->pegawaipangkat_gaji_pokok : '' ?>" readonly="true" />
                                            </div>



                                        </div>
                                        <!-- /.panel-body -->
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                        </div>
                        <div class="box-body ">
                            <form id="formadd" role="form" action="<?= site_url('pegawai/KolektifPangkat/add') ?>" method="post" enctype="multipart/form-data">
                                <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <b> KEADAAN BARU</b>
                                        </div>
                                        <div class="panel-body">
                                            <input type="hidden" class="form-control" name="pegawaipangkat_id" id="pegawaipangkat_id" value="<?php
                                                                                                                                                if (isset($pegawai_pangkat)) {
                                                                                                                                                    echo $pegawai_pangkat->pegawaipangkat_id;
                                                                                                                                                }
                                                                                                                                                ?>" />
                                            <input type="hidden" name="pegawaipangkat_unit_kerja_id" value="<?= $pegawai->pegawai_unit_id ?>" />
                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input type="text" class="form-control" value="<?= $pegawai->pegawai_nip ?>" readonly="true" />
                                            </div>

                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" value="<?= pegawai_nama_lengkap($pegawai) ?>" readonly="true" />
                                            </div>

                                            <div class="form-group">
                                                <label>Pangkat, Golongan/Ruang</label>
                                                <select class="form-control" name="pegawaipangkat_pangkat_id" id="pegawaipangkat_pangkat_id" required="true">
                                                    <option value="">--Pilih--</option>
                                                    <?php
                                                    foreach ($pangkat_golongan->result() as $value) {
                                                    ?>
                                                        <option value="<?= $value->pangkat_golongan_kode ?>" <?php
                                                                                                                if (isset($pegawai_pangkat)) {
                                                                                                                    if (!blank($pegawai_pangkat->pegawaipangkat_pangkat_id)) {
                                                                                                                        selected($value->pangkat_golongan_id, $pegawai_pangkat->pegawaipangkat_pangkat_id);
                                                                                                                    }
                                                                                                                }
                                                                                                                ?>><?= $value->pangkat_golongan_text ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Kenaikan</label>
                                                <select class="form-control" name="pegawaipangkat_kenaikan_pangkat_id" id="pegawaipangkat_kenaikan_pangkat_id" required="true">
                                                    <option value="">--Pilih--</option>
                                                    <?php
                                                    foreach ($kenaikan_pangkat->result() as $value) {
                                                    ?>
                                                        <option value="<?= $value->kenaikan_pangkat_id ?>" <?php
                                                                                                            if (isset($pegawai_pangkat)) {
                                                                                                                selected($value->kenaikan_pangkat_id, $pegawai_pangkat->pegawaipangkat_kenaikan_pangkat_id);
                                                                                                            }
                                                                                                            ?>><?= $value->kenaikan_pangkat_nama ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>TMT</label>
                                                <div class="input-group">

                                                    <input type="text" class="form-control dateEntry" required="true" name="pegawaipangkat_tmt" id="pegawaipangkat_tmt" autocomplete="off" value="<?php
                                                                                                                                                                                                    if (isset($pegawai_pangkat)) {
                                                                                                                                                                                                        echo d_m_y($pegawai_pangkat->pegawaipangkat_tmt);
                                                                                                                                                                                                    }
                                                                                                                                                                                                    ?>" />
                                                    <!-- <span class="input-group-addon">
                                                        <i class="fa fa-calendar text-danger"></i>
                                                    </span> -->
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label>Pejabat Yang Menetapkan</label>
                                                <select class="form-control select2" name="pegawaipangkat_sk_pejabat" id="pegawaipangkat_sk_pejabat">
                                                    <option value="">--Pilih--</option>
                                                    <?php
                                                    foreach ($pejabat->result() as $value) {
                                                    ?>
                                                        <option value="<?= $value->pejabat_nama ?>" <?php
                                                                                                    if (isset($pegawai_pangkat)) {
                                                                                                        selected($value->pejabat_nama, $pegawai_pangkat->pegawaipangkat_sk_pejabat);
                                                                                                    }
                                                                                                    ?>><?= $value->pejabat_nama ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <label>No SK</label>
                                                <input type="text" class="form-control" name="pegawaipangkat_sk_no" id="pegawaipangkat_sk_no" autocomplete="off" value="<?php
                                                                                                                                                                        if (isset($pegawai_pangkat)) {
                                                                                                                                                                            echo $pegawai_pangkat->pegawaipangkat_sk_no;
                                                                                                                                                                        }
                                                                                                                                                                        ?>" />
                                            </div>

                                            <div class="form-group">
                                                <label>Tgl SK</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="off" class="form-control dateEntry" name="pegawaipangkat_sk_date" id="pegawaipangkat_sk_date" value="<?php
                                                                                                                                                                                            if (isset($pegawai_pangkat)) {
                                                                                                                                                                                                echo d_m_y($pegawai_pangkat->pegawaipangkat_sk_date);
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>" />
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar text-danger"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group">
                                                <label>Jumlah Kredit</label>
                                                <input type="number" class="form-control" step="0.001" name="pegawaipangkat_angka_kredit" id="pegawaipangkat_angka_kredit" value="<?php
                                                                                                                                                                                    if (isset($pegawai_pangkat)) {
                                                                                                                                                                                        echo $pegawai_pangkat->pegawaipangkat_angka_kredit;
                                                                                                                                                                                    }
                                                                                                                                                                                    ?>" />
                                            </div> -->
                                            <div class="form-group">
                                                <label>Masa Kerja</label>
                                                <div class="input-group-addon">
                                                    <div class="col-lg-6">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <div class="btn btn-default">Tahun</div>
                                                            </span>
                                                            <input type="text" step="1" maxlength="2" onkeyup="angka(this);" class="form-control" id="pegawaipangkat_masa_kerja_tahun" name="pegawaipangkat_masa_kerja_tahun" value="<?php
                                                                                                                                                                                                                                        if (isset($pegawai_pangkat)) {
                                                                                                                                                                                                                                            echo $pegawai_pangkat->pegawaipangkat_masa_kerja_tahun;
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                        ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <div class="btn btn-default">Bulan</div>
                                                            </span>
                                                            <input type="text" step="1" maxlength="2" onkeyup="angka(this);" class="form-control" name="pegawaipangkat_masa_kerja_bulan" id="pegawaipangkat_masa_kerja_bulan" value="<?php
                                                                                                                                                                                                                                        if (isset($pegawai_pangkat)) {
                                                                                                                                                                                                                                            echo $pegawai_pangkat->pegawaipangkat_masa_kerja_bulan;
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                        ?>" onautocomplete="false" />
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label>Gaji Pokok</label>
                                                <input type="text" step="1" onkeyup="angka(this);" class="form-control" id="pegawaipangkat_gaji_pokok" name="pegawaipangkat_gaji_pokok" value="<?php
                                                                                                                                                                                                if (isset($pegawai_pangkat)) {
                                                                                                                                                                                                    echo $pegawai_pangkat->pegawaipangkat_gaji_pokok;
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>" />
                                            </div>
                                            <div class="form-group hide">
                                                <label>Jenis Jabatan</label>
                                                <select class="form-control" name="pengawaipangkat_jenis_jabatan_id" id="jenis_jabatan">
                                                    <option value="">--Pilih--</option>
                                                    <?php
                                                    foreach ($kedudukan_jabatan->result() as $value) {
                                                    ?>
                                                        <option value="<?= $value->jeniskedudukan_kode ?>" <?php
                                                                                                            selected($value->jeniskedudukan_kode, $pegawai->pegawai_jenisjabatan_kode);
                                                                                                            ?>><?= $value->jeniskedudukan_nama ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group hide">
                                                <label>Nama Jabatan</label>
                                                <select class="form-control select2" name="pegawaipangkat_jabatan_id" id="jabatan">
                                                    <option value="">--Pilih--</option>
                                                    <?php
                                                    foreach ($jabatan->result() as $value) {
                                                    ?>
                                                        <option value="<?= $value->jabatan_id ?>" <?php
                                                                                                    selected($value->jabatan_id, $pegawai->pegawai_jabatan_id);
                                                                                                    ?>><?= $value->jabatan_nama ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>




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
            </div>

        <?php
        }
        ?>

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

    $('#pegawaipangkat_masa_kerja_tahun').keyup(function(e) {
        var target = e.srcElement || e.target;
        var maxLength = parseInt(target.attributes["maxlength"].value, 10);
        var myLength = target.value.length;
        // alert(myLength);
        // return false;
        if (myLength >= maxLength) {
            var next = $('#pegawaipangkat_masa_kerja_bulan');
            next.focus();
        }
    });



    function edit(v) {

        $.ajax({

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiPangkatById') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {
                $('#pegawaipangkat_id').val(data.pegawaipangkat_id);
                $('#pegawaipangkat_pangkat_id').val(data.pegawaipangkat_pangkat_id).change();
                $('#pegawaipangkat_kenaikan_pangkat_id').val(data.pegawaipangkat_kenaikan_id).change();
                $('#pegawaipangkat_tmt').val(data.pegawaipangkat_tmt);
                $('#pegawaipangkat_sk_date').val(data.pegawaipangkat_sk_date);
                $('#pegawaipangkat_sk_no').val(data.pegawaipangkat_sk_no);
                $('#pegawaipangkat_sk_pejabat').val(data.pegawaipangkat_sk_pejabat).change();
                $('#pegawaipangkat_angka_kredit').val(data.pegawaipangkat_angka_kredit);
                $('#pegawaipangkat_masa_kerja_tahun').val(data.pegawaipangkat_masa_kerja_tahun);
                $('#pegawaipangkat_masa_kerja_bulan').val(data.pegawaipangkat_masa_kerja_bulan);
                $('#pegawaipangkat_gaji_pokok').val(data.pegawaipangkat_gaji_pokok);
                $('#pegawaipangkat_unit_kerja_id').val(data.pegawaipangkat_unit_kerja_id).change();
                $('#jenis_jabatan').val(data.pegawaipangkat_jenis_jabatan_id);
                var pegawaipangkat_jabatan_id = data.pegawaipangkat_jabatan_id;
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
                        $('#jabatan').val(pegawaipangkat_jabatan_id).change();
                    }
                });
                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiRiwayatPangkat/update') ?>');

            }
        });

    }

    function refresh() {
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiRiwayatPangkat/add') ?>');
        $('#jabatan').html('<option>--Pilih--</option>');
        document.getElementById('formadd').reset();
    }
</script>