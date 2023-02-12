<style>
.select2-container{
width: 100%;
}
</style>
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
            <div class="col-md-8 hide" id="form-edit">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body table-responsive">
                        <form id="formidentitas" role="form" enctype="multipart/form-data" action="<?= site_url('pegawai/PegawaiPns/update') ?>" method="post" onsubmit="return validasiInput()">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />

                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> PENGANGKATAN SEBAGAI PNS</b>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label>Pejabat Yang Menetapkan</label><br>
                                            <select style="width: 100%" class="form-control select2" name="pegawai_pns_pejabat" id="pegawai_pns_pejabat">
                                                <?php
                                                foreach ($pejabat->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pejabat_nama ?>" <?= selected($value->pejabat_nama, $pegawai->pegawai_pns_pejabat) ?>><?= $value->pejabat_nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>No SK PNS</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control col-lg-4" name="pegawai_pns_sk_no" value="<?= $pegawai->pegawai_pns_sk_no ?>" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal</div>
                                                        </span>
                                                        <input type="text" class="form-control dateEntry2" readonly placeholder="dd/mm/yyyy" name="pegawai_pns_sk_date" id="pegawai_pns_sk_date" value="<?= d_m_y($pegawai->pegawai_pns_sk_date) ?>" autocomplete="off" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar text-danger"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label>Pangkat Golongan</label>
                                            <select class="form-control" name="pegawai_pns_pangkat_id" id="pegawai_pns_pangkat_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pangkat_golongan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pangkat_golongan_kode ?>" <?= selected($value->pangkat_golongan_kode, $pegawai->pegawai_pns_pangkat_id) ?>><?= $value->pangkat_golongan_text ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>TMT PNS</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control dateEntry2" placeholder="dd/mm/yyyy" name="pegawai_pns_tmt" id="pegawai_pns_tmt" value="<?= d_m_y($pegawai->pegawai_pns_tmt) ?>" autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar text-danger"></i>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>Sumpah / Janji</label>
                                            <select class="form-control" name="pegawai_pns_sumpah_id" id="pegawai_pns_sumpah_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($kondisi_sumpah->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->kondisisumpah_id ?>" <?= selected($value->kondisisumpah_id, $pegawai->pegawai_pns_sumpah_id) ?>><?= $value->kondisisumpah_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
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
            <div class="col-md-4 hide" id="menu-edit">
                <div class="box">

                    <div class="box-body">
                        <?= $menu_pegawai ?>
                    </div>
                </div>
            </div>
        
        
            <div class="col-md-8" id="form-read">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body table-responsive">
                        <form>
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />

                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> PENGANGKATAN SEBAGAI PNS</b>
                                    <button class="btn btn-primary btn-sm pull-right" type="button" id="ubahtod">Ubah</button>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label>Pejabat Yang Menetapkan</label>
                                            <input  value="<?= $pegawai->pegawai_pns_pejabat ?>" type="text" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>No SK PNS</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-6">
                                                    <input type="text" readonly class="form-control" value="<?= $pegawai->pegawai_pns_sk_no ?>" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal</div>
                                                        </span>
                                                        <input type="text" class="form-control" readonly placeholder="dd/mm/yyyy" value="<?= tgl($pegawai->pegawai_pns_sk_date) ?>" autocomplete="off" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar text-danger"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label>Pangkat Golongan</label>
                                            <select class="form-control" disabled>
                                                <option value=""></option>
                                                <?php
                                                foreach ($pangkat_golongan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pangkat_golongan_kode ?>" <?= selected($value->pangkat_golongan_kode, $pegawai->pegawai_pns_pangkat_id) ?>><?= $value->pangkat_golongan_text ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>TMT PNS</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control" readonly placeholder="dd/mm/yyyy" value="<?= tgl($pegawai->pegawai_pns_tmt) ?>" autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar text-danger"></i>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>Sumpah / Janji</label>
                                            <select class="form-control" disabled>
                                                <option value=""></option>
                                                <?php
                                                foreach ($kondisi_sumpah->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->kondisisumpah_id ?>" <?= selected($value->kondisisumpah_id, $pegawai->pegawai_pns_sumpah_id) ?>><?= $value->kondisisumpah_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>


                                    </div>
                                    <!-- /.panel-body -->
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="menu-read">
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
        
        $('#ubahtod').on('click', function(){
            	$('#form-edit').removeClass('hide');
            	$('#menu-edit').removeClass('hide');
            	$('#form-read').addClass('hide');
            	$('#menu-read').addClass('hide');
            $('.dateEntry2').datetextentry({
      show_tooltips: false,
      errorbox_x: -135,
      errorbox_y: 28
    });
            })
        }

    );
</script>