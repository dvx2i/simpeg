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
                        <form role="form" action="<?= $action ?>" method="post" enctype="multipart/form-data">

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
                                            <select name="jenis_mutasi" id="jenis_mutasi" class="form-control">
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
                                            <select name="usulan_propinsi" id="usulan_propinsi" class="form-control select2">
                                                <?php foreach ($provinsi->result_array() as $item) : ?>
                                                    <option <?= $usulan_propinsi == $item['propinsi_id'] ? 'selected' : '';  ?> value="<?= $item['propinsi_id'] ?>"><?= $item['propinsi_nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                Kabupaten 
                                            </label>
                                            <select name="usulan_kabupaten" id="usulan_kabupaten" class="form-control select2">
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
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> BERKAS MUTASI</b>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        foreach ($berkas->result() as $item) : ?>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4 text-lg-right">
                                                <span class="text-red">*</span> <?= $item->berkas_nama ?> <span>(Pdf/JPG Maks. 2MB)</span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="file" style="padding: .175rem 0.75rem" class="form-control" accept="application/pdf" name="berkas_<?= $item->berkas_id ?>" value="" placeholder="" />
                                                </div>
                                                <?php if ($usulan_id != '') : ?>
                                                    <div class="col-md-4">
                                                        <?php foreach ($berkas_mutasi as $key) : ?>
                                                            <?php if ($key['berkas_id'] == $item->berkas_id) : ?>
                                                                <a href="<?= base_url('assets/files/' . $key['url_file']) ?>" class="btn btn-sm btn-success" target="_blank"><small>Unduh <?= $item->berkas_nama ?></small></a>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <hr>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>



                            <div class="input-group-addon">
                                <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalSimpan">Simpan</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(
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