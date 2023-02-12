<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            <?= pegawai_nama_lengkap($pegawai) ?>
        </h1>
    </section>


    <section class="content">

        <?php
        if (isset($pegawai)) {
        ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-header">
                        </div>
                        <div class="box-body ">
                            <form id="formadd" role="form" action="<?= site_url('pegawai/PegawaiCuti/add') ?>" method="post" enctype="multipart/form-data">
                                <!-- <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" /> -->
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <b> Form Cuti</b>
                                        </div>
                                        <div class="panel-body">
                                            <input type="hidden" class="form-control" value="<?= $pegawai->pegawai_nip ?>" name="pegawaicuti_pegawai_nip" id="pegawaicuti_pegawai_nip" />
                                            <input type="hidden" name="pegawaicuti_id" id="pegawaicuti_id">

                                            <!-- <div class="form-group">
                                                <label>NIP</label>
                                                <input type="text" class="form-control" value="<?= $pegawai->pegawai_nip ?>" readonly="true" />
                                                
                                            </div> -->

                                            <!-- <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" value="<?= $pegawai->pegawai_nama . ' ' . $pegawai->pegawai_gelar_belakang ?>" readonly="true" />
                                            </div> -->
                                            <div class="form-group">
                                                <label>Jenis Cuti</label>
                                                <select class="form-control" name="pegawaicuti_jeniscuti_id" id="pegawaicuti_jeniscuti_id" required="true">
                                                    <option value="">--Pilih--</option>
                                                    <?php
                                                    foreach ($jenis_cuti->result() as $value) {
                                                    ?>
                                                        <option value="<?= $value->jenis_cuti_id ?>"><?= $value->jenis_cuti_nama ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Tanggal Mulai</label>
                                                <div class="input-group">

                                                    <input type="text" class="form-control dateEntry" required="true" name="pegawaicuti_lama_cuti_mulai" id="pegawaicuti_lama_cuti_mulai" autocomplete="off" value="" />
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar text-danger"></i>
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Selesai</label>
                                                <div class="input-group">

                                                    <input type="text" class="form-control dateEntry" required="true" name="pegawaicuti_lama_cuti_selesai" id="pegawaicuti_lama_cuti_selesai" autocomplete="off" value="" />
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar text-danger"></i>
                                                    </span>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label>Pejabat Yang Menetapkan</label>
                                                <select class="form-control select2" name="pegawaicuti_pejabat" id="pegawaicuti_pejabat">
                                                    <option value="">--Pilih--</option>
                                                    <?php
                                                    foreach ($pejabat->result() as $value) {
                                                    ?>
                                                        <option value="<?= $value->pejabat_nama ?>"><?= $value->pejabat_nama ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <label>No SI Cuti</label>
                                                <input type="text" class="form-control" name="pegawaicuti_sk_no" id="pegawaicuti_sk_no" autocomplete="off" value="" />
                                            </div>

                                            <div class="form-group">
                                                <label>Tgl SI Cuti</label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="off" class="form-control dateEntry" name="pegawaicuti_sk_tanggal" id="pegawaicuti_sk_tanggal" value="" />
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar text-danger"></i>
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
                        <div class="box-body">
                            <?= $menu_pegawai ?>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="row" id="riwayat">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div style="float: right;padding-top: 3px;padding-right: 13px">
                            <a href="#" onclick="refresh()" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
                        </div>
                        <div class="panel-heading">
                            <i class="fa fa-users fa-fw"></i> Riwayat
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th scope="col" style="text-align: center;min-width: 30px;width: 50px" style="text-align: center">NO</th>
                                            <th style="min-width: 60px;width: 75px" class="text-center">Aksi</th>
                                            <th scope="col" style="text-align: center">NIP</th>
                                            <th scope="col" style="text-align: center">NAMA</th>
                                            <th scope="col" style="text-align: center">JENIS CUTI</th>
                                            <th scope="col" style="text-align: center">TGL. MULAI CUTI</th>
                                            <th scope="col" style="text-align: center">TGL. SELESAI CUTI</th>
                                            <th scope="col" style="text-align: center">NO SI CUTI, TGL SI CUTI, PEJABAT PENETAP</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($result->result() as $value) {
                                        ?>
                                            <tr>
                                                <td class="text-center nowrap"><?= $no ?></td>
                                                <td class="text-left nowrap">

                                                    <a href="#formadd" onclick="edit('<?= $value->pegawaicuti_id ?>')" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i></a>
                                                    <a href="<?= site_url('pegawai/PegawaiCuti/delete/' . $value->pegawaicuti_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Menghapus Data.?')"><i class="fa fa-trash-o fa-fw"></i></a>

                                                </td>
                                                <td><?= $value->pegawaicuti_pegawai_nip ?></td>
                                                <td><?= $value->pegawai_nama ?></td>
                                                <td><?= $value->jenis_cuti_nama ?></td>
                                                <td><?= tgl($value->pegawaicuti_lama_cuti_mulai) ?></td>
                                                <td><?= tgl($value->pegawaicuti_lama_cuti_selesai) ?></td>
                                                <td><?= $value->pegawaicuti_sk_no . ', ' . tgl($value->pegawaicuti_sk_tanggal) . ', ' . $value->pegawaicuti_pejabat ?></td>
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

        <?php
        }
        ?>

    </section>
</div>
<script>
    function edit(v) {

        $.ajax({

            url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiCutiById') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {
                $('#pegawaicuti_id').val(data.pegawaicuti_id);
                // $('#pegawaicuti_pegawai_nip').val(data.pegawaicuti_pegawai_nip);
                $('#pegawaicuti_jeniscuti_id').val(data.pegawaicuti_jeniscuti_id).change();
                $('#pegawaicuti_lama_cuti_mulai').datetextentry('set_date', data.pegawaicuti_lama_cuti_mulai);
                $('#pegawaicuti_lama_cuti_selesai').datetextentry('set_date', data.pegawaicuti_lama_cuti_selesai);
                $('#pegawaicuti_sk_tanggal').datetextentry('set_date', data.pegawaicuti_sk_tanggal);
                $('#pegawaicuti_sk_no').val(data.pegawaicuti_sk_no);
                $('#pegawaicuti_pejabat').val(data.pegawaicuti_pejabat).change();
                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiCuti/update') ?>');

            }
        });

    }

    $('#pegawaicuti_lama_cuti_mulai').keyup(function(e) {

        console.log($(this).val());
        var target = e.srcElement || e.target;
        var maxLength = parseInt(target.attributes["maxlength"].value, 10);
        var myLength = target.value.length;
        alert(myLength);
        return false;
        // if (myLength >= maxLength) {
        //     var next = $('#pegawai_cpns_masa_kerja_bulan');
        //     next.focus();
        // }
    });



    function refresh() {
        $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiCuti/add') ?>');
        // $('#jabatan').html('<option>--Pilih--</option>');
        document.getElementById('formadd').reset();
    }
</script>