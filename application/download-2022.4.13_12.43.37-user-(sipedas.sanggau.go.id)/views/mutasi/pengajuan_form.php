<?php
	if($usulan_id == ''){
		$aksi = site_url('mutasi/Pengajuan/add');
	}else{
		$aksi = site_url('mutasi/Pengajuan/update/'.$usulan_id);
    }
?>

<style>

/** SPINNER CREATION **/

.loader {
  position: relative;
  text-align: center;
  margin: 15px auto 35px auto;
  z-index: 9999;
  display: block;
  width: 80px;
  height: 80px;
  border: 10px solid rgba(0, 0, 0, .3);
  border-radius: 50%;
  border-top-color: #000;
  animation: spin 1s ease-in-out infinite;
  -webkit-animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to {
    -webkit-transform: rotate(360deg);
  }
}

@-webkit-keyframes spin {
  to {
    -webkit-transform: rotate(360deg);
  }
}


/** MODAL STYLING **/

.modal-content {
  border-radius: 0px;
  box-shadow: 0 0 20px 8px rgba(0, 0, 0, 0.7);
}

.modal-backdrop.show {
  opacity: 0.75;
}

.loader-txt {
  p {
    font-size: 13px;
    color: #666;
    small {
      font-size: 11.5px;
      color: #999;
    }
  }
}

</style>

<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Pengajuan Usulan Mutasi
        </h1>
    </section>


    <section class="content">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">A. IDENTITAS PEGAWAI</a>
        <br />
        <br />
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body table-responsive">
                        <form role="form" action="<?= $aksi ?>" id="form-usulan" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="usulan_id" value="<?= $usulan_id ?>">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> IDENTITAS PEGAWAI</b>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label>OPD</label>
                                            <select class="form-control" disabled>
                                                <option><?= $pegawai->pegawai_unit_nama ?></option>
                                                <?php
                                                foreach ($unit->result() as $value) {
                                                ?>
                                                    <!--                                                     <option value="<?= $value->unit_id ?>" <?= selected($value->unit_id, $pegawai->pegawai_unit_id) ?>><?= $value->unit_nama ?></option> -->
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group" id="divnip">
                                            <label>NIP</label>
                                            <input type="text" class="form-control" name="nip_update" id="nip_update" value="<?= $pegawai->pegawai_nip ?>" required="true" <?= $this->session->userdata('login')['group_id'] == '1' ? '' : 'readonly="true"' ?> />
                                            <input type="hidden" class="form-control" name="nip" id="nip" value="<?= $pegawai->pegawai_nip ?>" required="true" <?= $this->session->userdata('login')['group_id'] == '1' ? '' : 'readonly="true"' ?> />

                                            <p class="help-block text-danger" id="msgnip"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>NIP Lama</label>
                                            <input type="text" maxlength="9" class="form-control" name="nip_lama" value="<?= $pegawai->pegawai_nip_lama ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Pegawai</label>
                                            <input type="text" class="form-control" name="nama" value="<?= $pegawai->pegawai_nama ?>" required="true" <?= $this->session->userdata('login')['group_id'] == '1' ? '' : 'readonly="true"' ?> />
                                        </div>
                                        <div class="form-group">
                                            <label>Masa Kerja</label>
                                            <input type="text" class="form-control" name="masa_kerja" readonly value="<?= $masa_kerja ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Mutasi</label>
                                            <select name="jenis_mutasi" id="jenis_mutasi" class="form-control" required>
                                                <option value="0">--Pilih Jenis Mutasi--</option>
                                                <option <?= $usulan_jenis == '1' ? 'selected' : ''; ?> value="1">Keluar Kabupaten / Kota</option>
                                                <option <?= $usulan_jenis == '2' ? 'selected' : ''; ?> value="2">Dalam Kota (Antar Intansi)</option>
                                            </select>
                                        </div>
                                        <div id="div-tujuan" >
                                        <div class="form-group">
                                            <label>
                                                Provinsi 
                                            </label>
                                            <select style="width:100%" name="usulan_propinsi" id="usulan_propinsi" class="form-control select2"><br>
                                                <?php foreach ($provinsi->result_array() as $item) : ?>
                                                    <option <?= $usulan_propinsi == $item['propinsi_id'] ? 'selected' : '';  ?> value="<?= $item['propinsi_id'] ?>"><?= $item['propinsi_nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                Kabupaten 
                                            </label>
                                            <select style="width:100%" name="usulan_kabupaten" id="usulan_kabupaten" class="form-control select2"><br>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group" id="div-opd-tujuan" style="display: none;">
                                            <label>OPD Tujuan</label>
                                            <select class="form-control" name="usulan_unit_tujuan_id" id="usulan_unit_tujuan_id">
                                                <!-- <option><?= $pegawai->pegawai_unit_nama ?></option> -->
                                                <?php
                                                foreach ($unit->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->unit_id ?>" <?= selected($value->unit_id,  $usulan_unit_tujuan_id) ?>><?= $value->unit_nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                    <!-- /.panel-body -->
                                </div>

                            </div>
                            <div id="berkas"></div>



                            <div class="input-group-addon">
                                <button type="button" id="kirim" class="btn btn-success" >Kirim</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <div class="loader"></div>
        <div clas="loader-txt">
          <p>Sedang memuat.. <br><br><small>Silakan tunggu</small></p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
	


    $(document).ready(
        function() {
        
        
    $('#kirim').on('click', function() {
  
        var jenis = $('#jenis_mutasi').val();
    	var propinsi = $('#usulan_propinsi').val();
    	var kabupaten = $('#usulan_kabupaten').val();
    	var unit_tujuan = $('#usulan_unit_tujuan_id').val();
    
    
        if (jenis == '0') {
alert('Jenis Mutasi Harus Diisi')
            // swal({
            //     title: '',
            //     text: 'Jenis Mutasi Harus Diisi',
            //     type: 'error',
            //     showCancelButton: false,
            //     confirmButtonText: 'Tutup',
            // })
            return false;
        }
    	
    			$("#loadMe").modal({
      				backdrop: "static", //remove ability to close modal with click
      				keyboard: false, //remove option to close with keyboard
      				show: true //Display loader!
    			});
    
    		$('#form-usulan').submit();
    });
        
                    if($('#jenis_mutasi').val() == '1'){
                        $('#div-opd-tujuan').hide();
                        $('#div-tujuan').show();
                    }else{
                        $('#div-opd-tujuan').show();
                        $('#div-tujuan').hide();
                    }

            $.ajax({
                url: '<?= site_url('referensi/ReferensiJson/listKabupatenByIdPropinsi/') ?>/' + $('#usulan_propinsi').val(),
                type: "POST",
                data: {
                    ajax: '1'
                },
                dataType: "html",
                success: function(data) {
                    $('#usulan_kabupaten').html(data);
                }
            });

            $('#usulan_propinsi').change(
                function() {
                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listKabupatenByIdPropinsi/') ?>/' + $('#usulan_propinsi').val(),
                        type: "POST",
                        data: {
                            ajax: '1'
                        },
                        dataType: "html",
                        success: function(data) {
                            $('#usulan_kabupaten').html(data);
                        }
                    });
                }
            );
            
            $.ajax({
                        type: "POST", // Method pengiriman data bisa dengan GET atau POST
                        url: "<?php echo site_url("referensi/ReferensiJson/getMutasiBerkas"); ?>",
                        data: {
                            jenis: $('#jenis_mutasi').val(),
                            usulan_id: '<?= $usulan_id ?>'
                        }, // data yang akan dikirim ke file yang dituju
                        // dataType: "json",
                        success: function(data) {
                            $('#berkas').html(data);
                        }
                    });

            $('#jenis_mutasi').change(
                function(){

                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/getMasaKerja') ?>/' + $('#nip').val(),
                        type: "POST",
                        data: {
                            ajax: '1'
                        },
                        dataType: "json",
                        success: function(data) {
                            if($('#jenis_mutasi').val() == '1' && data < 10){
                                $('#jenis_mutasi').val(0).change();
                                alert('Masa Kerja Belum Mencapai Batas Minimal');
                                $('#div-tujuan').hide();
                                $('#div-opd-tujuan').hide();
                                return false;
                            }
                        }
                    });

                    $.ajax({
                        type: "POST", // Method pengiriman data bisa dengan GET atau POST
                        url: "<?php echo site_url("referensi/ReferensiJson/getMutasiBerkas"); ?>",
                        data: {
                            jenis: $('#jenis_mutasi').val(),
                            usulan_id: '<?= $usulan_id ?>'
                        }, // data yang akan dikirim ke file yang dituju
                        // dataType: "json",
                        success: function(data) {
                            $('#berkas').html(data);
                        }
                    });

                    if($(this).val() == '1'){
                        $('#div-opd-tujuan').hide();
                        $('#div-tujuan').show();
                    }else{
                        $('#div-opd-tujuan').show();
                        $('#div-tujuan').hide();
                    }
                }
            )

        }

);
</script>