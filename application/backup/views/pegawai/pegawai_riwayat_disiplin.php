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
                        <form id="formadd" role="form" action="<?= site_url('pegawai/PegawaiDisiplin/add') ?>" method="post" enctype="multipart/form-data">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> RIWAYAT HUKUMAN ADMINISTRATIF</b>
                                    </div>
                                    <div class="panel-body">
                                        <input type="hidden" class="form-control" name="pegawaidisiplin_id" id="pegawaidisiplin_id" value="<?php
                                                                                                                                            if (isset($data_pegawai)) {
                                                                                                                                                echo $data_pegawai->pegawaidisiplin_id;
                                                                                                                                            }
                                                                                                                                           ?>" />
                                    
                                    <?php /* 
                                        <div class="form-group">
                                            <label>Unit Kerja</label>
                                            <select class="form-control select2" data-live-search="true" name="pegawai_unit_id" id="opd">
                                                <?php
                                                foreach ($unit->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->unit_id ?>" <?php
                                                                                            selected($value->unit_id, $pegawai->pegawai_unit_id);
                                                                                            ?>><?= $value->unit_nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Jenis Jabatan</label>
                                            <select class="form-control" name="pegawai_jenis_jabatan_id" id="jenis_jabatan">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($kedudukan_jabatan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jeniskedudukan_kode ?>" <?php
                                                                                                        selected($value->jeniskedudukan_kode, $pegawai->pegawai_jenisjabatan_kode);
                                                                                                        ?>><?= $value->jeniskedudukan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Jabatan</label>
                                            <select class="form-control select2" name="pegawai_jabatan_id" id="jabatan">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($jabatan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jabatan_id ?>" <?php
                                                                                                selected($value->jabatan_id, $pegawai->pegawai_jabatan_id);
                                                                                                ?>><?= $value->jabatan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pangkat, Golongan/Ruang</label>
                                            <select class="form-control" name="pegawai_pangkat_id" id="pegawai_pangkat_id" required="true">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pangkat_golongan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pangkat_golongan_id ?>" <?php selected($value->pangkat_golongan_id, $pegawai->pegawai_pangkat_terakhir_id); ?>><?= $value->pangkat_golongan_text ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        */
                                        ?>
                                        <div class="form-group">
                                            <label>Jenis Hukuman</label>
                                            <select class="form-control" name="pegawaidisiplin_jenishukuman_id" id="pegawaidisiplin_jenishukuman_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($jenis_hukuman->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jenis_hukuman_id ?>"><?= $value->jenis_hukuman_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>No SK</label>
                                            <input type="text" class="form-control" name="pegawaidisiplin_no_sk" id="pegawaidisiplin_no_sk" autocomplete="off" />
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal SK</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaidisiplin_tanggal" id="pegawaidisiplin_tanggal" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label>Pejabat Yang Menetapkan</label>
                                            <select class="form-control " name="pegawaidisiplin_pejabat" id="pegawaidisiplin_pejabat">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pejabat->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pejabat_nama ?>" <?php
                                                                                                if (isset($pegawai_pangkat)) {
                                                                                                    selected($value->pejabat_nama, $pegawai_pangkat->pegawaipangkat_sk_pejabat);
                                                                                                }
                                                                                                ?>><?= $value->pejabat_nama ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label>Mulai</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaidisiplin_mulai" id="pegawaidisiplin_mulai" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>Selesai</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaidisiplin_selesai" id="pegawaidisiplin_selesai" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" class="form-control" name="pegawaidisiplin_keterangan" id="pegawaidisiplin_keterangan" />
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
                        <a href="#formadd" onclick="refresh()" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
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
                                        <th>Jenis Hukuman</th>
                                        <th>No. SK, Tgl. SK</th>
                                        <th>Pejabat Pengesah</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Keterangan</th>

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
                                                <a href="#formadd" onclick="edit('<?= $value->pegawaidisiplin_id ?>');" class="btn btn-warning btn-sm" type="button"><i class="fa fa-edit"></i></a>
                                                <a href="<?= site_url('pegawai/PegawaiDisiplin/delete/' . $value->pegawaidisiplin_id) ?>" onclick="return confirm('Apakah anda yakin menghapus riwayat pangkat.?')" class="btn btn-danger btn-sm" type="button"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td><?= $value->pegawaidisiplin_jenishukuman_nama ?></td>
                                            <td><?= 'No.' . $value->pegawaidisiplin_no_sk . '<br/> Tgl. ' . tgl_indo($value->pegawaidisiplin_tanggal)  ?></td>
                                            <td><?= $value->pegawaidisiplin_pejabat ?></td>
                                            <td><?= tgl_indo($value->pegawaidisiplin_mulai)  ?></td>
                                            <td><?= tgl_indo($value->pegawaidisiplin_selesai) ?></td>
                                            <td><?= $value->pegawaidisiplin_keterangan ?></td>

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
    $(document).ready(
        function() {


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

    function edit(v) {

        $.ajax({

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiDisiplinById') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {
                $('#pegawaidisiplin_id').val(data.pegawaidisiplin_id);
                $('#pegawaidisiplin_jenishukuman_id').val(data.pegawaidisiplin_jenishukuman_id).change();
                $('#pegawai_pangkat_id').val(data.pegawai_pangkat_id).change();
                $('#pegawaidisiplin_no_sk').val(data.pegawaidisiplin_no_sk);
                $('#pegawaidisiplin_tanggal').datetextentry('set_date', data.pegawaidisiplin_tanggal);
                $('#pegawaidisiplin_pejabat').val(data.pegawaidisiplin_pejabat);
                $('#pegawaipangkat_sk_pejabat').val(data.pegawaipangkat_sk_pejabat).change();
                $('#pegawaidisiplin_mulai').datetextentry('set_date', data.pegawaidisiplin_mulai);
                $('#pegawaidisiplin_selesai').datetextentry('set_date', data.pegawaidisiplin_selesai);
                $('#pegawaidisiplin_keterangan').val(data.pegawaidisiplin_keterangan);
                $('#pegawai_unit_id').val(data.pegawai_unit_id).change();
                $('#jenis_jabatan').val(data.pegawai_jenis_jabatan_id);
                var pegawai_jabatan_id = data.pegawai_jabatan_id;
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
                        $('#jabatan').html(data);
                        $('#jabatan').val(pegawai_jabatan_id).change();
                    }
                });
                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiDisiplin/update') ?>');

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
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiDisiplin/add') ?>');
        $('#jabatan').val('<?= $pegawai->pegawai_jabatan_id ?>').change();
        document.getElementById('formadd').reset();
    }
</script>