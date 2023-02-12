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
                        <form id="formidentitas" role="form" enctype="multipart/form-data" action="<?= site_url('pegawai/PegawaiCpns/update') ?>" method="post" onsubmit="return validasiInput()">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />

                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> PENGANGKATAN SEBAGAI CPNS</b>
                                    </div>
                                    <div class="panel-body">

<!--                                         <div class="form-group">
                                            <label>Nota Persetujuan BKN No *</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control col-lg-4" name="pegawai_cpns_nota" value="<?= $pegawai->pegawai_cpns_nota ?>" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal *</div>
                                                        </span>
                                                        <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawai_cpns_date" id="datepicker" value="<?= !empty($pegawai->pegawai_cpns_date) ? d_m_y($pegawai->pegawai_cpns_date) : ''; ?>" autocomplete="off" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar text-danger"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <label>Jenis Pengadaan</label>
                                            <select style="width: 100%" class="form-control " name="pegawai_cpns_jenis_pengadaan" id="pegawai_cpns_jenis_pengadaan">
                                            	<option <?= selected('1', $pegawai->pegawai_cpns_jenis_pengadaan) ?> value="1">UMUM</option>
                                            	<option <?= selected('2', $pegawai->pegawai_cpns_jenis_pengadaan) ?>  value="2">DISABILITAS</option>
                                            	<option <?= selected('3', $pegawai->pegawai_cpns_jenis_pengadaan) ?>  value="3">HONORER</option>
                                            	<option <?= selected('4', $pegawai->pegawai_cpns_jenis_pengadaan) ?>  value="4">P3K</option>
                                            	<option <?= selected('5', $pegawai->pegawai_cpns_jenis_pengadaan) ?>  value="5">PTT KEMENKES</option>
                                            	<option <?= selected('6', $pegawai->pegawai_cpns_jenis_pengadaan) ?>  value="6">GURU GARIS DEPAN</option>
                                            	<option <?= selected('7', $pegawai->pegawai_cpns_jenis_pengadaan) ?>  value="7">TENAGA  HARIAN LEPAS-TENAGA BANTU PENYULUH PERTANIAN (THL-TBPP)</option>       
                                        </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pejabat Yang Menetapkan</label>
                                            <select style="width: 100%" class="form-control " name="pegawai_cpns_pejabat" id="pegawai_cpns_pejabat">
                                                <?php
                                                foreach ($pejabat->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pejabat_nama ?>" <?= selected($value->pejabat_nama, $pegawai->pegawai_cpns_pejabat) ?>><?= $value->pejabat_nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>No SK CPNS</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control col-lg-4" name="pegawai_cpns_sk_no" value="<?= $pegawai->pegawai_cpns_sk_no ?>" autocomplete="off" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal</div>
                                                        </span>
                                                        <input type="text" class="form-control dateEntry2" placeholder="dd/mm/yyyy" name="pegawai_cpns_sk_date" id="datepicker" value="<?= !empty($pegawai->pegawai_cpns_sk_date) ? d_m_y($pegawai->pegawai_cpns_sk_date) : ''; ?>" autocomplete="off" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar text-danger"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>Pangkat Golongan</label>
                                            <select class="form-control" name="pegawai_cpns_pangkat_id" id="pegawai_cpns_pangkat_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pangkat_golongan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pangkat_golongan_id ?>" <?= selected($value->pangkat_golongan_id, $pegawai->pegawai_cpns_pangkat_id) ?>><?= $value->pangkat_golongan_text ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>TMT CPNS</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control dateEntry2" placeholder="dd/mm/yyyy" name="pegawai_cpns_tmt" id="pegawai_cpns_tmt" value="<?= !empty($pegawai->pegawai_cpns_tmt) ? d_m_y($pegawai->pegawai_cpns_tmt) : ''; ?>" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label>Pendidikan Masuk CPNS</label>
                                            <select class="form-control" name="pegawai_cpns_pendidikan_tingkat" id="pegawai_cpns_pendidikan_tingkat">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pendidikan_tingkat->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pendidikan_tingkat_kode ?>" <?= selected($value->pendidikan_tingkat_kode, $pegawai->pegawai_cpns_pendidikan_tingkat) ?>><?=  $value->pendidikan_tingkat_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>TMT Melaksanakan Tugas</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control dateEntry2" placeholder="dd/mm/yyyy" name="pegawai_cpns_tmt_tugas" id="pegawai_cpns_tmt_tugas" value="<?= !empty($pegawai->pegawai_cpns_tmt_tugas) ? d_m_y($pegawai->pegawai_cpns_tmt_tugas) : ''; ?>" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Masa Kerja Golongan</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <input type="text" onkeyup="angka(this);" maxlength="2" class="form-control" name="pegawai_cpns_masa_kerja_tahun" value="<?= $pegawai->pegawai_cpns_masa_kerja_tahun ?>" id="pegawai_cpns_masa_kerja_tahun" />
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tahun</div>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <input type="text" onkeyup="angka(this);" maxlength="2" class="form-control" name="pegawai_cpns_masa_kerja_bulan" value="<?= $pegawai->pegawai_cpns_masa_kerja_bulan ?>" id="pegawai_cpns_masa_kerja_bulan" />
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Bulan</div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label>LatPraJabatan</label>
                                            <div class="input-group">
<!--                                                 <input type="text" class="form-control" placeholder="" name="pegawai_cpns_lat_jabatan" id="pegawai_cpns_lat_jabatan" value="<?= $pegawai->pegawai_cpns_lat_jabatan; ?>" autocomplete="off" /> -->
                                            	<select name="pegawai_cpns_lat_jabatan" id="pegawai_cpns_lat_jabatan" class="form-control">
                                                	<option value="0">Pilih</option>
                                                	<option <?= $pegawai->pegawai_cpns_lat_jabatan == '1' ? 'selected' : ''; ?> value="1">Diklat prajab/latsar gol I</option>
                                                	<option <?= $pegawai->pegawai_cpns_lat_jabatan == '2' ? 'selected' : ''; ?>  value="2">Diklat prajab/latsar gol II</option>
                                               		<option <?= $pegawai->pegawai_cpns_lat_jabatan == '3' ? 'selected' : ''; ?>  value="3">Diklat prajab/latsar gol III</option>
                                            	</select>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label>Tahun LatPraJabatan</label>
                                            <div class="input-group">
                                                <input type="text" onkeyup="angka(this);" maxlength="4" class="form-control" placeholder="" name="pegawai_cpns_lat_jabatan_tahun" id="pegawai_cpns_lat_jabatan_tahun" value="<?= $pegawai->pegawai_cpns_lat_jabatan_tahun; ?>" autocomplete="off" />
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
                        <form >
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />

                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> PENGANGKATAN SEBAGAI CPNS</b>
                                    <button class="btn btn-primary btn-sm pull-right" type="button" id="ubahtod">Ubah</button>
                                    </div>
                                    <div class="panel-body">

<!--                                         <div class="form-group">
                                            <label>Nota Persetujuan BKN No *</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control col-lg-4" name="pegawai_cpns_nota" value="<?= $pegawai->pegawai_cpns_nota ?>" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal *</div>
                                                        </span>
                                                        <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawai_cpns_date" id="datepicker" value="<?= !empty($pegawai->pegawai_cpns_date) ? d_m_y($pegawai->pegawai_cpns_date) : ''; ?>" autocomplete="off" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar text-danger"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div> -->
                                    	
                                        <div class="form-group">
                                            <label>Jenis Pengadaan</label>
                                            <select class="form-control " disabled>
                                            	<option <?= selected('1', $pegawai->pegawai_cpns_jenis_pengadaan) ?> value="1">UMUM</option>
                                            	<option <?= selected('2', $pegawai->pegawai_cpns_jenis_pengadaan) ?>  value="2">DISABILITAS</option>
                                            	<option <?= selected('3', $pegawai->pegawai_cpns_jenis_pengadaan) ?>  value="3">HONORER</option>
                                            	<option <?= selected('4', $pegawai->pegawai_cpns_jenis_pengadaan) ?>  value="4">P3K</option>
                                            	<option <?= selected('5', $pegawai->pegawai_cpns_jenis_pengadaan) ?>  value="5">PTT KEMENKES</option>
                                            	<option <?= selected('6', $pegawai->pegawai_cpns_jenis_pengadaan) ?>  value="6">GURU GARIS DEPAN</option>
                                           		<option <?= selected('7', $pegawai->pegawai_cpns_jenis_pengadaan) ?>  value="7">TENAGA  HARIAN LEPAS-TENAGA BANTU PENYULUH PERTANIAN (THL-TBPP)</option>       
                                        	</select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pejabat Yang Menetapkan</label>
                                            <select class="form-control " disabled>
                                                <?php
                                                foreach ($pejabat->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pejabat_nama ?>" <?= selected($value->pejabat_nama, $pegawai->pegawai_cpns_pejabat) ?>><?= $value->pejabat_nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>No SK CPNS</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-6">
                                                    <input type="text" readonly class="form-control col-lg-4" value="<?= $pegawai->pegawai_cpns_sk_no ?>" autocomplete="off" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal</div>
                                                        </span>
                                                        <input type="text" class="form-control" placeholder="dd/mm/yyyy" readonly value="<?= tgl($pegawai->pegawai_cpns_sk_date) ?>" autocomplete="off" />
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
                                                    <option value="<?= $value->pangkat_golongan_id ?>" <?= selected($value->pangkat_golongan_id, $pegawai->pegawai_cpns_pangkat_id) ?>><?= $value->pangkat_golongan_text ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>TMT CPNS</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control " readonly placeholder="dd/mm/yyyy" value="<?= tgl($pegawai->pegawai_cpns_tmt) ?>" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label>Pendidikan Masuk CPNS</label>
                                            <select class="form-control" disabled >
                                                <option value=""></option>
                                                <?php
                                                foreach ($pendidikan_tingkat->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pendidikan_tingkat_kode ?>" <?= selected($value->pendidikan_tingkat_kode, $pegawai->pegawai_cpns_pendidikan_tingkat) ?>><?=  $value->pendidikan_tingkat_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>TMT Melaksanakan Tugas</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="dd/mm/yyyy" readonly value="<?= tgl($pegawai->pegawai_cpns_tmt_tugas) ?>" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Masa Kerja Golongan</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <input type="text" onkeyup="angka(this);" readonly maxlength="2" class="form-control"  value="<?= $pegawai->pegawai_cpns_masa_kerja_tahun ?>" />
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tahun</div>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <input type="text" onkeyup="angka(this);" readonly maxlength="2" class="form-control" value="<?= $pegawai->pegawai_cpns_masa_kerja_bulan ?>"  />
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Bulan</div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label>LatPraJabatan</label>
                                            <div class="input-group">
                                                <select disabled name="pegawai_cpns_lat_jabatan" id="pegawai_cpns_lat_jabatan" class="form-control">
                                                	<option value="0">Pilih</option>
                                                	<option <?= $pegawai->pegawai_cpns_lat_jabatan == '1' ? 'selected' : ''; ?> value="1">Diklat prajab/latsar gol I</option>
                                                	<option <?= $pegawai->pegawai_cpns_lat_jabatan == '2' ? 'selected' : ''; ?>  value="2">Diklat prajab/latsar gol II</option>
                                               		<option <?= $pegawai->pegawai_cpns_lat_jabatan == '3' ? 'selected' : ''; ?>  value="3">Diklat prajab/latsar gol III</option>
                                            	</select> </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label>Tahun LatPraJabatan</label>
                                            <div class="input-group">
                                                <input type="text" onkeyup="angka(this);" maxlength="4" class="form-control" readonly placeholder="" value="<?= $pegawai->pegawai_cpns_lat_jabatan_tahun; ?>" autocomplete="off" />
                                            </div>
                                        </div>
                                    
<!--                                         <div class="input-group-addon">
                                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalSimpan">Simpan</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                        </div> -->
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
            //Date picker
            $('.date').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });

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
        

    $('#pegawai_cpns_masa_kerja_tahun').keyup(function(e) {
        var target = e.srcElement || e.target;
        var maxLength = parseInt(target.attributes["maxlength"].value, 10);
        var myLength = target.value.length;
        // alert(myLength);
        // return false;
        if (myLength >= maxLength) {
            var next = $('#pegawai_cpns_masa_kerja_bulan');
            next.focus();
        }
    });
        
        
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