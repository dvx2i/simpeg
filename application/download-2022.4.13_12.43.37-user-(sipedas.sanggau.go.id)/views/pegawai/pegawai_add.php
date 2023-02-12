<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Tambah Pegawai
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
                        <form role="form" action="<?= site_url('pegawai/Pegawai/add') ?>" method="post" onsubmit="return validasiInput()">


                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> IDENTITAS PEGAWAI</b>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label>Unit Kerja</label>
                                            <select class="form-control select2" name="unit" id="opd" required="true">
                                                <option value="">--Pilih Unit Kerja--</option>
                                                <?php
                                                foreach ($unit->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->unit_id ?>"><?= $value->unit_nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group" id="divnip">
                                            <label>NIP</label>
                                            <div class="form-group">

                                                <input type="text" class="form-control" name="nip" id="nip" onblur="cekAdaNip()" maxlength="18" max="18" required="true" autocomplete="off" />


                                            </div>
                                            <p class="help-block text-danger" id="msgnip"></p>
                                        </div>
                                        <div class="form-group">

                                            <label>NIP Lama</label>
                                            <input type="text" maxlength="9" class="form-control" name="nip_lama" autocomplete="off" />

                                        </div>
                                        <div class="form-group">
                                            <label>Nama Pegawai</label>
                                            <input type="text" class="form-control" name="nama" maxlength="255" required="true" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Gelar</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-4">

                                                    <input type="text" class="form-control" maxlength="100" placeholder="depan" name="gelar_depan" />
                                                </div>
                                                <div class="col-lg-4">

                                                    <input type="text" class="form-control" maxlength="100" name="gelar_belakang" placeholder="belakang" />

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat dan Tgl Lahir</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control col-lg-4" maxlength="100" placeholder="tempat lahir" name="tempat_lahir" />
                                                </div>
                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir" readonly="true" placeholder="tgl lahir" autocomplete="off" />
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required="true">
                                                <?php
                                                foreach ($jenis_kelamin->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jenkel_id ?>"><?= $value->jenkel_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Golongan Darah</label>
                                            <select class="form-control" name="golongan_darah" id="golongan_darah">
                                                <?php
                                                foreach ($golongan_darah->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->golongandarah_id ?>"><?= $value->golongandarah_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <select class="form-control" name="agama" id="agama" required="true">
                                                <?php
                                                foreach ($agama->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->agama_id ?>"><?= $value->agama_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Perkawinan</label>
                                            <select class="form-control" name="kawin" id="kawin" required="true">
                                                <?php
                                                foreach ($status_perkawinan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->status_perkawinan_id ?>"><?= $value->status_perkawinan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label>Propinsi</label>
                                                    <select class="form-control" name="propinsi" id="propinsi">
                                                        <option value="">--Pilih Propinsi--</option>
                                                        <?php
                                                        foreach ($propinsi->result() as $value) {
                                                        ?>
                                                            <option value="<?= $value->propinsi_id ?>"><?= $value->propinsi_nama ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kabupaten</label>
                                                    <select class="form-control" name="kabupaten" id="kabupaten">
                                                        <option value="">--Pilih Kabupaten--</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kecamatan</label>
                                                    <select class="form-control" name="kecamatan" id="kecamatan">
                                                        <option value="">--Pilih Kecamatan--</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kelurahan</label>
                                                    <select class="form-control" name="kelurahan" id="kelurahan">
                                                        <option value="">--Pilih Kelurahan--</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jalan</label>
                                                    <input type="text" class="form-control" maxlength="255" name="jalan" />
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label>RT</label>
                                                    <input type="text" class="form-control" name="rt" />
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>RW</label>
                                                    <input type="text" class="form-control" name="rw" />
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Kode Pos</label>
                                                    <input type="text" class="form-control" name="kode_pos" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>No Telp</label>
                                            <input type="text" class="form-control" name="telp" />
                                        </div>
                                        <div class="form-group">
                                            <label>No HP</label>
                                            <input type="text" class="form-control" name="hp" />
                                        </div>
                                        <div class="form-group">
                                            <label>Status Pegawai</label>
                                            <select class="form-control" name="status_pegawai" id="status_pegawai" required="true">
                                                <option value="">--Pilih Status Pegawai--</option>
                                                <?php
                                                foreach ($status_kepegawaian->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->statuskepegawaian_id ?>"><?= $value->statuskepegawaian_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="panel-body" id="aktif">
                                            <div class="form-group">
                                                <label>Kedudukan Pegawai</label>
                                                <select class="form-control" name="jenis_jabatan" id="kedudukan_pegawai">
                                                    <option value="">--Pilih Kedudukan Pegawai--</option>
                                                    <?php
                                                    foreach ($jabatan_kedudukan->result() as $value) {
                                                    ?>
                                                        <option value="<?= $value->jeniskedudukan_kode ?>"><?= $value->jeniskedudukan_nama ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group hide">
                                                <label>Nama Jabatan</label>
                                                <select class="form-control selectpicker" data-live-search="true" name="jabatan" id="jabatan">
                                                    <option value="">--Pilih Nama Jabatan--</option>

                                                </select>
                                            </div>
                                            <div class="form-group hide">
                                                <label>TMT Jabatan</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control date" name="jabatan_tmt" id="jabatan_tmt" value="" />
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group hide" id="meninggal">
                                            <label>Keterangan Meninggal</label>
                                            <input type="text" class="form-control" name="keterangan_kematian" />
                                        </div>
                                        <div class="form-group hide" id="pensiun">
                                            <label>Tanggal Pensiun</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control date" name="pegawai_tgl_pensiun" id="pegawai_tgl_pensiun" value="" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>No Karpeg</label>
                                            <input type="text" class="form-control" name="karpeg" />
                                        </div>
                                        <div class="form-group">
                                            <label>No Askes / BPJS</label>
                                            <input type="text" class="form-control" name="askes" />
                                        </div>
                                        <div class="form-group">
                                            <label>No Taspen</label>
                                            <input type="text" class="form-control" name="taspen" />
                                        </div>
                                        <div class="form-group">
                                            <label>No Karis / Karsu</label>
                                            <input type="text" class="form-control" name="karis_karsu" />
                                        </div>
                                        <div class="form-group">
                                            <label>No NPWP</label>
                                            <input type="text" class="form-control" name="npwp" />
                                        </div>
                                        <div class="form-group">
                                            <label>No KK</label>
                                            <input type="text" class="form-control" name="kk" />
                                        </div>
                                        <div class="form-group">
                                            <label>No KTP</label>
                                            <input type="text" class="form-control" name="ktp" />
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" />
                                        </div>
                                        <div class="form-group">
                                            <label>Masuk Sanggau <br>
                                            <input type="checkbox" name="pegawai_masuk_sanggau" id="pegawai_masuk_sanggau" value="1" />
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <input type="file" id="userfile" name="userfile" class="form-control" accept="image/*" />
                                        </div>

                                    </div>
                                    <!-- /.panel-body -->
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
    function edit(id, nama) {
        $('#edit_id').val(id);
        $('#edit_nama').val(nama);
    }
</script>
<script>
    $(function() {
        $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

    function cekAdaNip() {
        var nip = $('#nip').val();
        var l = nip.length;
        var ret = false;
        if (l > 0) {

            $.ajax({
                url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiByNip') ?>',
                type: "POST",
                data: {
                    nip: $('#nip').val()
                },
                dataType: "json",
                async: false,
                success: function(data) {
                    if (data.length > 0) {
                        $('#msgnip').html('<i class="fa fa-close text-danger"></i> Nip Sudah Digunakan');
                        $('#divnip').addClass('has-error');
                        $('#divnip').focus();
                    } else {
                        $('#msgnip').html('<i class="fa fa-check text-success"></i>');
                        $('#divnip').removeClass('has-error');
                        ret = true;
                    }
                }
            });

            if (l == 18) {
                var nips = nip.split("");
                $('#tgl_lahir').val(nips[0] + nips[1] + nips[2] + nips[3] + "-" + nips[4] + nips[5] + "-" + nips[6] + nips[7]).change();
                $('#jenis_kelamin').val(nips[14]).change();
                //                alert(nips[14]);
            }


        } else {
            $('#msgnip').html('<i class="fa fa-close text-danger"></i> NIP belum diisi');
            $('#divnip').addClass('has-error');
            $('#divnip').focus();
        }
        return ret;
    }

    function validasiInput() {
        var nip = $('#nip').val();
        var tgl = $('#tgl_lahir').val();
        var status = $('#status_pegawai').val();
        var cpns = $('#pegawai_cpns_tmt').val();
        var jk = $('#jenis_kelamin').val();
        var l = nip.length;
        ret = true;

        if (l <= 0) {
            $('#msgnip').html("NIP tidak boleh kosong");
            $('#divnip').addClass('has-error');
            $('#nip').focus();
            ret = false;
        }


        if (status === "1" || status === "2") {
            var acek = tgl.substring(0, 4) + tgl.substring(5, 7) + tgl.substring(8, 10) + cpns.substring(0, 4) + cpns.substring(5, 7) + jk;
            var anip = nip.substring(0, 15);
            if (acek !== anip) {
                $('#msgnip').html("NIP tidak valid cek kembali NIP/Tgl lahir/TMT CPNS/Jenis Kelamin " + acek + "!=" + anip);
                $('#divnip').addClass('has-error');
                $('#nip').focus();
                ret = false;
            }
            if (l < 18) {
                $('#msgnip').html("NIP tidak valid. kurang dari 18 angka");
                $('#divnip').addClass('has-error');
                $('#nip').focus();
                ret = false;
            }
        }

        if (l > 0) {
            $.ajax({
                url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiByNip') ?>',
                type: "POST",
                data: {
                    nip: $('#nip').val()
                },
                dataType: "json",
                async: false,
                success: function(data) {
                    if (data.length > 0) {
                        $('#msgnip').html('Nip Sudah Digunakan');
                        $('#divnip').addClass('has-error');
                        $('#nip').focus();
                        ret = false;
                    }
                }
            });


        }
        return true;
    }
</script>
<script>
    $(document).ready(
        function() {


            $('#propinsi').change(
                function() {
                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listKabupatenByIdPropinsi/') ?>/' + $('#propinsi').val(),
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
                        url: '<?= site_url('referensi/ReferensiJson/listKecamatanByIdKabupaten/') ?>/' + $('#kabupaten').val(),
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
                        url: '<?= site_url('referensi/ReferensiJson/listKelurahanByIdKecamatan/') ?>/' + $('#kecamatan').val(),
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


            $('#kedudukan_pegawai').change(
                function() {
                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listJabatanByKedudukanId/') ?>/' + $('#kedudukan_pegawai').val(),
                        type: "POST",
                        data: {
                            ajax: '1'
                        },
                        dataType: "html",
                        success: function(data) {
                            $('#jabatan').html(data);
                        }
                    });
                }
            );


        }

    );
</script>