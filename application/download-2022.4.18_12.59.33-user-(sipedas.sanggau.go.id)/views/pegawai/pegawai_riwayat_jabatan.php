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
                    <div class="box-body table-responsive">
                        <form id="formadd" role="form" action="<?= site_url('pegawai/PegawaiRiwayatJabatan/add') ?>" method="post" enctype="multipart/form-data">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> RIWAYAT JABATAN</b>
                                    </div>
                                    <div class="panel-body">
                                        <input type="hidden" class="form-control" name="pegawaijabatan_id" id="pegawaijabatan_id" />
                                        <div class="form-group">
                                            <label>Unit Kerja</label>
                                            <select class="form-control selectpicker select2" data-live-search="true" name="pegawaijabatan_unit_kerja_id" id="pegawaijabatan_unit_kerja_id" required="true">
                                            <option></option>    
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
                                            <label>Sub Unit</label>
                                            <select class="form-control select2" data-live-search="true" name="pegawaijabatan_sub_unit_id" id="pegawaijabatan_sub_unit_id">
                                                <option value="">--Pilih--</option>
                                            <?php
                                                foreach ($unit->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->unit_id ?>" <?php
                                                                                            selected($value->unit_id, $pegawai->pegawai_sub_unit_id);
                                                                                            ?>><?= $value->unit_nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <!-- <div class="form-group">
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
                                        </div> -->
                                        <div class="form-group">
                                            <label>Jenis Jabatan</label>
                                            <select class="form-control" name="pegawaijabatan_jenisjabatan_id" id="jenis_jabatan" required="true">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($jenis_jabatan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jeniskedudukan_kode ?>" <?php selected($value->jeniskedudukan_kode, $pegawai->pegawai_jenisjabatan_kode); ?>><?= $value->jeniskedudukan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Jabatan Lama</label>
                                            <input type="text" class="form-control" name="pegawai_jabatan_nama" id="pegawai_jabatan_nama" value="<?= $pegawai->pegawai_jabatan_nama ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Jabatan</label>
                                            <select class="form-control select2" name="pegawaijabatan_jabatan_id" id="jabatan">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($jabatan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jabatan_id ?>" <?php
                                                                                                selected($value->jabatan_id, $pegawai->pegawai_jabatan_id)
                                                                                                ?>><?= $value->jabatan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- <div class="form-group" id="form-jabatan-baru" style="display: none;">
                                            <label>Nama Jabatan Terbaru (2020)</label> <br>
                                            <select class="form-control select2" style="width: 634px;" name="pegawaijabatan_jabatan_id_baru" id="jabatan_baru">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($jabatan_baru->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->jabatan_id ?>" <?php
                                                                                                selected($value->jabatan_id, $pegawai->pegawai_jabatan_id)
                                                                                                ?>><?= $value->jabatan_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div> -->

<!--                                         <div class="form-group">
                                            <label>Pangkat, Gol/Ruang</label>
                                            <select class="form-control" name="pegawaijabatan_pangkat_id" id="pegawaijabatan_pangkat_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pangkat_golongan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pangkat_golongan_id ?>" <?php
                                                                                                        selected($value->pangkat_golongan_id, $pegawai->pegawai_pangkat_terakhir_id);
                                                                                                        ?>><?= $value->pangkat_golongan_text ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div> -->
                                        <div class="form-group">
                                            <label>Kelas Jabatan</label>
                                            <select class="form-control select2" name="pegawaijabatan_kelas_id" id="pegawaijabatan_kelas_id" >
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($kelas->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->kelas_id ?>"><?= $value->kelas_nama ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label>Ditetapkan Oleh</label>
                                            <select class="form-control select2" name="pegawaijabatan_pejabat" id="pegawaijabatan_pejabat" >
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
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control col-lg-4" name="pegawaijabatan_sk_no" id="pegawaijabatan_sk_no" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal</div>
                                                        </span>
                                                        <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaijabatan_sk_tanggal" id="pegawaijabatan_sk_tanggal" value="" autocomplete="off" />
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

                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaijabatan_tmt" id="pegawaijabatan_tmt" value="" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>

                                        </div>
<!--                                         <div class="form-group" id="form-pegawaijabatan_tgl_pelantikan">
                                            <label>Tanggal Pelantikan</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaijabatan_tgl_pelantikan" id="pegawaijabatan_tgl_pelantikan" value="" autocomplete="off" />
                                                <span class="input-group-btn">
                                                    <div class="btn btn-default"><i class="fa fa-calendar text-danger"></i></div>
                                                </span>
                                            </div>

                                        </div> -->

                                        <!-- <div class="form-group">
                                            <label>Masa Kerja</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <input type="text" onkeyup="angka(this);" maxlength="2" class="form-control" name="pegawaijabatan_tahun" id="pegawaijabatan_tahun" />
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tahun</div>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <input type="text" onkeyup="angka(this);" maxlength="2" class="form-control" name="pegawaijabatan_bulan" id="pegawaijabatan_bulan" />
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Bulan</div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->


                                        <!-- <div class="form-group">
                                            <label>Gaji Pokok</label>
                                            <input type="number" class="form-control" name="pegawaijabatan_gaji" id="pegawaijabatan_gaji" />
                                        </div> -->
                                        <div class="form-group" id="form-pegawaijabatan_angka_kredit">
                                            <label>Angka Kredit</label>
                                            <input type="text" onkeyup="angka(this);" class="form-control" name="pegawaijabatan_angka_kredit" id="pegawaijabatan_angka_kredit" />
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
                                        <th>Jabatan</th>
                                        <th>Eselon</th>
                                        <th>SK</th>
                                        <th>Kelas Jabatan</th>
<!--                                         <th>Pangkat Golru</th> -->
                                        <th>OPD/Unit Kerja</th>
                                        <th>Sub Unit</th>
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
                                            <td><?= $value->pegawaijabatan_jabatan_nama . ' <br/> TMT. ' . tgl_indo($value->pegawaijabatan_tmt) ?></td>
                                            <td><?= $value->pegawaijabatan_eselon_nama ?></td>
                                            <td><?= 'No.' . $value->pegawaijabatan_sk_no . '<br/> Tgl. ' . tgl_indo($value->pegawaijabatan_sk_tanggal) . '<br/> Pejabat. ' . $value->pegawaijabatan_pejabat ?></td>
                                            <!-- <td><?= $value->pegawaijabatan_tahun . ' th ' . $value->pegawaijabatan_bulan . ' bln' ?></td> -->
                                            <td><?= $value->pegawaijabatan_kelas_nama ?></td>
                                            <td><?= $value->pegawaijabatan_unit_kerja_nama ?></td>
                                            <td><?= $value->pegawaijabatan_sub_unit_nama ?></td>
                                            <td style="min-width: 75px">
                                                <a href="#formadd" onclick="edit('<?= $value->pegawaijabatan_id ?>');" class="btn btn-warning btn-sm" type="button"><i class="fa fa-edit"></i></a>
                                                <a href="<?= site_url('pegawai/PegawaiRiwayatJabatan/delete/' . $value->pegawaijabatan_id) ?>" onclick="return confirm('Apakah anda yakin menghapus riwayat jabatan.?');" class="btn btn-danger btn-sm" type="button"><i class="fa fa-trash-o"></i></a>
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
    $(document).ready(
        function() {

            //Date picker
            $('.date').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });
        
                    // load kedudukan jabatan
                    // $.ajax({
                    //     url: '<?= site_url('referensi/ReferensiJson/listSubUnitByUnit/') ?>',
                    //     type: "POST",
                    //     data: {
                    //         ajax: '1',
                    //         id: $('#pegawaijabatan_unit_kerja_id').val()
                    //     },
                    //     dataType: "html",
                    //     success: function(data) {
                    //         //                                        alert(data.id);
                    //         $('#pegawaijabatan_sub_unit_id').html(data);
                    //         //$('#jenis_kedudukan_nama').val(data.nama);
                    //     }
                    // });

            $.ajax({
                url: '<?= site_url('referensi/ReferensiJson/listJabatanByKedudukanId/') ?>',
                type: "POST",
                data: {
                    ajax: '1',
                    id: $("#jenis_jabatan").val(),
                        	unit_id : $('#pegawaijabatan_unit_kerja_id').val()
                },
                dataType: "html",
                success: function(data) {
                    //                                        alert(data.id);
                    $('#jabatan').html(data);
                    //$('#jenis_kedudukan_nama').val(data.nama);
                }
            });
            var jabatan = $('#jenis_jabatan').val();

            if (jabatan == '1') {
                // $('#form-jabatan-baru').hide();
                $('#form-pegawaijabatan_tgl_pelantikan').show();
                $('#form-pegawaijabatan_angka_kredit').hide();
            }
            if (jabatan == '2') {
                // $('#form-jabatan-baru').hide();
                $('#form-pegawaijabatan_tgl_pelantikan').hide();
                $('#form-pegawaijabatan_angka_kredit').show();
            }
            if (jabatan == '4') {
                // $('#form-jabatan-baru').show();
                $('#form-pegawaijabatan_tgl_pelantikan').hide();
                $('#form-pegawaijabatan_angka_kredit').hide();
            }
            if (jabatan == '3') {
                // $('#form-jabatan-baru').hide();
            }
        
        $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listSubUnitByUnit/') ?>',
                        type: "POST",
                        data: {
                            ajax: '1',
                            id: $('#pegawaijabatan_unit_kerja_id').val()
                        },
                        dataType: "html",
                        success: function(data) {
                            //                                        alert(data.id);
                            $('#pegawaijabatan_sub_unit_id').html(data);
                            //$('#jenis_kedudukan_nama').val(data.nama);
                        }
                    });

        
        $('#pegawaijabatan_unit_kerja_id').change(
                function() {
                    var unit = $(this).val();
                    // load kedudukan jabatan
                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listSubUnitByUnit/') ?>',
                        type: "POST",
                        data: {
                            ajax: '1',
                            id: unit,
                        	select: '<?= $pegawai->pegawai_sub_unit_id ?>'
                        },
                        dataType: "html",
                        success: function(data) {
                            //                                        alert(data.id);
                            $('#pegawaijabatan_sub_unit_id').html(data);
                            //$('#jenis_kedudukan_nama').val(data.nama);
                        }
                    });
                $.ajax({
                    url: '<?= site_url('referensi/ReferensiJson/listJabatanByKedudukanId/') ?>',
                    type: "POST",
                    data: {
                        ajax: '1',
                        id:  $('#jenis_jabatan').val(),
                        	unit_id : $('#pegawaijabatan_unit_kerja_id').val()
                    },
                    dataType: "html",
                    success: function(data) {
                        $('#jabatan').html(data);
                        $('#jabatan').val(pegawaijabatan_jabatan_id).change();
                    }
                });
                });


            $('#jenis_jabatan').change(
                function() {
                    var jabatan = $(this).val();
                    // load kedudukan jabatan
                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listJabatanByKedudukanId/') ?>',
                        type: "POST",
                        data: {
                            ajax: '1',
                            id: jabatan,
                        	unit_id : $('#pegawaijabatan_unit_kerja_id').val()
                        },
                        dataType: "html",
                        success: function(data) {
                            //                                        alert(data.id);
                            $('#jabatan').html(data);
                            //$('#jenis_kedudukan_nama').val(data.nama);
                        }
                    });

                    if (jabatan == '1') {
                        // $('#form-jabatan-baru').hide();
                        $('#form-pegawaijabatan_tgl_pelantikan').show();
                        $('#form-pegawaijabatan_angka_kredit').hide();
                    }
                    if (jabatan == '2') {
                        // $('#form-jabatan-baru').hide();
                        $('#form-pegawaijabatan_tgl_pelantikan').hide();
                        $('#form-pegawaijabatan_angka_kredit').show();
                    }
                    if (jabatan == '4') {
                        // $('#form-jabatan-baru').show();
                        $('#form-pegawaijabatan_tgl_pelantikan').hide();
                        $('#form-pegawaijabatan_angka_kredit').hide();
                    }
                    if (jabatan == '3') {
                        // $('#form-jabatan-baru').hide();
                    }


                }
            );
        }

    );

    $('#pegawaijabatan_tahun').keyup(function(e) {
        var target = e.srcElement || e.target;
        var maxLength = parseInt(target.attributes["maxlength"].value, 10);
        var myLength = target.value.length;
        // alert(myLength);
        // return false;
        if (myLength >= maxLength) {
            var next = $('#pegawaijabatan_bulan');
            next.focus();
        }
    });

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
                console.log(data)

                // pegawaijabatan_sk_tanggal = d_m_y(data.pegawaijabatan_sk_tanggal);
                // pegawaijabatan_tgl_pelantikan = d_m_y(data.pegawaijabatan_tgl_pelantikan);
                // pegawaijabatan_tmt = d_m_y(data.pegawaijabatan_tmt);
                // return false;
                $('#pegawaijabatan_id').val(data.pegawaijabatan_id);
                $('#pegawaijabatan_pangkat_id').val(data.pegawaijabatan_pangkat_id).change();
                $('#pegawaijabatan_kenaikan_id').val(data.pegawaijabatan_kenaikan_id).change();
                $('#pegawaijabatan_tmt').datetextentry('set_date', data.pegawaijabatan_tmt);
                $('#pegawaijabatan_sk_tanggal').datetextentry('set_date', data.pegawaijabatan_sk_tanggal);
                $('#pegawaijabatan_sk_no').val(data.pegawaijabatan_sk_no);
                $('#pegawaijabatan_pejabat').val(data.pegawaijabatan_pejabat).change();
                $('#pegawaijabatan_tgl_pelantikan').datetextentry('set_date', data.pegawaijabatan_tgl_pelantikan);
                $('#pegawaijabatan_angka_kredit').val(data.pegawaijabatan_angka_kredit);
                $('#pegawaijabatan_tahun').val(data.pegawaijabatan_tahun);
                $('#pegawaijabatan_bulan').val(data.pegawaijabatan_bulan);
                $('#pegawaijabatan_gaji').val(data.pegawaijabatan_gaji);
                $('#pegawaijabatan_unit_kerja_id').val(data.pegawaijabatan_unit_kerja_id).change();
                $('#pegawaijabatan_sub_unit_id').val(data.pegawaijabatan_sub_unit_id).change();
                $('#jenis_jabatan').val(data.pegawaijabatan_jenisjabatan_id);
                $('#pegawai_jabatan_nama').val(data.pegawaijabatan_jabatan_nama);

                var pegawaijabatan_jabatan_id = data.pegawaijabatan_jabatan_id;
                var jabatan = $('#jenis_jabatan').val();
                $.ajax({
                    url: '<?= site_url('referensi/ReferensiJson/listJabatanByKedudukanId/') ?>',
                    type: "POST",
                    data: {
                        ajax: '1',
                        id: jabatan,
                        	unit_id : $('#pegawaijabatan_unit_kerja_id').val()
                    },
                    dataType: "html",
                    success: function(data) {
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

    // var dates = document.getElementById('pegawaijabatan_sk_tanggal');

    // function checkValue(str, max) {
    //     if (str.charAt(0) !== '0' || str == '00') {
    //         var num = parseInt(str);
    //         if (isNaN(num) || num <= 0 || num > max) num = 1;
    //         str = num > parseInt(max.toString().charAt(0)) &&
    //             num.toString().length == 1 ? '0' + num : num.toString();
    //     };
    //     return str;
    // };

    // dates.addEventListener('input', function(e) {
    //     this.type = 'text';
    //     var input = this.value;
    //     if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
    //     var values = input.split('/').map(function(v) {
    //         return v.replace(/\D/g, '')
    //     });
    //     if (values[0]) values[0] = checkValue(values[0], 12);
    //     if (values[1]) values[1] = checkValue(values[1], 31);
    //     var output = values.map(function(v, i) {
    //         return v.length == 2 && i < 2 ? v + '/' : v;
    //     });
    //     this.value = output.join('').substr(0, 14);
    // });


    // var delay = (function() {
    //     var timer = 0;
    //     return function(callback, ms) {
    //         clearTimeout(timer);
    //         timer = setTimeout(callback, ms);
    //     };
    // })();

    // // $('input').keyup(function() {
    // //     delay(function() {
    // //         alert('Hi, func called');
    // //     }, 1000);
    // // });

    // $('#pegawaijabatan_sk_tanggal').on('input', function() {

    //     var reg = /(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d/;
    //     if ($(this).val().match(reg)) {
    //         delay(function() {
    //             alert("Input matched");
    //         }, 1000);

    //     } else {
    //         delay(function() {
    //             $(this).val('');
    //             alert("Please enter dd/mm/yyyy");
    //         }, 1000);
    //     }
    // })


    function d_m_y(date) {
        if (date != null) {
            var from = date.split("-");
            return from[2] + "/" + from[1] + "/" + from[0];
        } else {
            return date;
        }
    }
</script>