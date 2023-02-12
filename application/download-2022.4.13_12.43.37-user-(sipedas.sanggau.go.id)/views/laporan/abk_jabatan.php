<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">

    <link rel="stylesheet" href="<?= base_url('assets/plugins/abkchart') ?>/style.css">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Peta Jabatan
        </h1>
    </section>


    <section class="content">

        <div class="row" id="panel_filter">
            <div class="col-md-12">
                <div class="box">

                    <div class="box-body ">

                        <form id="formadd" role="form" action="#" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <b> FILTER</b>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label>Unit Kerja</label>
                                                <select class="form-control select2custom" id="pegawai_unit_id" name="pegawai_unit_id">
                                                    <!--                                                     <option value="">-- PILIH --</option> -->
                                                    <?php
                                                    foreach ($unit->result() as $value) {
                                                        $bold = '0~' . $value->unit_nama;
                                                        if (empty($value->unit_parent_id)) {
                                                            $bold = '1~' . $value->unit_nama;
                                                        }


                                                    ?>

                                                        <option <?= (isset($where['pegawai_unit_id'])) ? selected($value->unit_id, $where['pegawai_unit_id']) : ''; ?> value="<?= $value->unit_id ?>"><?= $bold ?></option>';
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="input-group-addon">
                                                <button type="button" class="btn btn-success" id="setting">Setting</button>
                                                <button type="button" class="btn btn-success" id="bagan">Tampilkan</button>
                                            </div>
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>

                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

        </div>

        <?php if ($jenis == 'setting') { ?>
            <div class="row" id="riwayat">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users fa-fw"></i> Bagan Struktur
                        </div>
                        <div class="panel-body">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i> Tambah</a>
                            <!--                             <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</button>
                            <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button> -->
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="mytable">
                                    <thead>
                                        <th>No</th>
                                        <th width="100px">Jabatan</th>
                                        <th width="150px">Jabatan Parent</th>
                                        <th width="150px">Unit Kerja</th>
                                        <th width="150px">Level Bagan</th>
                                        <th width="150px">Kebutuhan</th>
                                        <th width="150px">Bezzeting</th>
                                        <th>Aksi</th>
                                    </thead>

                                </table>
                            </div>


                        </div>
                        <!-- /.panel-body -->
                    </div>

                </div>
            </div>

            <div class="modal fade" id="modal-add">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form role="form" action="<?= site_url('laporan/AbkJabatan/add') ?>" id="form-bagan-add" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Bagan</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="abkjabatan_unit_id" id="abkjabatan_unit_id" value="<?= $unit_id ?>">
                                <div class="form-group">
                                    <img src="<?= base_url('assets/images/example.JPG') ?>" alt="">    
                                </div>
                                <div class="form-group">
                                    <label>Bagan Level</label>
                                    <select class="form-control select2" style="width: 100%" name="abkjabatan_level" id="abkjabatan_level" required="true">
                                        <option value="0">--Pilih Level--</option>
                                        <?php
                                        for ($l = 1; $l <= 7; $l++) {
                                        ?>
                                            <option value="<?= $l ?>">Level <?= $l ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group" id="div-assistant">
                                    <label>Bagan Assistant</label> <br>
                                    <label>
                                        <input type="radio" value="0" id="radio1" checked name="abkjabatan_is_assistant" autocomplete="off"> OFF
                                    </label>
                                    <label>
                                        <input type="radio" value="1" id="radio2" name="abkjabatan_is_assistant" autocomplete="off"> ON
                                    </label>
                                </div>
                                <div class="form-group" id="div-parent">
                                    <label>Bagan Parent</label>
                                    <select class="form-control select2" style="width: 100%" name="abkjabatan_parent_id" id="abkjabatan_parent_id">
                                        <option value="0">--Pilih Parent--</option>
                                        <?php
                                        foreach ($bagan->result() as $value) {
                                        ?>
                                            <option value="<?= $value->abkjabatan_id ?>"><?= $value->jabatan_nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Jabatan</label>
                                    <select class="form-control select2" style="width: 100%" name="abkjabatan_jenis_jabatan_id" id="abkjabatan_jenis_jabatan_id">
                                        <option value="">--Pilih Jenis Jabatan--</option>
                                        <option value="1">Struktural</option>
                                        <option value="2">Fungsional Khusus</option>
                                        <option value="4">Fungsional Umum</option>
                                    </select>
                                </div>
                                <div class="form-group" id="div-struktural">
                                    <label>Jabatan</label>
                                    <select class="form-control select2" style="width: 100%" name="abkjabatan_jabatan_id" id="abkjabatan_jabatan_id">
                                        <option value="">--Pilih Jabatan--</option>
                                        <?php
                                        foreach ($jabatan->result() as $value) {
                                        ?>
                                            <option value="<?= $value->jabatan_id ?>"><?= $value->jabatan_nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group" id="div-fungsional" style="display: none;">
                                    <label>Jabatan</label>
                                    <select class="form-control select2" style="width: 100%" name="abkjabatan_jabatan_id_fungsional" id="abkjabatan_jabatan_id_fungsional">
                                        <option value="">--Pilih Jabatan--</option>
                                        <?php
                                        foreach ($fungsional->result() as $value) {
                                        ?>
                                            <option value="<?= $value->jabatan_id ?>"><?= $value->jabatan_nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group" id="div-khusus" style="display: none;">
                                    <label>Jabatan</label>
                                    <select class="form-control select2" style="width: 100%" name="abkjabatan_jabatan_id_fungsional_khusus" id="abkjabatan_jabatan_id_fungsional_khusus">
                                        <option value="">--Pilih Jabatan--</option>
                                        <?php
                                        foreach ($khusus->result() as $value) {
                                        ?>
                                            <option value="<?= $value->jabatan_id ?>"><?= $value->jabatan_nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kebutuhan</label>
                                    <input type="text" class="form-control" onkeyup="angka(this);" name="abkjabatan_kebutuhan" id="abkjabatan_kebutuhan">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="button" id="simpan" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="modal fade" id="modal-edit">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form role="form" id="form-bagan-edit" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Bagan</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="abkjabatan_unit_id" id="edit_abkjabatan_unit_id" value="<?= $unit_id ?>">
                                <input type="hidden" name="abkjabatan_id" id="edit_abkjabatan_id" value="">
                                <!-- <div class="form-group">
                                    <label>Parent</label>
                                    <input type="radio" value="1" id="edit_radio1" checked name="abkjabatan_is_parent" autocomplete="off"> Ya
                                    <input type="radio" value="0" id="edit_radio2" name="abkjabatan_is_parent" autocomplete="off"> Tidak
                                </div> -->
                                <div class="form-group">
                                    <img src="<?= base_url('assets/images/example.JPG') ?>" alt="">    
                                </div>
                                <div class="form-group">
                                    <label>Bagan Level</label>
                                    <select class="form-control select2" style="width: 100%" name="abkjabatan_level" id="edit_abkjabatan_level" required="true">
                                        <option value="0">--Pilih Level--</option>
                                        <?php
                                        for ($l = 0; $l <= 7; $l++) {
                                        ?>
                                            <option value="<?= $l ?>">Level <?= $l ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group" id="edit_div-assistant">
                                    <label>Bagan Assistant</label> <br>
                                    <label>
                                        <input type="radio" value="0" id="edit_radio1" checked name="abkjabatan_is_assistant" autocomplete="off"> OFF
                                    </label>
                                    <label>
                                        <input type="radio" value="1" id="edit_radio2" name="abkjabatan_is_assistant" autocomplete="off"> ON
                                    </label>
                                </div>
                                <div class="form-group" id="edit_div-parent" style="display: none;">
                                    <label>Bagan Parent</label>
                                    <select class="form-control select2" style="width: 100%" name="abkjabatan_parent_id" id="edit_abkjabatan_parent_id">
                                        <option value="0">--Pilih Parent--</option>
                                        <?php
                                        foreach ($bagan->result() as $value) {
                                        ?>
                                        <option value="<?= $value->abkjabatan_id ?>"><?= $value->jabatan_nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Jabatan</label>
                                    <select class="form-control select2" style="width: 100%" name="abkjabatan_jenis_jabatan_id" id="edit_abkjabatan_jenis_jabatan_id">
                                        <option value="">--Pilih Jenis Jabatan--</option>
                                        <option value="1">Struktural</option>
                                        <option value="4">Fungsional Umum</option>
                                        <option value="2">Fungsional Khusus</option>
                                    </select>
                                </div>
                                <div class="form-group" id="edit_div-struktural">
                                    <label>Jabatan</label>
                                    <select class="form-control select2" style="width: 100%" name="abkjabatan_jabatan_id" id="edit_abkjabatan_jabatan_id">
                                        <option value="">--Pilih Jabatan--</option>
                                        <?php
                                        foreach ($jabatan->result() as $value) {
                                        ?>
                                            <option value="<?= $value->jabatan_id ?>"><?= $value->jabatan_nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="form-group" id="edit_div-fungsional">
                                    <label>Jabatan</label>
                                    <select class="form-control select2" style="width: 100%" name="abkjabatan_jabatan_id_fungsional" id="edit_abkjabatan_jabatan_id_fungsional">
                                        <option value="">--Pilih Jabatan--</option>
                                        <?php
                                        foreach ($fungsional->result() as $value) {
                                        ?>
                                            <option value="<?= $value->jabatan_id ?>"><?= $value->jabatan_nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group" id="edit_div-khusus" style="display: none;">
                                    <label>Jabatan</label>
                                    <select class="form-control select2" style="width: 100%" name="abkjabatan_jabatan_id_fungsional_khusus" id="edit_abkjabatan_jabatan_id_fungsional_khusus">
                                        <option value="">--Pilih Jabatan--</option>
                                        <?php
                                        foreach ($khusus->result() as $value) {
                                        ?>
                                            <option value="<?= $value->jabatan_id ?>"><?= $value->jabatan_nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kebutuhan</label>
                                    <input type="text" class="form-control" onkeyup="angka(this);" name="abkjabatan_kebutuhan" id="edit_abkjabatan_kebutuhan">
                                </div>
                                <div class="form-group">
                                    <label>Bezzeting</label>
                                    <input type="text" class="form-control" onkeyup="angka(this);" name="abkjabatan_bezzeting" id="edit_abkjabatan_bezzeting">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="button" id="simpanedit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <script>
                var table;
                var dataId;



                $('#edit_abkjabatan_jabatan_id').change(
                    function() {
                        $.ajax({
                            url: '<?= site_url('referensi/ReferensiJson/listPegawaiByJabatan') ?>' + '/' + $('#edit_abkjabatan_jabatan_id').val(),
                            type: "POST",
                            data: {
                                ajax: '1'
                            },
                            dataType: "html",
                            success: function(data) {
                                $('#edit_abkjabatan_pegawai_nip').html(data);
                            }
                        });
                    }
                );

                function edit(abkjabatan_id, abkjabatan_parent_id, abkjabatan_unit_id, abkjabatan_jabatan_id, abkjabatan_level, abkjabatan_kebutuhan, abkjabatan_bezzeting, abkjabatan_jenis_jabatan_id) {
                    $('#edit_abkjabatan_id').val(abkjabatan_id);
                    $('#edit_abkjabatan_parent_id').val(abkjabatan_parent_id).change();
                    $('#edit_abkjabatan_level').val(abkjabatan_level).change();
                    $('#edit_abkjabatan_unit_id').val(abkjabatan_unit_id);
                    $('#edit_abkjabatan_jabatan_id').val(abkjabatan_jabatan_id).change();
                    $('#edit_abkjabatan_jabatan_id_fungsional').val(abkjabatan_jabatan_id).change();
                    $('#edit_abkjabatan_jenis_jabatan_id').val(abkjabatan_jenis_jabatan_id).change();
                    $('#edit_abkjabatan_jabatan_id_fungsional_khusus').val(abkjabatan_jabatan_id).change();
                    $('#edit_abkjabatan_kebutuhan').val(abkjabatan_kebutuhan);
                    $('#edit_abkjabatan_bezzeting').val(abkjabatan_bezzeting);
                    
                    if (abkjabatan_jenis_jabatan_id == '1') {
                            $('#edit_div-struktural').show();
                            $('#edit_div-fungsional').hide();
                            $('#edit_div-khusus').hide();
                        } else if (abkjabatan_jenis_jabatan_id == '4') {
                            $('#edit_div-struktural').hide();
                            $('#edit_div-khusus').hide();
                            $('#edit_div-fungsional').show();
                        }else  {
                            $('#edit_div-struktural').hide();
                            $('#edit_div-khusus').show();
                            $('#edit_div-fungsional').hide();
                        }

                    if (abkjabatan_level == '1') {
                        // $("#edit_radio1").attr('checked', 'checked');
                        $('#edit_div-parent').hide();
                        $('#edit_div-assistant').show();
                    } else {
                        // $("#edit_radio2").attr('checked', 'checked');
                        $('#edit_div-parent').show();
                        $('#edit_div-assistant').hide();
                    }
                }


                function delete_bagan(abkjabatan_id) {
                    var table = $("#mytable").DataTable();

                    var result = confirm("Hapus data?");
                    if (result) {

                        $.ajax({
                            type: "POST",
                            url: "<?= site_url('laporan/AbkJabatan/delete/') ?>" + '/' + abkjabatan_id,
                            data: {
                                ajax: '1'
                            },
                            dataType: "html",
                            success: function(result) {
                                // alert(result.success);
                                // return false;
                                table.ajax.reload();
                                // if (result.success == true) {
                                // alert(result.success);
                                //     table.ajax.reload();
                                // } else if (result.success == false) {
                                //     swal({
                                //         title: '',
                                //         text: result.message,
                                //         type: 'error',
                                //         showCancelButton: false,
                                //         confirmButtonText: 'Tutup',
                                //     })
                                // }
                            }
                        });
                    }
                }

                $('#abkjabatan_jenis_jabatan_id').change(
                    function() {
                        if ($(this).val() == '1') {
                            $('#div-struktural').show();
                            $('#div-fungsional').hide();
                            $('#div-khusus').hide();
                        } else if ($(this).val() == '4') {
                            $('#div-struktural').hide();
                            $('#div-fungsional').show();
                            $('#div-khusus').hide();
                        }else  {
                            $('#div-struktural').hide();
                            $('#div-khusus').show();
                            $('#div-fungsional').hide();
                        }
                    }
                );

                
                $('#edit_abkjabatan_jenis_jabatan_id').change(
                    function() {
                        if ($(this).val() == '1') {
                            $('#edit_div-struktural').show();
                            $('#edit_div-fungsional').hide();
                            $('#edit_div-khusus').hide();
                        } else if ($(this).val() == '4') {
                            $('#edit_div-struktural').hide();
                            $('#edit_div-khusus').hide();
                            $('#edit_div-fungsional').show();
                        }else  {
                            $('#edit_div-struktural').hide();
                            $('#edit_div-khusus').show();
                            $('#edit_div-fungsional').hide();
                        }
                    }
                );


                $('#abkjabatan_level').change(function() {
                    if ($(this).val() != '1') {
                        $('#div-parent').show();
                        $('#div-assistant').hide();
                    } else {
                        $('#div-parent').hide();
                        $('#div-assistant').show();
                    }
                })

                $('#edit_abkjabatan_level').change(function() {
                    if ($(this).val() != '1') {
                        $('#edit_div-parent').show();
                        $('#edit_div-assistant').hide();
                    } else {
                        $('#edit_div-parent').hide();
                        $('#edit_div-assistant').show();
                    }
                })

                $(document).ready(function() {

                    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
                        return {
                            "iStart": oSettings._iDisplayStart,
                            "iEnd": oSettings.fnDisplayEnd(),
                            "iLength": oSettings._iDisplayLength,
                            "iTotal": oSettings.fnRecordsTotal(),
                            "iFilteredTotal": oSettings.fnRecordsDisplay(),
                            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                        };
                    };

                    var table = $("#mytable").dataTable({
                        initComplete: function() {
                            var api = this.api();
                            $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                                    }
                                });
                        },
                        // scrollX: true,
                        // select: true,
                        oLanguage: {
                            sProcessing: "loading..."
                        },
                        processing: true,
                        serverSide: true,
                        ajax: {
                            "url": "<?= site_url('laporan/AbkJabatan/index/json') ?>",
                            "type": "POST",
                            "data": function(data) {
                                data.abkjabatan_unit_id = $('#pegawai_unit_id').val();
                            }
                        },
                        columns: [{
                                "data": "abkjabatan_id",
                                "orderable": false,
                            }, {
                                "data": "jabatan_nama"
                            }, {
                                "data": "jabatan_nama_parent"
                            }, {
                                "data": "unit_nama"
                            }, {
                                "data": "abkjabatan_level"
                            }, {
                                "data": "abkjabatan_kebutuhan"
                            }, {
                                "data": "abkjabatan_bezzeting"
                            }, {
                                "data": "action",
                                "orderable": false,
                                "searchable": false
                            }
                        ],
                        order: [],
                        // rowCallback: function(row, data, iDisplayIndex) {
                        //     var info = this.fnPagingInfo();
                        //     var page = info.iPage;
                        //     var length = info.iLength;
                        //     var index = page * length + (iDisplayIndex + 1);
                        //     $('td:eq(0)', row).html(index);
                        // },
                        select: {
                            style: 'single'
                        },
                        // autoFill: false,
                        // autoWidth: false,
                        // colReorder: true,
                        // keys: true,
                        // rowReorder: true,
                        // dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',

                        buttons: [
                            /*{
                text: '<span><i class="fa fa-check"></i> Verifikasi</span>',
                className: 'btn-sm btn-success',
                attr: {
                    id: 'validasi-btn'
                }
            }, {
                text: '<span><i class="fa fa-times"></i> Koreksi</span>',
                className: 'btn-sm btn-danger',
                attr: {
                    id: 'koreksi-btn'
                }
            }*/
                        ],
                        'rowCallback': function(row, data, index) {
                            // if (data['CATATAN_KOREKSI'] != null) {
                            //     $(row).find('td:eq(1)').addClass('red');
                            // }
                        },



                    });


                    var table = $("#mytable").DataTable();
                    var oData = table.rows({
                        selected: true
                    }).data();

                    dataId = oData[0];

                    $('#btn-filter').on('click', function() {
                        table.ajax.reload();
                    });

                    $('#btn-reset').on('click', function() {
                        $('#filter-form')[0].reset();
                    });

                    table.on('order.dt search.dt', function() {
                        table.column(0, {
                            search: 'applied',
                            order: 'applied'
                        }).nodes().each(function(cell, i) {
                            cell.innerHTML = i + 1;
                        });
                    }).draw();


                    // $('#mytable tbody').on('dblclick', 'tr', function() {



                    $('#div-parent').hide();


                    $('#simpan').on('click', function() {
                        $.ajax({
                            type: "POST",
                            url: "<?= site_url('laporan/AbkJabatan/add') ?>",
                            dataType: "JSON",
                            data: $('#form-bagan-add').serialize(),
                            success: function(result) {
                                // alert(result.success);
                                // return false;
                                if (result.success == true) {
                                    // swal({
                                    //         title: '',
                                    //         text: result.message + '. ' + 'Ingin menambahkan data lagi?',
                                    //         type: 'success',
                                    //         showCancelButton: true,
                                    //         confirmButtonText: 'Ya',
                                    //         cancelButtonText: 'Tidak',
                                    //     },
                                    //     function(isConfirm) {
                                    //         if (isConfirm) {
                                    //             $('#form-bagan-add')[0].reset();
                                    //         } else {
                                    $('#modal-add').modal('hide');
                                    table.ajax.reload();
                                    //     }
                                    // });
                                } else if (result.success == false) {
                                    swal({
                                        title: '',
                                        text: result.message,
                                        type: 'error',
                                        showCancelButton: false,
                                        confirmButtonText: 'Tutup',
                                    })
                                }
                            }
                        });
                        return false;
                    });


                    $('#simpanedit').on('click', function() {
                        $.ajax({
                            type: "POST",
                            url: "<?= site_url('laporan/AbkJabatan/update') ?>",
                            dataType: "JSON",
                            data: $('#form-bagan-edit').serialize(),
                            success: function(result) {
                                // alert(result.success);
                                // return false;
                                if (result.success == true) {
                                    $('#modal-edit').modal('hide');
                                    table.ajax.reload();
                                } else if (result.success == false) {
                                    swal({
                                        title: '',
                                        text: result.message,
                                        type: 'error',
                                        showCancelButton: false,
                                        confirmButtonText: 'Tutup',
                                    })
                                }
                            }
                        });
                        return false;
                    });


                    $('#simpanbupati').on('click', function() {
                        var frm = $('#form-bagan-bupati');
                        var formData = new FormData(frm[0]);
                        $.ajax({
                            type: "POST",
                            url: "<?= site_url('laporan/AbkJabatan/update') ?>",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                // alert(result.success);
                                // return false;
                                if (result.success == true) {
                                    $('#modal-edit').modal('hide');
                                    table.ajax.reload();
                                } else if (result.success == false) {
                                    swal({
                                        title: '',
                                        text: result.message,
                                        type: 'error',
                                        showCancelButton: false,
                                        confirmButtonText: 'Tutup',
                                    })
                                }
                            }
                        });
                        return false;
                    });



                }); // END READY FUNCTION
            </script>
        <?php } ?>


        <?php if ($jenis == 'bagan') { ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="box">

                        <div class="box-header with-border">
                        </div>

                        <div class="box-body table-responsive">
                            <div id="html-content">
                                <figure>
                                    <figcaption>PETA JABATAN <?= $unit_select->unit_nama ?></figcaption>
                                    <div class="orgchart">
                                        <!-- LEVEL 1 -->
                                        <ul class="nodes">
                                            <?php 
                                                $abk   = $bagan;
                                                $is_assistant = $is_assistant->num_rows();
                                                $i      = 0;
                                            ?>
                                            <?php foreach($abk as $level1) : ?>
                                                <?php $i++; ?>
                                                <?php if($level1['abkjabatan_level'] == '1') : ?>
                                                    <!-- CLASS warna sesuai jumlah abk -->
                                                    <?php if($level1['abkjabatan_kebutuhan'] == $level1['abkjabatan_bezzeting']) {
                                                        $class_abk = 'equal';
                                                    }elseif($level1['abkjabatan_kebutuhan'] > $level1['abkjabatan_bezzeting']) {
                                                        $class_abk = 'min';
                                                    }elseif($level1['abkjabatan_kebutuhan'] < $level1['abkjabatan_bezzeting']) {
                                                        $class_abk = 'plus';
                                                    }else{
                                                        $class_abk = '';
                                                    } ?>
                                            <li>
                                                
                                            <?php if($level1['abkjabatan_is_assistant'] == '1' ) { ?>
                                                <assistant>
                                                    <div class="bagan">
                                                            <table width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="title-chart"  colspan="3"><?= $level1['jabatan_nama'] ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3">
                                                                            <table  width="100%" class="border-none">
                                                                                <?php foreach($level1['pegawai'] as $key) : ?>
                                                                                <tr><td><?= $key['nama'];  ?><br><?= $key['nip'];  ?></td></tr>
                                                                                <?php endforeach; ?>
                                                                        </table></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>B= <?= $level1['abkjabatan_bezzeting'] ?></td>
                                                                        <td>K= <?= $level1['abkjabatan_kebutuhan'] ?></td>
                                                                        <td class="<?= $class_abk ?>">KET= <?= $level1['abkjabatan_kebutuhan']-$level1['abkjabatan_bezzeting'] ?></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                    </div>
                                            </assistant>
                                            <?php } else { ?> 
                                                <span>
                                                    <div class="bagan">
                                                            <table width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="title-chart"  colspan="3"><?= $level1['jabatan_nama'] ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3">
                                                                            <table  width="100%" class="border-none">
                                                                                <?php foreach($level1['pegawai'] as $key) : ?>
                                                                                <tr><td><?= $key['nama'];  ?><br><?= $key['nip'];  ?></td></tr>
                                                                                <?php endforeach; ?>
                                                                        </table></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>B= <?= $level1['abkjabatan_bezzeting'] ?></td>
                                                                        <td>K= <?= $level1['abkjabatan_kebutuhan'] ?></td>
                                                                        <td class="<?= $class_abk ?>">KET= <?= $level1['abkjabatan_kebutuhan']-$level1['abkjabatan_bezzeting'] ?></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                    </div>
                                            </span>
                                            <?php } ?> 

                                                <?php if($is_assistant > 0 && $i == 1) : ?>
                                                <ul class="connector">
                                                    <li></li>
                                                </ul>
                                                <?php endif; ?>

                                                <!-- LEVEL 2 -->
                                                <ul class="<?= $is_assistant > 0 && $i == 1 ? 'after-assistant' : ''; ?>">
                                                
                                                <?php foreach($abk as $level2) : ?>

                                                    <?php if($level2['abkjabatan_level'] == '2' && $level1['abkjabatan_id'] == $level2['abkjabatan_parent_id'] ) : ?>
                                                    <!-- CLASS warna sesuai jumlah abk -->
                                                    <?php if($level2['abkjabatan_kebutuhan'] == $level2['abkjabatan_bezzeting']) {
                                                        $class_abk = 'equal';
                                                    }elseif($level2['abkjabatan_kebutuhan'] > $level2['abkjabatan_bezzeting']) {
                                                        $class_abk = 'min';
                                                    }elseif($level2['abkjabatan_kebutuhan'] < $level2['abkjabatan_bezzeting']) {
                                                        $class_abk = 'plus';
                                                    }else{
                                                        $class_abk = '';
                                                    } ?>

                                                    <li>
                                                        <span>
                                                            <div class="bagan">
                                                                    <table width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="title-chart"  colspan="3"><?= $level2['jabatan_nama'] ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="3">
                                                                                    <table  width="100%" class="border-none">
                                                                                        <?php foreach($level2['pegawai'] as $key) : ?>
                                                                                        <tr><td><?= $key['nama'];  ?><br><?= $key['nip'];  ?></td></tr>
                                                                                        <?php endforeach; ?>
                                                                                </table></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>B= <?= $level2['abkjabatan_bezzeting'] ?></td>
                                                                                <td>K= <?= $level2['abkjabatan_kebutuhan'] ?></td>
                                                                                <td class="<?= $class_abk ?>">KET= <?= $level2['abkjabatan_kebutuhan']-$level2['abkjabatan_bezzeting'] ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                            </div>
                                                        </span>
                                                        
                                                        <!-- LEVEL 3 -->
                                                        <ul>
                                                            <?php foreach($abk as $level3) : ?>

                                                            <?php if($level3['abkjabatan_level'] == '3' && ($level2['abkjabatan_id'] == $level3['abkjabatan_parent_id'])) : ?>
                                                            <!-- CLASS warna sesuai jumlah abk -->
                                                            <?php if($level3['abkjabatan_kebutuhan'] == $level3['abkjabatan_bezzeting']) {
                                                                $class_abk = 'equal';
                                                            }elseif($level3['abkjabatan_kebutuhan'] > $level3['abkjabatan_bezzeting']) {
                                                                $class_abk = 'min';
                                                            }elseif($level3['abkjabatan_kebutuhan'] < $level3['abkjabatan_bezzeting']) {
                                                                $class_abk = 'plus';
                                                            }else{
                                                                $class_abk = '';
                                                            } 
                                                            // $table_fungsional3 = array();
                                                            ?>

                                                            <?php if($level3['abkjabatan_jenis_jabatan_id'] != '1') { ?>

                                                            <?php 

                                                            $pegawai = '';
                                                            foreach($level3['pegawai'] as $key) {
                                                                $pegawai .= '<tr><td>'.$key['nama'].'<br>'.$key['nip'].'</td></tr>';
                                                            }
                                                            $ket = $level3['abkjabatan_bezzeting']-$level3['abkjabatan_kebutuhan'];
                                                            $table = '<tr>
                                                                            <td class="title-chart" >'.$level3['jabatan_nama'].'</td>
                                                                            <td rowspan="2">B= '.$level3['abkjabatan_bezzeting'].'</td>
                                                                            <td rowspan="2">K= '.$level3['abkjabatan_kebutuhan'].'</td>
                                                                            <td rowspan="2" class="'.$class_abk.'">KET= '.$ket.'</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <table  width="100%" class="border-none">
                                                                                    '.$pegawai.'
                                                                                </table>
                                                                            </td>
                                                                        </tr>';

                                                            $table_fungsional3[] = array('datatable'=> $table,
                                                                                         'parent_id' => $level3['abkjabatan_parent_id']); ?>
                                                            
                                                            <?php } else { ?>
                                                            <li>
                                                                <span>
                                                                    <div class="bagan">
                                                                            <table width="100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="title-chart"  colspan="3"><?= $level3['jabatan_nama'] ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="3">
                                                                                            <table  width="100%" class="border-none">
                                                                                                <?php foreach($level3['pegawai'] as $key) : ?>
                                                                                                <tr><td><?= $key['nama'];  ?><br><?= $key['nip'];  ?></td></tr>
                                                                                                <?php endforeach; ?>
                                                                                        </table></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>B= <?= $level3['abkjabatan_bezzeting'] ?></td>
                                                                                        <td>K= <?= $level3['abkjabatan_kebutuhan'] ?></td>
                                                                                        <td class="<?= $class_abk ?>">KET= <?= $level3['abkjabatan_kebutuhan']-$level3['abkjabatan_bezzeting'] ?></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                    </div>
                                                                </span>

                                                                <!-- LEVEL 4 -->
                                                        <ul>
                                                            <?php foreach($abk as $level4) : ?>

                                                            <?php if($level4['abkjabatan_level'] == '4' && ($level3['abkjabatan_id'] == $level4['abkjabatan_parent_id'])) : ?>
                                                            <!-- CLASS warna sesuai jumlah abk -->
                                                            <?php if($level4['abkjabatan_kebutuhan'] == $level4['abkjabatan_bezzeting']) {
                                                                $class_abk = 'equal';
                                                            }elseif($level4['abkjabatan_kebutuhan'] > $level4['abkjabatan_bezzeting']) {
                                                                $class_abk = 'min';
                                                            }elseif($level4['abkjabatan_kebutuhan'] < $level4['abkjabatan_bezzeting']) {
                                                                $class_abk = 'plus';
                                                            }else{
                                                                $class_abk = '';
                                                            } ?>
                                                            
                                                            <?php if($level4['abkjabatan_jenis_jabatan_id'] != '1') { ?>

                                                            <?php 

                                                            $pegawai = '';
                                                            foreach($level4['pegawai'] as $key) {
                                                                $pegawai .= '<tr><td>'.$key['nama'].'<br>'.$key['nip'].'</td></tr>';
                                                            }
                                                            $ket = $level4['abkjabatan_bezzeting']-$level4['abkjabatan_kebutuhan'];
                                                            $table = '<tr>
                                                                            <td class="title-chart" >'.$level4['jabatan_nama'].'</td>
                                                                            <td rowspan="2">B= '.$level4['abkjabatan_bezzeting'].'</td>
                                                                            <td rowspan="2">K= '.$level4['abkjabatan_kebutuhan'].'</td>
                                                                            <td rowspan="2" class="'.$class_abk.'">KET= '.$ket.'</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <table  width="100%" class="border-none">
                                                                                    '.$pegawai.'
                                                                                </table>
                                                                            </td>
                                                                        </tr>';

                                                            $table_fungsional4[] = array('datatable'=> $table,
                                                                                        'parent_id' => $level4['abkjabatan_parent_id']); ?>

                                                            <?php } else { ?>

                                                            <li>
                                                                <span>
                                                                    <div class="bagan">
                                                                            <table width="100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="title-chart"  colspan="3"><?= $level4['jabatan_nama'] ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="3">
                                                                                            <table  width="100%" class="border-none">
                                                                                                <?php foreach($level4['pegawai'] as $key) : ?>
                                                                                                <tr><td><?= $key['nama'];  ?><br><?= $key['nip'];  ?></td></tr>
                                                                                                <?php endforeach; ?>
                                                                                        </table></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>B= <?= $level4['abkjabatan_bezzeting'] ?></td>
                                                                                        <td>K= <?= $level4['abkjabatan_kebutuhan'] ?></td>
                                                                                        <td class="<?= $class_abk ?>">KET= <?= $level4['abkjabatan_kebutuhan']-$level4['abkjabatan_bezzeting'] ?></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                    </div>
                                                                </span>

                                                                <!-- LEVEL 5 -->
                                                        <ul>
                                                            <?php foreach($abk as $level5) : ?>

                                                            <?php if($level5['abkjabatan_level'] == '5' && ($level4['abkjabatan_id'] == $level5['abkjabatan_parent_id'])) : ?>
                                                            <!-- CLASS warna sesuai jumlah abk -->
                                                            <?php if($level5['abkjabatan_kebutuhan'] == $level5['abkjabatan_bezzeting']) {
                                                                $class_abk = 'equal';
                                                            }elseif($level5['abkjabatan_kebutuhan'] > $level5['abkjabatan_bezzeting']) {
                                                                $class_abk = 'min';
                                                            }elseif($level5['abkjabatan_kebutuhan'] < $level5['abkjabatan_bezzeting']) {
                                                                $class_abk = 'plus';
                                                            }else{
                                                                $class_abk = '';
                                                            } ?>

                                                            <!-- TIDAK DIANJURKAN MEMPERBARUI SCRIPT< DIKARENAKAN AKAN MUMET WKWK -->
                                                            
                                                            <?php if($level5['abkjabatan_jenis_jabatan_id'] != '1') { ?>

                                                                <?php 

                                                                $pegawai = '';
                                                                foreach($level5['pegawai'] as $key) {
                                                                    $pegawai .= '<tr><td>'.$key['nama'].'<br>'.$key['nip'].'</td></tr>';
                                                                }
                                                                $ket = $level5['abkjabatan_bezzeting']-$level5['abkjabatan_kebutuhan'];
                                                                $table = '<tr>
                                                                                <td class="title-chart" >'.$level5['jabatan_nama'].'</td>
                                                                                <td rowspan="2">B= '.$level5['abkjabatan_bezzeting'].'</td>
                                                                                <td rowspan="2">K= '.$level5['abkjabatan_kebutuhan'].'</td>
                                                                                <td rowspan="2" class="'.$class_abk.'">KET= '.$ket.'</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table  width="100%" class="border-none">
                                                                                        '.$pegawai.'
                                                                                    </table>
                                                                                </td>
                                                                            </tr>';

                                                                $table_fungsional5[] = array('datatable'=> $table,
                                                                                            'parent_id' => $level5['abkjabatan_parent_id']); ?>

                                                            <?php } else { ?>

                                                            <li>
                                                                <span>
                                                                    <div class="bagan">
                                                                            <table width="100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="title-chart"  colspan="3"><?= $level5['jabatan_nama'] ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="3">
                                                                                            <table  width="100%" class="border-none">
                                                                                                <?php foreach($level5['pegawai'] as $key) : ?>
                                                                                                <tr><td><?= $key['nama'];  ?><br><?= $key['nip'];  ?></td></tr>
                                                                                                <?php endforeach; ?>
                                                                                        </table></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>B= <?= $level5['abkjabatan_bezzeting'] ?></td>
                                                                                        <td>K= <?= $level5['abkjabatan_kebutuhan'] ?></td>
                                                                                        <td class="<?= $class_abk ?>">KET= <?= $level5['abkjabatan_kebutuhan']-$level5['abkjabatan_bezzeting'] ?></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                    </div>
                                                                </span>
                                                                
                                                            </li>

                                                            <?php }  ?>
                                                            <?php endif; ?>
                                                            <?php endforeach; ?>

                                                            <?php if(!empty($table_fungsional5)) : ?>
                                                                <li>
                                                                    <span>
                                                                        <div class="bagan">
                                                                        <table width="100%">
                                                                            <tbody>
                                                                                <?php foreach($table_fungsional5 as $tf5) {
                                                                                    if($tf5['parent_id'] == $level5['abkjabatan_id']) {
                                                                                        echo $tf5['datatable'];
                                                                                    }
                                                                                }   ?>

                                                                                
                                                                            </tbody></table>
                                                                        </div>
                                                                        </div>
                                                                    </span>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                        <!-- END LEVEL 5 -->
                                                                
                                                            </li>

                                                            <?php }  ?>
                                                            <?php endif; ?>
                                                            <?php endforeach; ?>
                                                            

                                                            <?php if(!empty($table_fungsional4)) : ?>
                                                                <li>
                                                                    <span>
                                                                        <div class="bagan">
                                                                        <table width="100%">
                                                                            <tbody>
                                                                                <?php foreach($table_fungsional4 as $tf4) {
                                                                                    if($tf4['parent_id'] == $level3['abkjabatan_id']) {
                                                                                        echo $tf4['datatable'];
                                                                                    }
                                                                                }  ?>
                                                                                
                                                                            </tbody></table>
                                                                        </div>
                                                                    </span>
                                                                </li>
                                                            <?php endif; ?>
                                                            <!-- KALO MAU OPREK ATAU BENERIN BREAKDOWN AJA LEVEL 1 - 3 DULU BIAR PAHAM STRUKTUR CODE NYA -->
                                                        </ul>
                                                        <!-- END LEVEL 4 -->

                                                            </li>

                                                            <?php }  ?>
                                                            <?php endif; ?>
                                                            <?php endforeach; ?>

                                                            <?php if(!empty($table_fungsional3)) : ?>
                                                                <li>
                                                                    <span>
                                                                        <div class="khusus">
                                                                        <table width="100%">
                                                                            <tbody>
                                                                                <?php foreach($table_fungsional3 as $tf3) {
                                                                                    if($tf3['parent_id'] == $level2['abkjabatan_id']) {
                                                                                        echo $tf3['datatable'];
                                                                                    }
                                                                                } ?>
                                                                                
                                                                                
                                                                                
                                                                            </tbody></table>
                                                                        </div>
                                                                    </span>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                        <!-- END LEVEL 3 -->

                                                    </li>
                                                    
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <!-- END LEVEL 2 -->

                                            </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                        <!-- END LEVEL 1 -->
                                    </div>
                                </figure>

                            </div>
<!--                             <a href="javascript:genPDF()">Download PDF</a> -->
                            <button type="butoon" onclick="CreatePDFfromHTML()" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>

                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>

    </section>
</div>

<script>
    $(document).on('click', '#setting', function() { //Cetak BY name
        var form = "<form id='hidden-form' action='<?= site_url('laporan/AbkJabatan/index') ?> ' method='post'>";

        form += "<input type='hidden' name='pegawai_unit_id' value='" + $('#pegawai_unit_id').val() + "'/>";
        form += "<input type='hidden' name='jenis' value='setting'/>";

        $(form + "</form>").appendTo($(document.body)).submit();
    });


    $(document).on('click', '#bagan', function() { //Cetak BY name
        var form = "<form id='hidden-form' action='<?= site_url('laporan/AbkJabatan/index') ?>' method='post'>";

        form += "<input type='hidden' name='pegawai_unit_id' value='" + $('#pegawai_unit_id').val() + "'/>";
        form += "<input type='hidden' name='jenis' value='bagan'/>";

        $(form + "</form>").appendTo($(document.body)).submit();
    });
</script>

<script src="<?= base_url('assets/dist/js/jspdf.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/domtoimage.js') ?>"></script>

<!-- <link rel="stylesheet" href="./orgjs.css"> -->
<script type="text/javascript" src="<?= base_url('assets/plugins/abkchart') ?>/jspdf.js"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/abkchart') ?>/html2canvas.js"></script>

<script>
    function genPDF() {
        var printContents = document.getElementById('html-content').innerHTML;
        //  var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        //  document.body.innerHTML = originalContents;

    }
    //Create PDf from HTML...
    function CreatePDFfromHTML() {
        var HTML_Width = $("#html-content").width();
        var HTML_Height = $("#html-content").height();
        var top_left_margin = 15;
        var PDF_Width = HTML_Width + (top_left_margin * 2);
        var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;

        var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
// console.log(PDF_Height,PDF_Width);
// console.log(document.getElementById('html-content').getBoundingClientRect())
// return false;
        const div = document.getElementById('html-content');
        const options = {
            background: 'white',
            // height: PDF_Height,
            // width: PDF_Width
            // height: 3354,
            // width: 1748
            height: 3354,
            width: 1848
        };
        domtoimage.toPng(div, options).then((dataUrl) => {
            //Initialize JSPDF
            const doc = new jsPDF('p', 'mm', 'a3');
            //Add image Url to PDF
            doc.addImage(dataUrl, 'PNG', 10, 10, 297, 420);
            // doc.addImage(dataUrl, 'PNG', 10, 10, 210, 340);
            doc.save('pdfDocument.pdf');
        });

        // var pdf = new jsPDF('p', 'pt', 'letter');
        // pdf.addHTML($('.html-content')[0], function () {
        //   pdf.save('Test.pdf');
        // });
        // html2canvas($("#html-content")[0]).then(function (canvas) {
        // var imgData = canvas.toDataURL("image/jpeg", 1.0);
        // var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        // pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        // for (var i = 1; i <= totalPDFPages; i++) { 
        //     pdf.addPage(PDF_Width, PDF_Height);
        //     pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        // }
        // pdf.save("Your_PDF_Name.pdf");
        // $(".html-content").hide();
        // });
    }

</script>