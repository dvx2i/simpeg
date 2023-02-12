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
                        <form id="formadd" role="form" action="<?= site_url('pegawai/PegawaiRiwayatPendidikan/add') ?>" method="post" enctype="multipart/form-data">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> RIWAYAT PENDIDIKAN</b>
                                    </div>
                                    <div class="panel-body">
                                        <input type="hidden" class="form-control" name="pegawaipendidikan_id" id="pegawaipendidikan_id" />
                                        <div class="form-group">
                                            <label>Nama Instansi Pendidikan</label>
                                            <input type="text" class="form-control" name="pegawaipendidikan_pendidikan_nama" required="true" id="pegawaipendidikan_pendidikan_nama" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tingkat Pendidikan</label>
                                            <select class="form-control select2" name="pegawaipendidikan_pendidikan_tingkat_id" id="pegawaipendidikan_pendidikan_tingkat_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pendidikan_tingkat->result() as $value) {
                                                    echo '<option value="' . $value->pendidikan_tingkat_kode . '">' . $value->pendidikan_tingkat_nama . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group" id="rumpun">
                                            <label>Fakultas / Rumpun</label>
                                            <select class="form-control select2" name="pegawaipendidikan_rumpun_id" id="pegawaipendidikan_rumpun_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pendidikan->result() as $value) {
                                                    echo '<option value="' . $value->pendidikan_id . '">' . $value->pendidikan_nama . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!--                                        <div class="form-group">
                                                                                    <label >Jurusan / Prodi</label>
                                                                                    <select class="form-control select2"  name="pegawaipendidikan_jurusan_id" id="pegawaipendidikan_jurusan_id">
                                                                                        <option value="">--Pilih--</option>
                                        <?php
                                        foreach ($jurusan->result() as $value) {
                                            echo '<option value="' . $value->jurusan_id . '">' . $value->jurusan_nama . '</option>';
                                        }
                                        ?>
                                                                                    </select>
                                                                                </div>-->



                                        <div class="form-group">
                                            <label>Pimpinan / Pejabat Yang Menetapkan</label>
                                            <input type="text" class="form-control" name="pegawaipendidikan_nama_pimpinan" id="pegawaipendidikan_nama_pimpinan" autocomplete="off" value="" />
                                        </div>

                                        <div class="form-group">
                                            <label>No Ijazah</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control col-lg-6" name="pegawaipendidikan_nomor_ijazah" autocomplete="off" id="pegawaipendidikan_nomor_ijazah" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal</div>
                                                        </span>
                                                        <input type="text" autocomplete="off" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaipendidikan_tanggal_ijazah" id="pegawaipendidikan_tanggal_ijazah" value="" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar text-danger"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>Nilai</label>
                                            <input type="text" onkeyup="angka(this);" class="form-control" name="pegawaipendidikan_nilai" id="pegawaipendidikan_nilai" />
                                        </div>
<!--                                         <div class="form-group">
                                            <label>Jenis</label>
                                            <select class="form-control" name="pegawaipendidikan_jenis" id="pegawaipendidikan_jenis">
                                                <option value="NEGERI" <?php
                                                                        if (isset($pegawai_pendidikan)) {
                                                                            if ($pegawai_pendidikan->pegawaipendidikan_jenis == "NEGERI") {
                                                                                echo 'selected="selected"';
                                                                            }
                                                                        }
                                                                        ?>>NEGERI</option>
                                                <option value="SWASTA" <?php
                                                                        if (isset($pegawai_pendidikan)) {
                                                                            if ($pegawai_pendidikan->pegawaipendidikan_jenis == "SWASTA") {
                                                                                echo 'selected="selected"';
                                                                            }
                                                                        }
                                                                        ?>>SWASTA</option>
                                            </select>
                                        </div> -->
                                        <div class="form-group" id="div-gelar" style="display: none;">
                                            <label>Gelar</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-4">

                                                    <input type="text" class="form-control" placeholder="depan" name="gelar_depan" value="<?= $pegawai->pegawai_gelar_depan ?>" />
                                                </div>
                                                <div class="col-lg-4">

                                                    <input type="text" class="form-control" name="gelar_belakang" placeholder="belakang" value="<?= $pegawai->pegawai_gelar_belakang ?>" />

                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Pendidikan Pengangkatan Sebagai CPNS <br>
                                            <input type="checkbox" name="pegawaipendidikan_pengangkatan_cpns" id="pegawaipendidikan_pengangkatan_cpns" value="1" /> </label>
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
                                        <th>Tingkat Pendidikan</th>
                                        <th>Nama Instansi</th>
                                        <th>Rumpun</th>
                                        <!--<th>Jurusan</th>-->
                                        <th>Ijazah</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($result->result() as $value) {
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td>
                                                <?= $value->pegawaipendidikan_pendidikan_tingkat_nama ?> <br>
                                                <?= $value->pegawaipendidikan_pengangkatan_cpns == '1' ? '(Pendidikan Pengangkatan Sebagai CPNS)' : '';  ?>
                                            </td>
                                            <td><?= $value->pegawaipendidikan_pendidikan_nama ?></td>
                                            <td><?= $value->pegawaipendidikan_rumpun_nama ?></td>
                                            <!--<td><?= $value->pegawaipendidikan_jurusan_nama ?></td>-->
                                            <td><?= 'No. ' . $value->pegawaipendidikan_nomor_ijazah . '<br/>' . tgl_indo($value->pegawaipendidikan_tanggal_ijazah) ?></td>
                                            <td><?= $value->pegawaipendidikan_nilai ?></td>
                                            <td style="min-width: 75px">
                                                <a href="#formadd" onclick="edit('<?= $value->pegawaipendidikan_id ?>');" class="btn btn-warning btn-sm" type="button"><i class="fa fa-edit"></i></a>
                                                <a href="<?= site_url('pegawai/PegawaiRiwayatPendidikan/delete/' . $value->pegawaipendidikan_id) ?>" onclick="return confirm('Apakah anda yakin menghapus riwayat pendidikan.?');" class="btn btn-danger btn-sm" type="button"><i class="fa fa-trash-o"></i></a>
                                            </td>
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

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiPendidikanById') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {
                $('#pegawaipendidikan_id').val(data.pegawaipendidikan_id);
                $('#pegawaipendidikan_pendidikan_tingkat_id').val(data.pegawaipendidikan_pendidikan_tingkat_id).change();
                $('#pegawaipendidikan_jurusan_id').val(data.pegawaipendidikan_jurusan_id).change();
                $('#pegawaipendidikan_pendidikan_nama').val(data.pegawaipendidikan_pendidikan_nama);
                $('#pegawaipendidikan_nomor_ijazah').val(data.pegawaipendidikan_nomor_ijazah);
                $('#pegawaipendidikan_tanggal_ijazah').datetextentry('set_date', data.pegawaipendidikan_tanggal_ijazah);
                $('#pegawaipendidikan_rumpun_id').val(data.pegawaipendidikan_rumpun_id).change();
                $('#pegawaipendidikan_nama_pimpinan').val(data.pegawaipendidikan_nama_pimpinan);
                $('#pegawaipendidikan_nilai').val(data.pegawaipendidikan_nilai);
                $('#pegawaipendidikan_jenis').val(data.pegawaipendidikan_jenis).change();
                if(data.pegawaipendidikan_pengangkatan_cpns == '1'){
                $('#pegawaipendidikan_pengangkatan_cpns').prop('checked', true);
                }else{
                $('#pegawaipendidikan_pengangkatan_cpns').prop('checked', false);
                }

                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiRiwayatPendidikan/update') ?>');
                if (parseInt(data.pegawaipendidikan_pendidikan_tingkat_id) <= 2) {
                    $('#rumpun').addClass('hide');
                } else {
                    $('#rumpun').removeClass('hide');
                }

            }
        });

    }

    function d_m_y(date) {
        if (date != null) {
            var from = date.split("-");
            return from[2] + "/" + from[1] + "/" + from[0];
        } else {
            return date;
        }
    }


    function refresh() {
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiRiwayatPendidikan/add') ?>');
        document.getElementById('formadd').reset();
    }
</script>

<script>
    $(document).ready(
        function() {
            $('#pegawaipendidikan_pendidikan_tingkat_id').change(
                function() {
                    if (parseInt($('#pegawaipendidikan_pendidikan_tingkat_id').val()) <= 2) {
                        $('#rumpun').addClass('hide');
                    } else {
                        $('#rumpun').removeClass('hide');
                    }
                }

            );
        }

    );

    $('#pegawaipendidikan_pendidikan_tingkat_id').change(
        function() {
            var tingkat = $(this).val();
        if(tingkat > '03'){
        	$('#div-gelar').show();
        }else{
        	$('#div-gelar').hide();
        }
            // load kedudukan jabatan
            $.ajax({
                url: '<?= site_url('referensi/ReferensiJson/listPendidikanByTingkat/') ?>',
                type: "POST",
                data: {
                    ajax: '1',
                    id: tingkat
                },
                dataType: "html",
                success: function(data) {
                    //                                        alert(data.id);
                    $('#pegawaipendidikan_rumpun_id').html(data);
                    //$('#jenis_kedudukan_nama').val(data.nama);
                }
            });

        }
    );
</script>