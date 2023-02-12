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
                    <div class="box-body table-responsive">
                        <form id="formidentitas" role="form" enctype="multipart/form-data" action="<?= site_url('pegawai/PegawaiPensiun/update') ?>" method="post" onsubmit="return validasiInput()">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />

                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> PENSIUN SEBAGAI PNS</b>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label>Jenis Pensiun</label>
                                            <select class="form-control" name="pegawai_jenis_pensiun_id" id="pegawai_jenis_pensiun_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($jenis_pensiun->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jenis_pensiun_id ?>" <?= selected($value->jenis_pensiun_id, $pegawai->pegawai_jenis_pensiun_id) ?>><?= $value->jenis_pensiun_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group" id="div-sk">
                                            <label>No SK PENSIUN</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control col-lg-4" name="pegawai_pensiun_sk_no" value="<?= $pegawai->pegawai_pensiun_sk_no ?>" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal</div>
                                                        </span>
                                                        <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawai_pensiun_tanggal" id="pegawai_pensiun_tanggal" value="" autocomplete="off" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar text-danger"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group" id="div-pejabat">
                                            <label>Pejabat Yang Menetapkan</label>
                                            <select class="form-control " name="pegawai_pensiun_pejabat" id="pegawai_pensiun_pejabat">
                                                <?php
                                                foreach ($pejabat->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pejabat_nama ?>" <?= selected($value->pejabat_nama, $pegawai->pegawai_pensiun_pejabat) ?>><?= $value->pejabat_nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>TMT PENSIUN</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawai_pensiun_tmt" id="pegawai_pensiun_tmt" value="<?= $pegawai->pegawai_pensiun_tmt ?>" autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar text-danger"></i>
                                                </span>
                                            </div>

                                        </div>

                                        <div class="input-group-addon">
                                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalSimpan">Simpan</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
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
    </section>
</div>
<script>
    $(document).ready(
        function() {
            $('#pegawai_jenis_pensiun_id').change(
                function() {
                    if ($(this).val() != '') {

                        if ($(this).val() == 10 || $(this).val() == 11) {
                            // show 
                            $('#div-sk').hide();
                            $('#div-pejabat').hide();
                        } else {
                            $('#div-sk').show();
                            $('#div-pejabat').show();
                        }
                    }
                }
            );
            $('#opd').change(
                function() {
                    if ($(this).val() != '') {

                        // load sub unit
                        $.ajax({
                            url: '<?= site_url('referensi/ReferensiJson/listSubUnitByIdUnit/') ?>' + $(this).val(),
                            type: "POST",
                            data: {
                                ajax: '1'
                            },
                            dataType: "html",
                            success: function(data) {
                                $('#parent').html(data);
                                $('#parent').removeAttr('disabled');
                            }
                        });

                    }
                }
            );

            $('#propinsi').change(
                function() {
                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listKabupatenByIdPropinsi/') ?>' + $('#propinsi').val(),
                        type: "POST",
                        data: {
                            ajax: '1'
                        },
                        dataType: "html",
                        success: function(data) {
                            $('#kabupaten').html(data);
                        }
                    });
                }
            );

            $('#kabupaten').change(
                function() {
                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listKecamatanByIdKabupaten/') ?>' + $('#kabupaten').val(),
                        type: "POST",
                        data: {
                            ajax: '1'
                        },
                        dataType: "html",
                        success: function(data) {
                            $('#kecamatan').html(data);
                        }
                    });
                }
            );

            $('#kecamatan').change(
                function() {
                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listKelurahanByIdKecamatan/') ?>' + $('#kecamatan').val(),
                        type: "POST",
                        data: {
                            ajax: '1'
                        },
                        dataType: "html",
                        success: function(data) {
                            $('#kelurahan').html(data);
                        }
                    });
                }
            );

            $('#status_pegawai').change(
                function() {
                    var status = $('#status_pegawai').val();
                    if (status === "1" || status === "2") {
                        $('#panelpns').removeClass('hide');
                        $('#panelcpns').removeClass('hide');
                    } else {}
                }
            );
            $('#kedudukan_pegawai').change(
                function() {
                    var status = $('#kedudukan_pegawai').val();
                    if (status === "1") {
                        $('#aktif').removeClass('hide');
                        $('#meninggal').addClass('hide');
                    } else if (status === "10") {
                        $('#aktif').addClass('hide');
                        $('#meninggal').removeClass('hide');
                    } else {
                        $('#aktif').addClass('hide');
                        $('#meninggal').addClass('hide');
                    }
                }
            );
            $('#kedudukan_jabatan').change(
                function() {
                    if ($(this).val() != '') {

                        if ($('#status_pegawai').val() <= 2) {

                            // load kedudukan jabatan
                            $.ajax({
                                url: '<?= site_url('referensi/ReferensiJson/getJenisKedudukanByJabatan/') ?>' + $(this).val(),
                                type: "POST",
                                data: {
                                    ajax: '1'
                                },
                                dataType: "json",
                                success: function(data) {
                                    //                                        alert(data.id);
                                    $('#jenis_kedudukan').val(data.id);
                                    //$('#jenis_kedudukan_nama').val(data.nama);
                                }
                            });
                        }
                    }
                }
            );
            $('#status_pegawai').change(
                function() {
                    if ($(this).val() != '') {

                        if ($(this).val() > 2) {

                            // show 
                            $('#panelpns').addClass('hide');
                            $('#panelcpns').addClass('hide');
                        } else {
                            $('#panelpns').removeClass('hide');
                            $('#panelcpns').removeClass('hide');
                        }
                    }
                }
            );
        }

    );
</script>