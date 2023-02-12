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
                    <div class="box-body table-responsive">
                        <form id="formadd" role="form" action="<?= site_url('pegawai/KolektifJabatan/add') ?>" method="post" enctype="multipart/form-data">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> KOLEKTIF MUTASI JABATAN</b>
                                    </div>
                                    <div class="panel-body">
                                        

                                        <div class="form-group">
                                            <label >Jenis Perubahan Jabatan</label>
                                            <select class="form-control" name="kolektif_jabatan_kenaikan_id" id="kolektif_jabatan_kenaikan_id" required="true">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                        foreach ($kenaikan_jabatan->result() as $value) {
                                                            ?>
                                                    <option value="<?= $value->kenaikan_jabatan_id ?>" ><?= $value->kenaikan_jabatan_nama ?></option>
    <?php
}
?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label >Jenis Jabatan</label>
                                            <select class="form-control" name="kolektif_jabatan_jenis_id" id="kolektif_jabatan_jenis_id" required="true">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($jenis_jabatan->result() as $value) {
                                                    ?>
                                                    <option value="<?= $value->jeniskedudukan_kode ?>" ><?= $value->jeniskedudukan_nama ?></option>
    <?php
}
?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Ditetapkan Oleh</label>
                                            <select class="form-control "  name="kolektif_jabatan_pejabat" id="kolektif_jabatan_pejabat" required="true">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pejabat->result() as $value) {
                                                    ?>
                                                    <option value="<?= $value->pejabat_nama ?>" ><?= $value->pejabat_nama ?></option>
                                                        <?php } ?>    
                                            </select>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>No SK</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control col-lg-4" name="kolektif_jabatan_sk_no" id="kolektif_jabatan_sk_no"/>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal</div>
                                                        </span>
                                                        <input type="text" class="form-control date" name="kolektif_jabatan_sk_tanggal" id="kolektif_jabatan_sk_tanggal" value="" autocomplete="off"/>
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

                                                <input type="text" class="form-control date" name="kolektif_jabatan_tmt" id="kolektif_jabatan_tmt"  value="" autocomplete="off"/>
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pelantikan</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control date" name="kolektif_jabatan_pelantikan_tanggal" id="kolektif_jabatan_pelantikan_tanggal"  value="" autocomplete="off"/>
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>

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
                    <div class="panel-heading">
                                        <b> DOWNLOAD FORMAT EXCEL</b>
                                    </div>
                    <div class="box-body">
                        <a href="<?= $format_excel?>" target="_blank" class="btn btn-default"><i class="fa fa-file-excel-o text-success"></i> FORMAT KOLEKTIF MUTASI JABATAN</a>
                        <hr/>
                        <?php echo $this->session->flashdata('upload'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="riwayat">
            <div class="col-lg-12">
                <div class="panel panel-default" id="riwayat">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <a href="#" onclick="refresh()" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
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
                                        <th>No. SK</th>
                                        <th>Tgl. SK</th>
                                        <th>TMT</th>
                                        <th>Jenis Mutasi</th>
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
                                            <td><?= $value->kolektif_jabatan_sk_no ?></td>
                                            <td><?= tgl_indo($value->kolektif_jabatan_sk_tanggal) ?></td>
                                            <td><?= tgl_indo($value->kolektif_jabatan_tmt) ?></td>
                                            <td><?= $value->kolektif_jabatan_kenaikan_nama ?></td>
                                            <td><?= $value->kolektif_jabatan_pejabat ?></td>
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

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiJabatanById') ?>',
            type: "POST",
            data: {ajax: '1', id: v},
            dataType: "json",
            async: true,
            success: function (data) {
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
                    data: {ajax: '1', id: jabatan},
                    dataType: "html",
                    success: function (data) {
                        $('#jabatan').html(data);
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
