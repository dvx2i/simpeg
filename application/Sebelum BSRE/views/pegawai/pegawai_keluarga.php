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
                        <form id="formadd" role="form" action="<?= site_url('pegawai/PegawaiKeluarga/add') ?>" method="post" enctype="multipart/form-data">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> RIWAYAT KELUARGA</b>
                                    </div>
                                    <div class="panel-body">
                                        <input type="hidden" class="form-control" name="pegawaikeluarga_id" id="pegawaikeluarga_id" />
										<div class="form-group">
                                            <label>Status MD</label>
                                            
                <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="md" id="inlineRadio1" value="n">
                    <label class="form-check-label" for="inlineRadio1">Tidak</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="md" id="inlineRadio2" value="y">
                    <label class="form-check-label" for="inlineRadio2">Ya</label>
                </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Keluarga</label>
                                            <select class="form-control" name="pegawaikeluarga_status_keluarga_id" id="pegawaikeluarga_status_keluarga_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($status_keluarga->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->statuskeluarga_id ?>"><?= $value->statuskeluarga_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group" id="div-nama">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="pegawaikeluarga_nama" id="pegawaikeluarga_nama" autocomplete="off" />
                                        </div>
                                        <div class="form-group" id="div-3">
                                            <label>Tempat Lahir</label>
                                            <input type="text" class="form-control" name="pegawaikeluarga_tempat_lahir" id="pegawaikeluarga_tempat_lahir" autocomplete="off" />
                                        </div>


                                        <div class="form-group"  id="div-4">
                                            <label>Tanggal Lahir</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaikeluarga_tanggal_lahir" id="pegawaikeluarga_tanggal_lahir" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="form-group" id="div-5">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" name="pegawaikeluarga_jenkel_id" id="pegawaikeluarga_jenkel_id">
                                                <?php
                                                foreach ($jenis_kelamin->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jenkel_id ?>"><?= $value->jenkel_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
<!--                                         <div class="form-group"id="div-666">
                                            <label>Status Tunjangan</label>
                                            <select class="form-control" name="pegawaikeluarga_status_tunjangan" id="pegawaikeluarga_status_tunjangan">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($status_tunjangan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->status_tunjangan_id ?>"><?= $value->status_tunjangan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div> -->
                                        <div class="form-group"id="div-7">
                                            <label>Tingkat Pendidikan</label>
                                            <select class="form-control" name="pegawaikeluarga_pendidikan_id" id="pegawaikeluarga_pendidikan_id">
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
                                        <div class="form-group"id="div-8">
                                            <label>Status Perkawinan</label>
                                            <select class="form-control" name="pegawaikeluarga_status_perkawinan_id" id="pegawaikeluarga_status_perkawinan_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($status_perkawinan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->status_perkawinan_id ?>"><?= $value->status_perkawinan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
<!--                                         <div class="form-group" id="div-tgl-menikah">
                                            <label>Tanggal Menikah</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" id="pegawaikeluarga_tanggal_menikah" name="pegawaikeluarga_tanggal_menikah" value="" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>

                                        </div> -->
                                        <div class="form-group"id="div-10">
                                            <label>NIP / NRP</label>
                                            <input type="text" class="form-control" name="pegawaikeluarga_nip_nrp" id="pegawaikeluarga_nip_nrp" autocomplete="off" />
                                        </div>
                                        <div class="form-group"id="div-11">
                                            <label>Pekerjaan</label>
                                            <select class="form-control" name="pegawaikeluarga_pekerjaan" id="pegawaikeluarga_pekerjaan">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pekerjaan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pekerjaan_id ?>"><?= $value->pekerjaan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group"id="div-12">
                                            <label>Alamat</label>
                                            <textarea class="form-control" name="pegawaikeluarga_alamat" id="pegawaikeluarga_alamat"></textarea>
                                        </div>
                                        <div class="form-group"id="div-13">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" name="pegawaikeluarga_keterangan" id="pegawaikeluarga_keterangan"></textarea>
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
                        <a href="#formadd" onclick="refresh()" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
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
                                        <th>Aksi</th>
                                        <th>Nama Anggota Keluarga</th>
                                        <th>Tempat, Tgl Lahir</th>
                                        <th>Keluarga</th>
                                        <th>Status, Tgl Perkawinan</th>
                                        <th>Pekerjaan</th>
                                        <th>NIP / NRP</th>
<!--                                         <th>Tunjangan</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($result->result() as $value) {
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td style="min-width: 75px">
                                                <a href="#formadd" onclick="edit('<?= $value->pegawaikeluarga_id ?>');" class="btn btn-warning btn-sm" type="button"><i class="fa fa-edit"></i></a>
                                                <a href="<?= site_url('pegawai/PegawaiKeluarga/delete/' . $value->pegawaikeluarga_id) ?>" onclick="return confirm('Apakah anda yakin menghapus riwayat pendidikan.?');" class="btn btn-danger btn-sm" type="button"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td><?= $value->pegawaikeluarga_nama  ?></td>
                                            <td><?= $value->pegawaikeluarga_tempat_lahir ?> <?= $value->pegawaikeluarga_tanggal_lahir != '1000-01-01' ? ', <br/>' . tgl_indo($value->pegawaikeluarga_tanggal_lahir) : '-' ?></td>
                                            <td><?= $value->pegawaikeluarga_status_keluarga_nama ?></td>
                                            <td><?= $value->pegawaikeluarga_status_perkawinan_nama . ' <br/>' ?> <?= $value->pegawaikeluarga_tanggal_menikah != '1000-01-01' ? tgl_indo($value->pegawaikeluarga_tanggal_menikah) : ''; ?> </td>
                                            <td><?= $value->pegawaikeluarga_pekerjaan ?></td>
                                            <td><?= $value->pegawaikeluarga_nip_nrp ?></td>
<!--                                             <td><?= $value->pegawaikeluarga_status_tunjangan ?></td> -->
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

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiKeluargaById') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {
                $('#pegawaikeluarga_id').val(data.pegawaikeluarga_id);
                $('#pegawaikeluarga_status_keluarga_id').val(data.pegawaikeluarga_status_keluarga_id).change();
                $('#pegawaikeluarga_status_perkawinan_id').val(data.pegawaikeluarga_status_perkawinan_id).change();
                $('#pegawaikeluarga_nama').val(data.pegawaikeluarga_nama);
                $('#pegawaikeluarga_tempat_lahir').val(data.pegawaikeluarga_tempat_lahir);
                $('#pegawaikeluarga_tanggal_lahir').datetextentry('set_date', data.pegawaikeluarga_tanggal_lahir);
                $('#pegawaikeluarga_status_tunjangan').val(data.pegawaikeluarga_status_tunjangan_id).change();
                $('#pegawaikeluarga_tanggal_menikah').datetextentry('set_date', data.pegawaikeluarga_tanggal_menikah);
                $('#pegawaikeluarga_pekerjaan').val(data.pegawaikeluarga_pekerjaan_id).change();
                $('#pegawaikeluarga_jenkel_id').val(data.pegawaikeluarga_jenkel_id).change();
                $('#pegawaikeluarga_nip_nrp').val(data.pegawaikeluarga_nip_nrp);
                $('#pegawaikeluarga_keterangan').val(data.pegawaikeluarga_keterangan);
                $('#pegawaikeluarga_alamat').val(data.pegawaikeluarga_alamat);
                $('#pegawaikeluarga_pendidikan_id').val(data.pegawaikeluarga_pendidikan_id).change();
            	if($('#pegawaikeluarga_status_keluarga_id').val() == '11' || $('#pegawaikeluarga_status_keluarga_id').val() == '12')
                {                
        			$('#div-5').hide();
        			$('#div-6').hide();
        			$('#div-7').hide();
        			$('#div-8').hide();
        			// $('#div-tgl-menikah').hide();
                }else{
        			$('#div-5').show();
        			$('#div-6').show();
        			$('#div-7').show();
        			$('#div-8').show();
        			// $('#div-tgl-menikah').show();
                }
            
            	if($('#pegawaikeluarga_status_keluarga_id').val() == '31')
                {                
        			$('#div-8').hide();
        			// $('#div-tgl-menikah').hide();
                }else{
        			$('#div-8').show();
        			// $('#div-tgl-menikah').show();
                }

                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiKeluarga/update') ?>');

            }
        });

    }


    $("#pegawaikeluarga_status_keluarga_id").change(function() {
        $.ajax({
            type: "POST", // Method pengiriman data bisa dengan GET atau POST
            url: "<?php echo site_url("pegawai/PegawaiAjax/getRowPegawaiByNip"); ?>",
            data: {
                nip: '<?= $pegawai->pegawai_nip ?>',
            }, // data yang akan dikirim ke file yang dituju
            // dataType: "json",
            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function(response) {
                // response = JSON.parse(response);
                // response = JSON.stringify(response);
                // alert(response.pegawai_statusperkawinan_id);
                // return false;
                if (response.pegawai_statusperkawinan_id == '2' && $("#pegawaikeluarga_status_keluarga_id").val() == '21') {
                    alert('Pegawai Belum Menikah');
                    refresh();
                }
            
            	if($('#pegawaikeluarga_status_keluarga_id').val() == '11' || $('#pegawaikeluarga_status_keluarga_id').val() == '12')
                {                
        			$('#div-5').hide();
        			$('#div-6').hide();
        			$('#div-7').hide();
        			$('#div-8').hide();
        			// $('#div-tgl-menikah').hide();
                }else{
        			$('#div-5').show();
        			$('#div-6').show();
        			$('#div-7').show();
        			$('#div-8').show();
        			// $('#div-tgl-menikah').show();
                }
            
        			if($("#pegawaikeluarga_status_keluarga_id").val() == '21')
        			{                
        			$('#div-5').hide();
                    $('#div-8').hide();
        			// $('#div-tgl-menikah').hide();
        			}
            
            
        			if($('#pegawaikeluarga_status_keluarga_id').val() == '31' || $('#pegawaikeluarga_status_keluarga_id').val() == '11' || $('#pegawaikeluarga_status_keluarga_id').val() == '12')
        			{                
        			$('#div-8').hide();
        			// $('#div-tgl-menikah').hide();
        			}else{
        			$('#div-8').show();
        			// $('#div-tgl-menikah').show();
        			}
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        });
    });

    function d_m_y(date) {
        if (date != null) {
            var from = date.split("-");
            return from[2] + "/" + from[1] + "/" + from[0];
        } else {
            return date;
        }
    }

    function refresh() {
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiKeluarga/add') ?>');
        document.getElementById('formadd').reset();
    }

	$('#pegawaikeluarga_status_perkawinan_id').change(function(){
		if($(this).val() == 2){
        // $('#div-tgl-menikah').hide();
        }else{
         // $('#div-tgl-menikah').show();
        }
	});


        $('#inlineRadio1').click(function() {
        $('#div-3').show();
        $('#div-4').show();
        $('#div-5').show();
        $('#div-6').show();
        $('#div-7').show();
        // $('#div-8').show();
        // $('#div-tgl-menikah').show();
        $('#div-10').show();
        $('#div-11').show();
        $('#div-12').show();
        $('#div-13').show();

        });

        $('#inlineRadio2').click(function() {
        $('#div-3').hide();
        $('#div-4').hide();
        $('#div-5').hide();
        $('#div-6').hide();
        $('#div-7').hide();
        $('#div-8').hide();
        $('#div-tgl-menikah').hide();
        $('#div-10').hide();
        $('#div-11').hide();
        $('#div-12').hide();
        $('#div-13').hide();
        });
</script>