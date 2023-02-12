<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Daftar Status Pegawai <?=$filter_nama?>
        </h1>
    </section>


    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        
                    </div>
                    <div class="box-body ">
                        <form id="formadd" class="btn"  method="post" enctype="multipart/form-data">
                            <input name="pegawai_status_kepegawaian_id" type="hidden" value=""/>
                            <div>
                                <button type="submit" class="btn <?php if(empty($filter_id)) echo 'btn-warning';else echo'btn-primary'; ?>">SEMUA</button>
                            </div>
                        </form>
                        <?php
                        foreach ($status_kepegawaian->result() as $value) {
                        ?>
                        <form id="formadd" class="btn"  method="post" enctype="multipart/form-data">
                            <input name="pegawai_status_kepegawaian_id" type="hidden" value="<?=$value->statuskepegawaian_id?>"/>
                            <div>
                                <button type="submit" class="btn <?php if($value->statuskepegawaian_id == $filter_id) echo 'btn-warning';else echo'btn-primary'; ?>"><?=$value->statuskepegawaian_nama?></button>
                            </div>
                        </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row" id="riwayat">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <a href="<?= site_url('laporan/DaftarStatusPegawai/excel/'.$filter_id)?>" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Daftar Status Pegawai <?=$filter_nama?> 
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Pangkat / Golru</th>
                                    <th>Jabatan</th>
                                    <th>OPD/Unit Kerja</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if(!empty($result)){
                                foreach ($result->result() as $value) {
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->pegawai_nip ?></td>
                                        <td><?= $value->pegawai_nama ?></td>
                                        <td><?= $value->pegawai_pangkat_terakhir_nama.'<br/> ( '.$value->pegawai_pangkat_terakhir_golru .' )' ?></td>
                                        <td><?= $value->pegawai_jabatan_nama ?></td>
                                        <td><?= $value->pegawai_unit_nama ?></td>
                                        
                                    </tr>
                                    <?php
                                    $no++;
                                }
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

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiTugasBelajarById') ?>',
            type: "POST",
            data: {ajax: '1', id: v},
            dataType: "json",
            async: true,
            success: function (data) {
                $('#tugasbelajar_id').val(data.tugasbelajar_id);
                $('#tugasbelajar_no_sk').val(data.tugasbelajar_no_sk);
                $('#tugasbelajar_tanggal_sk').val(data.tugasbelajar_tanggal_sk);
                $('#tugasbelajar_mulai').val(data.tugasbelajar_mulai);
                $('#tugasbelajar_selesai').val(data.tugasbelajar_selesai);
                $('#tugasbelajar_pendanaan_id').val(data.tugasbelajar_pendanaan_id).change();
                $('#tugasbelajar_pendidikan_id').val(data.tugasbelajar_pendidikan_id).change();
                $('#tugasbelajar_jurusan_id').val(data.tugasbelajar_jurusan_id).change();                
                $('#tugasbelajar_pendidikan_tingkat_id').val(data.tugasbelajar_pendidikan_tingkat_id).change();
                $('#tugasbelajar_nama_pendidikan').val(data.tugasbelajar_nama_pendidikan);
                $('#tugasbelajar_keterangan').val(data.tugasbelajar_keterangan);
                $('#tugasbelajar_jenis').val(data.tugasbelajar_jenis).change();
                $('#tugasbelajar_tahun').val(data.tugasbelajar_tahun);
                $('#tugasbelajar_nilai').val(data.tugasbelajar_nilai);
                $('#tugasbelajar_pejabat').val(data.tugasbelajar_pejabat).change();

                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiTugasBelajar/update') ?>');

            }
        });

    }

    function refresh() {
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiTugasBelajar/add') ?>');
        document.getElementById('formadd').reset();
    }

</script>
