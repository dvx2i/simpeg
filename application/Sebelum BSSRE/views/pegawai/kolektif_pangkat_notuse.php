<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            
        </h1>
    </section>


    <section class="content">

        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body ">
                        <form id="formadd" role="form" action="<?= site_url('pegawai/KolektifPangkat/add') ?>" method="post" enctype="multipart/form-data">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> KOLEKTIF KENAIKAN PANGKAT / GOLONGAN</b>
                                    </div>
                                    <div class="panel-body">
                                        <input type="hidden" class="form-control" name="kolektif_pangkat_id" id="kolektif_pangkat_id" value=""/>
                                        
                                        <div class="form-group">
                                            <label >Jenis Kenaikan</label>
                                            <select class="form-control" name="kolektif_pangkat_kenaikan_id" id="kolektif_pangkat_kenaikan_id" required="true">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($kenaikan_pangkat->result() as $value) {
                                                    ?>
                                                    <option value="<?= $value->kenaikan_pangkat_id ?>" ><?= $value->kenaikan_pangkat_nama ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>TMT</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control date" required="true" name="kolektif_pangkat_tmt" id="kolektif_pangkat_tmt" autocomplete="off"  value=""/>
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar text-danger"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Pejabat Yang Menetapkan</label>
                                            <select class="form-control "  name="kolektif_pangkat_pejabat" id="kolektif_pangkat_pejabat">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pejabat->result() as $value) {
                                                    ?>
                                                    <option value="<?= $value->pejabat_nama ?>"   ><?= $value->pejabat_nama ?></option>
                                                        <?php } ?>    
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label>No SK</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control col-lg-6" name="kolektif_pangkat_no_sk" id="kolektif_pangkat_no_sk" autocomplete="off" value=""/>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal</div>
                                                        </span>
                                                        <input type="text" autocomplete="off" class="form-control date" name="kolektif_pangkat_tgl_sk" id="kolektif_pangkat_tgl_sk" value=""/>
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar text-danger"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label >Jenis Jabatan</label>
                                            <select class="form-control" name="kolektif_pangkat_jabatan_jenis_id" id="kolektif_pangkat_jabatan_jenis_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($kedudukan_jabatan->result() as $value) {
                                                    ?>
                                                    <option value="<?= $value->jeniskedudukan_kode ?>" ><?= $value->jeniskedudukan_nama ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>File Excel</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" accept=".xlsx" required="true" name="userfile" id="userfile" autocomplete="off"  value=""/>
                                                <span class="input-group-addon">
                                                    <i class="fa fa-file-excel-o text-danger"></i>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="input-group-addon">                                        
                                            <button type="submit" class="btn btn-success" >Simpan</button>
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
                    <div class="panel-heading">
                                        <b> DOWNLOAD FORMAT EXCEL</b>
                                    </div>
                    <div class="box-body">
                        <a href="<?= $format_excel?>" target="_blank" class="btn btn-default"><i class="fa fa-file-excel-o text-success"></i> FORMAT KOLEKTIF KENAIKAN PANGKAT</a>
                        <hr/>
                        <?php echo $this->session->flashdata('upload'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="riwayat">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Riwayat Upload Kolektif Kenaikan Pangkat Golongan
                    </div>
                    <div class="panel-body">
                        <div class="box-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. SK</th>
                                        <th>Tgl. SK</th>
                                        <th>TMT</th>
                                        <th>Jenis Kenaikan</th>
                                        <th>Pejabat</th>
                                        <th>Tanggal Upload</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($result->result() as $value) {
                                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $value->kolektif_pangkat_no_sk ?></td>
                                            <td><?= tgl_indo($value->kolektif_pangkat_tgl_sk) ?></td>
                                            <td><?= tgl_indo($value->kolektif_pangkat_tmt) ?></td>
                                            <td><?= $value->kolektif_pangkat_jabatan_jenis_nama ?></td>
                                            <td><?= $value->kolektif_pangkat_pejabat ?></td>
                                            <td><?= $value->create_at ?></td>
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
            function () {


                $('#jenis_jabatan').change(
                        function () {
                            var jabatan = $(this).val();
                            // load kedudukan jabatan
                            $.ajax({
                                url: '<?= site_url('referensi/ReferensiJson/listJabatanByKedudukanId/') ?>',
                                type: "POST",
                                data: {ajax: '1', id: jabatan},
                                dataType: "html",
                                success: function (data) {
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

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiPangkatById') ?>',
            type: "POST",
            data: {ajax: '1', id: v},
            dataType: "json",
            async: true,
            success: function (data) {
                $('#pegawaipangkat_id').val(data.pegawaipangkat_id);
                $('#pegawaipangkat_pangkat_id').val(data.pegawaipangkat_pangkat_id).change();
                $('#pegawaipangkat_kenaikan_pangkat_id').val(data.pegawaipangkat_kenaikan_id).change();
                $('#pegawaipangkat_tmt').val(data.pegawaipangkat_tmt);
                $('#pegawaipangkat_sk_date').val(data.pegawaipangkat_sk_date);
                $('#pegawaipangkat_sk_no').val(data.pegawaipangkat_sk_no);
                $('#pegawaipangkat_sk_pejabat').val(data.pegawaipangkat_sk_pejabat).change();
                $('#pegawaipangkat_angka_kredit').val(data.pegawaipangkat_angka_kredit);
                $('#pegawaipangkat_masa_kerja_tahun').val(data.pegawaipangkat_masa_kerja_tahun);
                $('#pegawaipangkat_masa_kerja_bulan').val(data.pegawaipangkat_masa_kerja_bulan);
                $('#pegawaipangkat_gaji_pokok').val(data.pegawaipangkat_gaji_pokok);
                $('#pegawaipangkat_unit_kerja_id').val(data.pegawaipangkat_unit_kerja_id).change();
                $('#jenis_jabatan').val(data.pegawaipangkat_jenis_jabatan_id);
                var pegawaipangkat_jabatan_id = data.pegawaipangkat_jabatan_id;
                var jabatan = $('#jenis_jabatan').val();
                $.ajax({
                    url: '<?= site_url('referensi/ReferensiJson/listJabatanByKedudukanId/') ?>',
                    type: "POST",
                    data: {ajax: '1', id: jabatan},
                    dataType: "html",
                    success: function (data) {
                        $('#jabatan').html(data);
                        $('#jabatan').val(pegawaipangkat_jabatan_id).change();
                    }
                });
                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiRiwayatPangkat/update') ?>');

            }
        });

    }
    
    function refresh() {
    $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiRiwayatPangkat/add') ?>');
    $('#jabatan').html('<option>--Pilih--</option>');
    document.getElementById('formadd').reset();
}

</script>
