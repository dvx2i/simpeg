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
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Progress Mutasi</h3>
                    </div>

                    <div class="fullwidth">
                        <div class="container separator">
                            <?php 
                                $class1 = "";
                                $class2 = "";
                                $class3 = "";
                                $class4 = "";

                            if($usulan_status == '3'){
                                $class1 = "is-active";
                            }
                            if($usulan_status == '1'){
                                $class1 = "is-complete";
                                $class2 = "is-active";
                            }
                            if($usulan_status == '2'){
                                $class1 = "is-complete";
                                $class2 = "is-complete";
                                $class3 = "is-active";
                            }
                            if($usulan_status == '4'){
                                $class1 = "is-complete";
                                $class2 = "is-complete";
                                $class3 = "is-complete";
                                $class4 = "is-complete";
                            }
                            ?>
                            <ul class="progress-tracker progress-tracker--text progress-tracker--text-top" style="opacity: 0.9; margin-top: 5px; margin-bottom: 15px;">
                                <li class="progress-step <?= $class1 ?>">
                                    <div class="progress-text">
                                        <h4 class="progress-title">Step 1</h4>
                                        Pengajuan
                                    </div>
                                    <div class="progress-marker"></div>
                                </li>
                                <li class="progress-step <?= $class2 ?>">
                                    <div class="progress-text">
                                        <h4 class="progress-title">Step 2</h4>
                                        Verifikasi
                                    </div>
                                    <div class="progress-marker"></div>
                                </li>
                                <li class="progress-step <?= $class3 ?>">
                                    <div class="progress-text">
                                        <h4 class="progress-title">Step 3</h4>
                                        Diproses
                                    </div>
                                    <div class="progress-marker"></div>
                                </li>
                                <!-- <li class="progress-step is-active">
                                    <div class="progress-text">
                                        <h4 class="progress-title">Step 4</h4>
                                        Validasi
                                    </div>
                                    <div class="progress-marker"></div>
                                </li> -->
                                <li class="progress-step <?= $class4 ?>">
                                    <div class="progress-text">
                                        <h4 class="progress-title">Step 4</h4>
                                        Usulan Mutasi Selesai
                                    </div>
                                    <div class="progress-marker"></div>
                                </li>

                            </ul>

                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body table-responsive">
                        <form role="form" action="#" method="post" enctype="multipart/form-data">


                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> IDENTITAS PEGAWAI</b>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label>OPD</label>
                                            <select class="form-control" disabled>
                                                <option><?= $pegawai_unit_nama ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="divnip">
                                            <label>NIP</label>
                                            <input type="text" class="form-control" name="nip_update" readonly id="nip_update" value="<?= $pegawai_nip ?>" required="true" <?= $this->session->userdata('login')['group_id'] == '1' ? '' : 'readonly="true"' ?> />

                                            <p class="help-block text-danger" id="msgnip"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>NIP Lama</label>
                                            <input type="text" maxlength="9" class="form-control" name="nip_lama" readonly value="<?= $pegawai_nip_lama ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Pegawai</label>
                                            <input type="text" class="form-control" name="nama" value="<?= $pegawai_nama ?>" readonly required="true" <?= $this->session->userdata('login')['group_id'] == '1' ? '' : 'readonly="true"' ?> />
                                        </div>
                                        <div class="form-group">
                                            <label>Masa Kerja</label>
                                            <input type="text" class="form-control" name="masa_kerja" readonly value="<?= $masa_kerja ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Mutasi</label>
                                            <select name="jenis_mutasi" id="jenis_mutasi" class="form-control" disabled>
                                                <option value="0">--Pilih Jenis Mutasi--</option>
                                                <option <?= $usulan_jenis == '1' ? 'selected' : ''; ?> value="1">Keluar Kabupaten / Kota</option>
                                                <option <?= $usulan_jenis == '2' ? 'selected' : ''; ?> value="2">Dalam Kota (Antar Intansi)</option>
                                            </select>
                                        </div>
                                        <div id="div-tujuan">
                                            <div class="form-group">
                                                <label>
                                                    Provinsi
                                                </label>
                                                <select name="usulan_propinsi" id="usulan_propinsi" class="form-control select2" disabled>
                                                    <?php foreach ($provinsi->result_array() as $item) : ?>
                                                        <option <?= $usulan_propinsi == $item['propinsi_id'] ? 'selected' : '';  ?> value="<?= $item['propinsi_id'] ?>"><?= $item['propinsi_nama'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>
                                                    Kabupaten
                                                </label>
                                                <select name="usulan_kabupaten" id="usulan_kabupaten" class="form-control select2" disabled>
                                                    <?php
                                                    foreach ($kabupaten->result() as $value) {
                                                    ?>
                                                        <option value="<?= $value->kabupaten_id ?>" <?= selected($value->kabupaten_id, $usulan_kabupaten) ?>><?= $value->kabupaten_nama ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="div-opd-tujuan" style="display: none;">
                                            <label>OPD Tujuan</label>
                                            <select class="form-control" name="usulan_unit_tujuan_id" id="usulan_unit_tujuan_id" disabled>
                                                <?php
                                                foreach ($unit->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->unit_id ?>" <?= selected($value->unit_id, $usulan_unit_tujuan_id) ?>><?= $value->unit_nama ?></option>
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
                                        <table id="my-table" class="table table-striped table-td-valign-middle">
                                            <?php foreach ($berkas->result_array() as $item) : ?>
                                                <tr>
                                                    <td><?= $item['berkas_nama'] ?></td>
                                                    <?php foreach ($berkas_mutasi as $key) : ?>
                                                        <?php if ($key['berkas_id'] == $item['berkas_id']) : ?>
                                                            <td><a class="btn btn-info" target="_blank" href="<?= base_url('assets/files/' . $key['url_file'])   ?>">Lihat</a></td>
                                                        <?php else : ?>
                                                        <?php endif; ?>
                                                    <?php endforeach ?>
                                                </tr>
                                            <?php endforeach ?>
                                        </table>
                                    </div>
                                </div>
                            </div>



                            <div class="input-group-addon">
                                <?php if ($usulan_id != '' && $usulan_status == '1') : ?>
                                    <button type="button" class="btn btn-success" id="btn-terima">Terima</button>
                                    <button data-toggle="modal" data-target="#myModal" class="btn btn-danger buttons-html5 btn-sm" type="button"><span><i class="fa fa-undo"></i> Tolak</span></button>
                                <?php endif; ?>
                                <button type="button" onclick="window.history.go(-1)" class="btn btn-default">Kembali</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tolak Permohonan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button id="btn-tolak" type="button" class="btn btn-danger" data-dismiss="modal">Tolak</button>
            </div>

        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert2.css">
<script src="<?= base_url() ?>assets/sweetalert/sweetalert2.min.js"></script>
<script>

    $(document).ready(
        function() {
        
                    if($('#jenis_mutasi').val() == '1'){
                        $('#div-opd-tujuan').hide();
                        $('#div-tujuan').show();
                    }else{
                        $('#div-opd-tujuan').show();
                        $('#div-tujuan').hide();
                    }
        
        });

    $('#btn-terima').click(function() {
        swal({
            
            title: "",
            text: "Verifikasi Permohonan?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Validasi',
    cancelButtonText: 'Batalkan'
  }).then((result) => {
    if (result.value) {

                var keterangan = $('#keterangan').val();

                var form = "<form id='hidden-form' action='<?= site_url('mutasi/DataPengajuan/update/verify') ?>' method='post'>";

                form += "<input type='hidden' name='keterangan' value='" + keterangan + "'/>";
                form += "<input type='hidden' name='usulan_id' value='<?= $usulan_id ?>'/>";

                $(form + "</form>").appendTo($(document.body)).submit();

            } else {
                swal("Dibatalkan", "", "error");
            }
        })

    });


    $('#btn-tolak').click(function() {
        swal({
    title: "",
    text: "Tolak usulan mutasi",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Ya',
    cancelButtonText: "Batal",
    closeOnConfirm: true,
    closeOnCancel: true
        }).then((result) => {
    if (result.value) {
                swal({
                    title: '',
                    text: 'Data Berhasil Ditolak',
                    icon: 'success'
                }).then(function() {

                    var keterangan = $('#keterangan').val();

                    var form = "<form id='hidden-form' action='<?= site_url('mutasi/DataPengajuan/update/reject') ?>' method='post' >";

                    form += "<input type='hidden' name='keterangan' value='" + keterangan + "'/>";
                    form += "<input type='hidden' name='usulan_id' value='<?= $usulan_id ?>'/>";

                    $(form + "</form>").appendTo($(document.body)).submit();
                });
            } else {
                swal("Dibatalkan", "", "error");
            }
        })

    });
</script>