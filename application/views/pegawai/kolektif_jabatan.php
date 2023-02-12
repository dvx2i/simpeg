<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            MUTASI JABATAN
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
                        <div class="box-body table-responsive">
                            <form role="form" action="" method="post" enctype="multipart/form-data">
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
                                                <input type="text" class="form-control" value="<?= $pegawai->pegawai_nama ?>" readonly="true" />
                                            </div>

                                            <div class="form-group">
                                                <label>Jenis Perubahan Jabatan</label>
                                                <input type="text" class="form-control" value="<?= !empty($lama) ? $lama->pegawaijabatan_kenaikan_nama : ''; ?>" readonly="true" />
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Jabatan</label>
                                                <input type="text" class="form-control" value="<?= !empty($lama) ? $lama->pegawaijabatan_jenisjabatan_nama : ''; ?>" readonly="true" />
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Jabatan</label>
                                                <input type="text" class="form-control" value="<?= !empty($lama) ? $lama->pegawaijabatan_jabatan_nama : ''; ?>" readonly="true" />
                                            </div>


                                            <div class="form-group">
                                                <label>Ditetapkan Oleh</label>
                                                <select class="form-control " name="pegawaijabatan_pejabat" id="" required="true">
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
                                                <input type="text" class="form-control" value="<?= !empty($lama) ? $lama->pegawaijabatan_sk_no : ''; ?>" readonly="true" />
                                            </div>
                                            <div class="form-group">
                                                <label>Tgl SK</label>
                                                <input type="text" class="form-control" value="<?= !empty($lama) ? d_m_y($lama->pegawaijabatan_sk_tanggal) : ''; ?>" readonly="true" />
                                            </div>

                                            <div class="form-group">
                                                <label>TMT</label>
                                                <input type="text" class="form-control" value="<?= !empty($lama) ? d_m_y($lama->pegawaijabatan_tmt) : ''; ?>" readonly="true" />

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
                        <div class="box-body table-responsive">
                            <form id="formadd" role="form" action="<?= site_url('pegawai/KolektifJabatan/add') ?>" method="post" enctype="multipart/form-data">
                                <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <b> KEADAAN BARU</b>
                                        </div>
                                        <div class="panel-body">
                                            <input type="hidden" class="form-control" name="pegawaijabatan_id" id="pegawaijabatan_id" />
                                            <input type="hidden" class="form-control" name="pegawaijabatan_unit_kerja_id" id="pegawaijabatan_unit_kerja_id" value="<?= $pegawai->pegawai_unit_id ?>" />
                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input type="text" class="form-control" value="<?= $pegawai->pegawai_nip ?>" readonly="true" />
                                            </div>

                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" value="<?= $pegawai->pegawai_nama ?>" readonly="true" />
                                            </div>

                                            <div class="form-group">
                                                <label>Jenis Perubahan Jabatan</label>
                                                <select class="form-control" name="pegawaijabatan_kenaikan_id" id="pegawaijabatan_kenaikan_id">
                                                    <option value="">--Pilih--</option>
                                                    <?php
                                                    foreach ($kenaikan_jabatan->result() as $value) {
                                                    ?>
                                                        <option value="<?= $value->kenaikan_jabatan_id ?>"><?= $value->kenaikan_jabatan_nama ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group" id="div-jenis-jabatan">
                                                <label>Jenis Jabatan</label>
                                                <select class="form-control" name="pegawaijabatan_jenisjabatan_id" id="jenis_jabatan">
                                                    <option value="">--Pilih--</option>
                                                    <?php
                                                    foreach ($jenis_jabatan->result() as $value) {
                                                    ?>
                                                        <option value="<?= $value->jeniskedudukan_kode ?>"><?= $value->jeniskedudukan_nama ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group" id="div-jabatan">
                                                <label>Nama Jabatan</label>
                                                <select class="form-control select2" name="pegawaijabatan_jabatan_id" id="jabatan">
                                                    <option value="">--Pilih--</option>
                                                    <!-- <?php
                                                            foreach ($jabatan->result() as $value) {
                                                            ?>
                                                        <option value="<?= $value->jabatan_id ?>" <?php
                                                                                                    selected($value->jabatan_id, $pegawai->pegawai_jabatan_id)
                                                                                                    ?>><?= $value->jabatan_nama ?></option>
                                                    <?php
                                                            }
                                                    ?> -->
                                                </select>
                                            </div>
                                            <input type="hidden" name="pegawaijabatan_pangkat_id" value="<?= $pegawai->pegawai_pangkat_terakhir_id ?>" />

                                            <div class="form-group">
                                                <label>Ditetapkan Oleh</label>
                                                <select class="form-control select2" name="pegawaijabatan_pejabat" id="pegawaijabatan_pejabat" required="true">
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
                                                    <div class="col-lg-5">
                                                        <input type="text" class="form-control col-lg-4" name="pegawaijabatan_sk_no" id="pegawaijabatan_sk_no" />
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <div class="btn btn-default">Tanggal</div>
                                                            </span>
                                                            <input type="text" class="form-control dateEntry" name="pegawaijabatan_sk_tanggal" id="pegawaijabatan_sk_tanggal" value="" autocomplete="off" />
                                                            <span class="input-group-btn">
                                                                <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>


                                            <div class="form-group">
                                                <label>TMT</label>
                                                <div class="input-group">

                                                    <input type="text" class="form-control dateEntry" name="pegawaijabatan_tmt" id="pegawaijabatan_tmt" value="" autocomplete="off" />
                                                    <span class="input-group-btn">
                                                        <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="form-group" id="div-pelantikan">
                                                <label>Tanggal Pelantikan</label>
                                                <div class="input-group">

                                                    <input type="text" class="form-control dateEntry" name="pegawaijabatan_tgl_pelantikan" id="pegawaijabatan_tgl_pelantikan" value="" autocomplete="off" />
                                                    <span class="input-group-btn">
                                                        <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                    </span>
                                                </div>

                                            </div>

                                            <div class="form-group hide">
                                                <label>Masa Kerja</label>
                                                <div class="input-group-addon">
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <input type="number" onkeydown="return (event.which < 100)" class="form-control" name="pegawaijabatan_tahun" id="pegawaijabatan_tahun" />
                                                            <span class="input-group-btn">
                                                                <div class="btn btn-default">Tahun</div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <input type="number" onkeydown="return (event.which < 100)" class="form-control" name="pegawaijabatan_bulan" id="pegawaijabatan_bulan" />
                                                            <span class="input-group-btn">
                                                                <div class="btn btn-default">Bulan</div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group hide">
                                                <label>Gaji Pokok</label>
                                                <input type="number" class="form-control" name="pegawaijabatan_gaji" id="pegawaijabatan_gaji" />
                                            </div>
                                            <div class="form-group hide">
                                                <label>Angka Kredit</label>
                                                <input type="number" step="0.001" class="form-control" name="pegawaijabatan_angka_kredit" id="pegawaijabatan_angka_kredit" />
                                            </div>

                                            <div class="form-group " style="display: none;" id="div-prov">
                                                <label>Prov/Kab/Kota</label>
                                                <input type="text" class="form-control" name="pegawaijabatan_prov_kab_kota" id="pegawaijabatan_prov_kab_kota" />
                                            </div>
                                            <div class="form-group " style="display: none;" id="div-kepindahan">
                                                <label>Jenis Kepindahan</label>
                                                <select name="pegawaijabatan_jenis_pindah" class="form-control" id="pegawaijabatan_jenis_pindah">
                                                    <option value="KELUAR PROVINSI">KELUAR PROVINSI</option>
                                                    <option value="MASUK PROVINSI">MASUK PROVINSI</option>
                                                    <option value="ANTAR KAB/KOTA KE PROVINSI">ANTAR KAB/KOTA KE PROVINSI</option>
                                                    <option value="DARI PROVINSI KE KAB/KOTA">DARI PROVINSI KE KAB/KOTA</option>
                                                    <option value="ANTAR DINAS/INSTANSI">ANTAR DINAS/INSTANSI</option>
                                                    <option value="LUAR PROVINSI KE KAB/KOTA">LUAR PROVINSI KE KAB/KOTA</option>
                                                </select>
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
            </div>
        <?php
        }
        ?>

    </section>
</div>
<script>
    $(document).ready(
        function() {

            // $.ajax({
            //     url: '<?= site_url('referensi/ReferensiJson/listJabatanByKedudukanId/') ?>',
            //     type: "POST",
            //     data: {
            //         ajax: '1',
            //         id: jabatan
            //     },
            //     dataType: "html",
            //     success: function(data) {
            //         //                                        alert(data.id);
            //         $('#jabatan').html(data);
            //         //$('#jenis_kedudukan_nama').val(data.nama);
            //     }
            // });

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

    $('#pegawaijabatan_kenaikan_id').change(
        function() {
            // alert($(this).val());
            if ($(this).val() == '23') {
                $('#div-prov').show();
                $('#div-kepindahan').show();
                $('#div-jenis-jabatan').hide();
                $('#div-jabatan').hide();
                $('#div-pelantikan').hide();
            } else {
                $('#div-prov').hide();
                $('#div-kepindahan').hide();
                $('#div-jenis-jabatan').show();
                $('#div-jabatan').show();
                $('#div-pelantikan').show();
            }
        }
    );

    function edit(v) {

        $.ajax({

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiJabatanById') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {
                $('#pegawaijabatan_id').val(data.pegawaijabatan_id);
                $('#pegawaijabatan_pangkat_id').val(data.pegawaijabatan_pangkat_id).change();
                $('#pegawaijabatan_kenaikan_id').val(data.pegawaijabatan_kenaikan_id).change();
                $('#pegawaijabatan_tmt').val(data.pegawaijabatan_tmt);
                $('#pegawaijabatan_sk_tanggal').val(data.pegawaijabatan_sk_tanggal);
                $('#pegawaijabatan_sk_no').val(data.pegawaijabatan_sk_no);
                $('#pegawaijabatan_pejabat').val(data.pegawaijabatan_pejabat).change();
                $('#pegawaijabatan_tgl_pelantikan').val(data.pegawaijabatan_tgl_pelantikan);
                $('#pegawaijabatan_angka_kredit').val(data.pegawaijabatan_angka_kredit);
                $('#pegawaijabatan_tahun').val(data.pegawaijabatan_tahun);
                $('#pegawaijabatan_bulan').val(data.pegawaijabatan_bulan);
                $('#pegawaijabatan_gaji').val(data.pegawaijabatan_gaji);
                $('#pegawaijabatan_unit_kerja_id').val(data.pegawaijabatan_unit_kerja_id).change();
                $('#jenis_jabatan').val(data.pegawaijabatan_jenisjabatan_id);
                var pegawaijabatan_jabatan_id = data.pegawaijabatan_jabatan_id;
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
                        // $('#jabatan').html(data);
                        $('#jabatan').val(pegawaijabatan_jabatan_id).change();
                    }
                });
                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiRiwayatJabatan/update') ?>');

            }
        });

    }

    function refresh() {
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiRiwayatJabatan/add') ?>');
        //    $('#jabatan').html('<option>--Pilih--</option>');
        document.getElementById('formadd').reset();
    }
</script>