<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Bagan Struktur
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
                           							 $bold = '0~'.$value->unit_nama;
                            						if(empty($value->unit_parent_id)){
                            						$bold = '1~'.$value->unit_nama;
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
                                        <th>NIP</th>
                                        <th width="150px">Nama</th>
                                        <th width="100px">Jabatan</th>
                                        <th width="150px">Jabatan Parent</th>
                                        <th width="150px">Unit Kerja</th>
                                        <th width="150px">Level Bagan</th>
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
                        <form role="form" action="<?= site_url('laporan/BaganStruktur/add') ?>" id="form-bagan-add" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Bagan</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="bagan_unit_id" id="bagan_unit_id" value="<?= $unit_id ?>">
                                <!-- <div class="form-group">
                                    <label>Parent</label>
                                    <input type="radio" value="1" id="radio1" checked name="bagan_is_parent" autocomplete="off"> Ya
                                    <input type="radio" value="0" id="radio2" name="bagan_is_parent" autocomplete="off"> Tidak
                                </div> -->
                                <div class="form-group">
                                    <label>Bagan Level</label>
                                    <select class="form-control select2" style="width: 100%" name="bagan_level" id="bagan_level" required="true">
                                        <option value="0">--Pilih Level--</option>
                                        <?php
                                        for ($l = 1; $l <= 20; $l++) {
                                        ?>
                                            <option value="<?= $l ?>">Level <?= $l ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group" id="div-parent">
                                    <label>Bagan Parent</label>
                                    <select class="form-control select2" style="width: 100%" name="bagan_parent_id" id="bagan_parent_id">
                                        <option value="0">--Pilih Parent--</option>
                                        <?php
                                        foreach ($bagan->result() as $value) {
                                        ?>
                                            <option value="<?= $value->bagan_id ?>"><?= $value->pegawai_nama ?> / <?= $value->pegawai_jabatan_nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select class="form-control select2" style="width: 100%" name="bagan_jabatan_id" id="bagan_jabatan_id">
                                        <option value="">--Pilih Jabatan--</option>
                                        <?php
                                        foreach ($jabatan->result() as $value) {
                                        ?>
                                            <option value="<?= $value->jabatan_id ?>"><?= $value->jabatan_nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <select class="form-control select2" style="width: 100%" name="bagan_pegawai_nip" id="bagan_pegawai_nip">
                                        <option value="">--Pilih--</option>
                                    </select>
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
                                <input type="hidden" name="bagan_unit_id" id="edit_bagan_unit_id" value="<?= $unit_id ?>">
                                <input type="hidden" name="bagan_id" id="edit_bagan_id" value="">
                                <!-- <div class="form-group">
                                    <label>Parent</label>
                                    <input type="radio" value="1" id="edit_radio1" checked name="bagan_is_parent" autocomplete="off"> Ya
                                    <input type="radio" value="0" id="edit_radio2" name="bagan_is_parent" autocomplete="off"> Tidak
                                </div> -->
                                <div class="form-group">
                                    <label>Bagan Level</label>
                                    <select class="form-control select2" style="width: 100%" name="bagan_level" id="edit_bagan_level" required="true">
                                        <option value="0">--Pilih Level--</option>
                                        <?php
                                        for ($l = 0; $l <= 10; $l++) {
                                        ?>
                                            <option value="<?= $l ?>">Level <?= $l ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group" id="edit_div-parent" style="display: none;">
                                    <label>Bagan Parent</label>
                                    <select class="form-control select2" style="width: 100%" name="bagan_parent_id" id="edit_bagan_parent_id">
                                        <option value="0">--Pilih Parent--</option>
                                        <?php
                                        foreach ($bagan->result() as $value) {
                                        ?>
                                            <option value="<?= $value->bagan_id ?>"><?= $value->pegawai_nama ?> / <?= $value->pegawai_jabatan_nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select class="form-control select2" style="width: 100%" name="bagan_jabatan_id" id="edit_bagan_jabatan_id">
                                        <option value="">--Pilih Jabatan--</option>
                                        <?php
                                        foreach ($jabatan->result() as $value) {
                                        ?>
                                            <option value="<?= $value->jabatan_id ?>"><?= $value->jabatan_nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <select class="form-control select2" style="width: 100%" name="bagan_pegawai_nip" id="edit_bagan_pegawai_nip">
                                        <option value="">--Pilih--</option>
                                    </select>
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
    
    		<div class="modal fade" id="modal-edit-bupati">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form role="form" id="form-bagan-bupati" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Bagan Bupati/Wakil Bupati</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="bagan_unit_id" id="bagan_unit_id_bupati" value="<?= $unit_id ?>">
                                <input type="hidden" name="bagan_id" id="bagan_id_bupati" value="">
                                <!-- <div class="form-group">
                                    <label>Parent</label>
                                    <input type="radio" value="1" id="edit_radio1" checked name="bagan_is_parent" autocomplete="off"> Ya
                                    <input type="radio" value="0" id="edit_radio2" name="bagan_is_parent" autocomplete="off"> Tidak
                                </div> -->

                                <div class="form-group">
                                    <label>Nama Bupati</label>
                                    <input type="text" class="form-control" name="bagan_bupati_nama" id="bagan_bupati_nama">
                                       
                                </div>
                                <div class="form-group">
                                    <label>Foto Bupati</label>
                                	<?php 
                                
                                		
                        $fotobup = 'assets/images/user.jpg';

                        if (file_exists(('assets/images/BUPATI.JPG'))) {
                            $fotobup = 'assets/images/BUPATI.JPG';
                        } else if (file_exists(('assets/images/BUPATI.jpg'))) {
                            $fotobup = 'assets/images/BUPATI.jpg';
                        } else 
                            if (file_exists(('assets/images/BUPATI.jpeg'))) {
                                $fotobup = 'assets/images/BUPATI.jpeg';
                            
                        }
                        
                                
                                	?>
                                	<p>
                                		<img style="height: 100px;" src="<?= base_url($fotobup) ?>" >
                                	</p>
                                    <input type="file" class="form-control" name="bagan_bupati_foto" id="bagan_bupati_foto">
                                       
                                </div>
                                <div class="form-group">
                                    <label>Nama Wakil Bupati</label>
                                    <input type="text" class="form-control" name="bagan_wabupati_nama" id="bagan_wabupati_nama">
                                       
                                </div>
                                <div class="form-group">
                                    <label>Foto Wakil Bupati</label>
                                <?php 
                                
                                		
                        $fotowabup = 'assets/images/user.jpg';

                        if (file_exists(('assets/images/WABUP.JPG'))) {
                            $fotowabup = 'assets/images/WABUP.JPG';
                        } else if (file_exists(('assets/images/WABUP.jpg'))) {
                            $fotowabup = 'assets/images/WABUP.jpg';
                        } else 
                            if (file_exists(('assets/images/WABUP.jpeg'))) {
                                $fotowabup = 'assets/images/WABUP.jpeg';
                            
                        }
                        
                                
                                	?>
                                	<p>
                                		<img style="height: 100px;" src="<?= base_url($fotowabup) ?>" >
                                	</p>
                                    <input type="file" class="form-control" name="bagan_wabupati_foto" id="bagan_wabupati_foto">
                                       
                                </div>
                            </div>
                            <div class="modal-footer">
                            	<input type="hidden" name="bagan_is_bupati" id="bagan_is_bupati" value="1">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="button" id="simpanbupati" class="btn btn-primary">Simpan</button>
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



                $('#edit_bagan_jabatan_id').change(
                    function() {
                        $.ajax({
                            url: '<?= site_url('referensi/ReferensiJson/listPegawaiByJabatan') ?>' + '/' + $('#edit_bagan_jabatan_id').val(),
                            type: "POST",
                            data: {
                                ajax: '1'
                            },
                            dataType: "html",
                            success: function(data) {
                                $('#edit_bagan_pegawai_nip').html(data);
                            }
                        });
                    }
                );

                function edit(bagan_id, bagan_parent_id, bagan_pegawai_nip, bagan_unit_id, bagan_jabatan_id, bagan_level) {
                    $('#edit_bagan_id').val(bagan_id);
                    $('#edit_bagan_parent_id').val(bagan_parent_id).change();
                    $('#edit_bagan_level').val(bagan_level).change();
                    $('#edit_bagan_unit_id').val(bagan_unit_id);
                    $('#edit_bagan_jabatan_id').val(bagan_jabatan_id).change();

                    $.ajax({
                        url: '<?= site_url('referensi/ReferensiJson/listPegawaiByJabatan') ?>' + '/' + $('#edit_bagan_jabatan_id').val(),
                        type: "POST",
                        data: {
                            ajax: '1'
                        },
                        dataType: "html",
                        success: function(data) {
                            $('#edit_bagan_pegawai_nip').html(data);
                            $('#edit_bagan_pegawai_nip').val(bagan_pegawai_nip).change();
                        }
                    });
                    $('#edit_bagan_pegawai_nip').val(bagan_pegawai_nip).change();

                    if (bagan_level == '1') {
                        // $("#edit_radio1").attr('checked', 'checked');
                        $('#edit_div-parent').hide();
                    } else {
                        // $("#edit_radio2").attr('checked', 'checked');
                        $('#edit_div-parent').show();
                    }
                }
            
            
                function edit_bupati(bagan_id, bagan_bupati_nama, bagan_wabupati_nama) {
                    $('#bagan_id_bupati').val(bagan_id);
                    $('#bagan_bupati_nama').val(bagan_bupati_nama);
                    $('#bagan_wabupati_nama').val(bagan_wabupati_nama);
                }
            
            
                function delete_bagan(bagan_id) {
                    var table = $("#mytable").DataTable();
                
                var result = confirm("Hapus data?");
				if (result) {
                
                        $.ajax({
                            type: "POST",
                            url: "<?= site_url('laporan/BaganStruktur/delete/') ?>"+'/'+bagan_id,
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

                $('#bagan_jabatan_id').change(
                    function() {
                        $.ajax({
                            url: '<?= site_url('referensi/ReferensiJson/listPegawaiByJabatan') ?>' + '/' + $('#bagan_jabatan_id').val(),
                            type: "POST",
                            data: {
                                ajax: '1'
                            },
                            dataType: "html",
                            success: function(data) {
                                $('#bagan_pegawai_nip').html(data);
                            }
                        });
                    }
                );


                $('#bagan_level').change(function() {
                    if ($(this).val() != '1') {
                        $('#div-parent').show();
                    } else {
                        $('#div-parent').hide();
                    }
                })

                $('#edit_bagan_level').change(function() {
                    if ($(this).val() != '1') {
                        $('#edit_div-parent').show();
                    } else {
                        $('#edit_div-parent').hide();
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
                            "url": "<?= site_url('laporan/BaganStruktur/index/json') ?>",
                            "type": "POST",
                            "data": function(data) {
                                data.bagan_unit_id = $('#pegawai_unit_id').val();
                            }
                        },
                        columns: [{
                                "data": "bagan_id",
                                "orderable": false,
                            },
                            {
                                "data": "bagan_pegawai_nip"
                            }, {
                                "data": "pegawai_nama"
                            }, {
                                "data": "pegawai_jabatan_nama"
                            }, {
                                "data": "jabatan_nama"
                            }, {
                                "data": "pegawai_unit_nama"
                            }, {
                                "data": "bagan_level"
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
                            url: "<?= site_url('laporan/BaganStruktur/add') ?>",
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
                            url: "<?= site_url('laporan/BaganStruktur/update') ?>",
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
                            url: "<?= site_url('laporan/BaganStruktur/update') ?>",
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

<!--                     <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div> -->

                    <div class="box-body table-responsive">

                    <script src="https://balkan.app/js/OrgChart.js"></script>

                        <style id="myStyles">
                            /* [control-export-menu] {
                                top: 300px;
                            } */

                            #legend1 {
                                position: absolute;
                                width: 490px;
                                margin-bottom: 20px;
                                top: 10px;
                                left: 50px;
                                color: #757575;
                                z-index: 1;
                                font-size: 10px;
                            }

                            #legend2 {
                                position: absolute;
                                margin-bottom: 20px;
                                top: 10px;
                                right: 50px;
                                color: #757575;
                                z-index: 1;
                                font-size: 10px;
                            }

                            .box-perda {
                                /* width: 100px; */
                                border-radius: 2px;
                                position: relative;
                                display: block;
                                margin-bottom: 20px;
                                box-shadow: 1px 1px 1px rgb(0 0 0 / 10%);
                                /* background-color: #caccc9; */
                                padding: 10px;
                            }

                            .table-bordered-pdf,
                            .td,
                            .th {
                                border: 1px solid #ddd;
                                border-collapse: collapse;
                                border-spacing: 0;
                            }

                            .table-pdf {
                                display: table;
                                width: 100%;
                                max-width: 100%;
                            }

                            .table-bordered-pdf td {
                                padding: 10px;
                            }
                        </style>

                        <table class="table table-bordered" width="100%">
                            <tr align="center">
                                <td>PEMERINTAH KABUPATEN SANGGAU <br>
                                    BAGAN SUSUNAN ORGANISASI <br>
                                            <?= $unit_select->unit_nama ?></td>
                                <td>
                                    PERATURAN BUPATI SANGGAU <br>
                                    NOMOR &nbsp;&nbsp;: <?= $unit_select->unit_perda_no ?> <br>
                                    TANGGAL : <?= tgl($unit_select->unit_perda_tanggal) ?>
                                </td>
                            </tr>
                        </table>
                        <div id="tree"></div>
                        <div class="hide" id="legend1">
                            <div id="legend1-content">
                                <table class="table-pdf table-bordered-pdf">
                                    <tr>
                                        <td class="td">PEMERINTAH KABUPATEN SANGGAU <br>
                                            BAGAN SUSUNAN ORGANISASI <br>
                                            <?= $unit_select->unit_nama ?>
                                        </td>
                                        <td class="td">
                                            PERATURAN BUPATI SANGGAU <br>
                                            NOMOR &nbsp;&nbsp;: <?= $unit_select->unit_perda_no ?> <br>
                                            TANGGAL : <?= $unit_select->unit_perda_tanggal ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="hide" id="legend2">
                            <div id="legend2-content">
                                <table class="table-bordered">
                                    <tr>
                                        <td>
                                            PERATURAN BUPATI SANGGAU <br>
                                            NOMOR &nbsp;&nbsp;: <br>
                                            TANGGAL :
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div> -->
                    
                        <script>
                            var chart;
                            window.onload = function() {

                                
            //header
            OrgChart.templates.header = Object.assign({}, OrgChart.templates.ana);
                                    OrgChart.templates.header.svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  style="display:block;background-color: #BFE0F1" width="{w}" height="{h}" viewBox="{viewBox}">{content}</svg>';
                                    OrgChart.templates.header.header1 = '<text text-anchor="middle" width="400" style="font-size: 18px;font-weight:bold;" fill="#3F7D95" x="200" y="20">{val}</text>';
                                    OrgChart.templates.header.header2 = '<text text-anchor="middle" width="400"  style="font-size: 18px;" fill="#3F7D95" x="200" y="40">{val}</text>';
                                    OrgChart.templates.header.size = [500, 50];
                                    OrgChart.templates.header.node = '';
                                    OrgChart.templates.header.link = '<path stroke-linejoin="round" stroke="#fff" stroke-width="1px" fill="none" d="M{xa},{ya} {xb},{yb} {xc},{yc} L{xd},{yd}" />';

                                    OrgChart.templates.header.plus = '';
                                    OrgChart.templates.header.minus = '';

                                    //template
                                    OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.base);
                                    OrgChart.templates.myTemplate.size = [370, 200];
                                    OrgChart.templates.myTemplate.node =
                                        '<rect x="0" y="0" height="{h}" width="{w}" fill="#f4f3f3" stroke-width="1" stroke="#fff" rx="1" ry="1"></rect><circle cx="45" cy="60" r="35" fill="#fff"></circle>';
                                    OrgChart.templates.myTemplate.plus = "";
                                    OrgChart.templates.myTemplate.minus = "";
                                    OrgChart.templates.myTemplate.img_0 = '<image preserveAspectRatio="xMidYMid slice" xlink:href="{val}" x="-25" y="0" width="130" height="200"></image>';
                                    OrgChart.templates.myTemplate.img_2 = '<image preserveAspectRatio="xMidYMid slice" xlink:href="{val}" x="270" y="0" width="130" height="200"></image>';

                                    OrgChart.templates.myTemplate.html = '<foreignobject class="node" x="103" y="0" width="270" height="100%">{val}</foreignobject>';


                                    OrgChart.MIXED_LAYOUT_ALL_NODES = false;
                                    var chart = new OrgChart(document.getElementById("tree"), {
                                        showXScroll: OrgChart.scroll.visible,
                                        showYScroll: OrgChart.scroll.visible,
                                        mouseScrool: OrgChart.action.scroll,
                                        scaleInitial: OrgChart.match.boundary,
                                        enableSearch: false,
                                        template: "myTemplate",
                                        menu: {
                                            pdfPreview: {
                                                text: "PDF Preview",
                                                icon: OrgChart.icon.pdf(24, 24, '#7A7A7A'),
                                                onClick: preview
                                            },
                                            pdf: {
                                                text: 'A4 PDF',
                                                icon: OrgChart.icon.pdf(24, 24),
                                                onClick: function() {
                                                    chart.exportPDF({
                                                        // header: 'Bagan Organisasi',
                                                        footer: 'simpeg.sanggau.go.id',
                                                        format: 'A4',
                                                        margin: [200, 20, 40, 20],
                                                    });
                                                }
                                            }
                                            // pdf: {
                                            //     text: "Export PDF"
                                            // },
                                            // png: {
                                            //     text: "Export PNG"
                                            // },
                                            // svg: {
                                            //     text: "Export SVG"
                                            // },
                                            // csv: {
                                            //     text: "Export CSV"
                                            // }
                                        },
                                        // nodeMenu: {
                                        //     pdf: {
                                        //         text: "Export PDF"
                                        //     },
                                        //     png: {
                                        //         text: "Export PNG"
                                        //     },
                                        //     svg: {
                                        //         text: "Export SVG"
                                        //     }
                                        // },
                                        nodeBinding: {
                                            // header1: 'header1',
                                            // header2: 'header2',
                                            img_0: "photo1",
                                            html: "html",
                                            img_2: "photo2"
                                        },
                                        toolbar: {
                                            fullScreen: true,
                                            zoom: true,
                                            fit: true,
                                            expandAll: true
                                        },
                                        tags: {
                                            <?php foreach ($level->result() as $key) { ?> "<?= $key->bagan_level ?>": {
                                                    subLevels: <?= $key->bagan_level ?>,
                                                },
                                            <?php } ?>
                                        },
                                        nodes: [
                                            <?php foreach ($bagan->result() as $key) {


                                                if ($key->bagan_is_bupati != '1') {



                                                    $fotokpe = 'assets/images/user.jpg';

                                                    $JPG = str_replace('.jpg', '.JPG',  $key->pegawai_foto_kpe);
                                                    if (!blank($key->pegawai_foto_kpe)) {
                                                        if (file_exists(('assets/images/' . $key->pegawai_foto_kpe))) {
                                                            $fotokpe = 'assets/images/' . $key->pegawai_foto_kpe;
                                                        } else if (file_exists(('assets/images/' . $JPG))) {
                                                            $fotokpe = 'assets/images/' . $JPG;
                                                        } else {
                                                            $foto = str_replace(".jpg", ".jpeg", $key->pegawai_foto_kpe);
                                                            if (file_exists(('assets/images/' . $foto))) {
                                                                $fotokpe = 'assets/images/' . $foto;
                                                            }
                                                        }
                                                    }
                                                    //                                                    else {
                                                    //                                                        $fotokpe = 'default.jpg';
                                                    //                                                    }
                                            ?> {
                                                        id: "<?= $key->bagan_id ?>",
                                                        pid: "<?= $key->bagan_parent_id ?>",
                                                        tags: ["<?= $key->bagan_level ?>"],
                                                        name: "<?= $key->pegawai_nama ?>",
                                                        // photo1: "<?= 'http://simpeg.sanggau.go.id/' . $fotokpe ?>",
                                                        photo1: "<?= base_url($fotokpe) ?>",
                                                        photo2: "",
                                                        <?php if (!empty($key->pegawai_nama)) { ?>
                                                            html: "<div><table width='267'><tr style='background-color: #2323; text-align: center; font-size: 11px;' height='40' ><td><b><?= $key->jabatan_nama ?><b></td></tr><tr style='text-align: center; font-size: 11px;'><td><b><?= pegawai_gelar($key) ?></b><td></tr><tr style='text-align: center; font-size: 11px;'><td>NIP : <?= $key->pegawai_nip ?> <td></tr><tr style='text-align: center; font-size: 11px;'><td>TTL : <?= $key->pegawai_tempat_lahir ?>, <?= tgl($key->pegawai_tgl_lahir) ?><td></tr><tr style='text-align: center; font-size: 11px;'><td>TMT. JAB : <?= tgl($key->pegawai_jabatan_tmt) ?><td></tr><tr style='text-align: center; font-size: 11px;'><td>GOL. : <?= $key->pegawai_pangkat_terakhir_golru ?>, TMT : <?= tgl($key->pegawai_pangkat_terakhir_tmt) ?><td></tr></table><br></div>"
                                                        <?php } else { ?>
                                                            html: "<div><table width='267'><tr style='background-color: #2323; text-align: center; font-size: 11px;' height='40' ><td><b><?= $key->jabatan_nama ?><b></td></tr><tr><td>&nbsp;</td></tr><tr style='text-align: center; font-size: 11px;'><td><b><h4 style='color: red;'>LOWONG<h4></b><td></tr></table><br></div>"
                                                        <?php } ?>
                                                    },
                                                <?php } else {

                                                    $fotobup = 'assets/images/user.jpg';

                                                    if (file_exists(('assets/images/BUPATI.JPG'))) {
                                                        $fotobup = 'assets/images/BUPATI.JPG';
                                                    } else if (file_exists(('assets/images/BUPATI.jpg'))) {
                                                        $fotobup = 'assets/images/BUPATI.jpg';
                                                    } else 
                            if (file_exists(('assets/images/BUPATI.jpeg'))) {
                                                        $fotobup = 'assets/images/BUPATI.jpeg';
                                                    }

                                                    $fotowabup = 'assets/images/user.jpg';

                                                    if (file_exists(('assets/images/WABUP.JPG'))) {
                                                        $fotowabup = 'assets/images/WABUP.JPG';
                                                    } else if (file_exists(('assets/images/WABUP.jpg'))) {
                                                        $fotowabup = 'assets/images/WABUP.jpg';
                                                    } else 
                            if (file_exists(('assets/images/WABUP.jpeg'))) {
                                                        $fotowabup = 'assets/images/WABUP.jpeg';
                                                    }
                                                ?> {
                                                        id: "<?= $key->bagan_id ?>",
                                                        pid: "<?= $key->bagan_parent_id ?>",
                                                        tags: ["<?= $key->bagan_level ?>"],
                                                        name: "<?= $key->pegawai_nama ?>",
                                                        photo1: "<?= base_url($fotobup) ?>",
                                                        photo2: "<?= base_url($fotowabup) ?>",
                                                        <?php if (!empty($key->pegawai_nama)) { ?>
                                                            html: "<div><table width='175'><tr style='background-color: #2323; text-align: center; font-size: 11px;' height='40' ><td><b><?= $key->jabatan_nama ?><b></td></tr><tr style='text-align: center; font-size: 11px;'><td><b><?= pegawai_gelar($key) ?></b><td></tr><tr style='text-align: center; font-size: 11px;'><td>NIP : <?= $key->pegawai_nip ?> <td></tr><tr style='text-align: center; font-size: 11px;'><td>TTL : <?= $key->pegawai_tempat_lahir ?>, <?= tgl($key->pegawai_tgl_lahir) ?><td></tr><tr style='text-align: center; font-size: 11px;'><td>TMT. JAB : <?= tgl($key->pegawai_jabatan_tmt) ?><td></tr><tr style='text-align: center; font-size: 11px;'><td>GOL. : <?= $key->pegawai_pangkat_terakhir_golru ?>, TMT : <?= tgl($key->pegawai_pangkat_terakhir_tmt) ?><td></tr></table><br></div>"
                                                        <?php } else { ?>
                                                            html: "<div><table width='175'><tr style='background-color: #2323; text-align: center; font-size: 11px;' height='40' ><td><b>BUPATI/WAKIL BUPATI<b></td></tr><tr><td>&nbsp;</td></tr><tr style='text-align: center; font-size: 11px;'><td><b><h4'><?= $key->bagan_bupati_nama ?><h4></b><td></tr><tr><td>&nbsp;</td></tr><tr style='text-align: center; font-size: 11px;'><td><b><h4'><?= $key->bagan_wabupati_nama ?><h4></b><td></tr></table><br></div>"
                                                        <?php } ?>
                                                    },
                                            <?php }
                                            } ?>
                                        ]
                                    });


//                                 chart.on('init', function() {
//                                     preview();
//                                 })
                            
                            
                                chart.on('exportstart', function(sender, args) {
                                    args.content += '<link href="https://fonts.googleapis.com/css?family=Gochi+Hand" rel="stylesheet">';

                                    args.content += document.getElementById('myStyles').outerHTML;
                                    args.content += document.getElementById('legend1').outerHTML;
                                    // args.content += document.getElementById('legend2').outerHTML;

                                });
                            
                            
chart.editUI.on('show', function(sender, nodeId){
var node = chart.getNode(nodeId);

  return false;

});

                                function preview() {
                                    OrgChart.pdfPrevUI.show(chart, {
                                        format: 'A4'
                                    });
                                }
                            };
                        </script>
                    </div>
                </div>
            </div>
    	
    	<?php } ?>

    </section>
</div>

<script>
    $(document).on('click', '#setting', function() { //Cetak BY name
        var form = "<form id='hidden-form' action='<?= site_url('laporan/BaganStruktur/index') ?> ' method='post'>";

        form += "<input type='hidden' name='pegawai_unit_id' value='" + $('#pegawai_unit_id').val() + "'/>";
        form += "<input type='hidden' name='jenis' value='setting'/>";

        $(form + "</form>").appendTo($(document.body)).submit();
    });


    $(document).on('click', '#bagan', function() { //Cetak BY name
        var form = "<form id='hidden-form' action='<?= site_url('laporan/BaganStruktur/index') ?>' method='post'>";

        form += "<input type='hidden' name='pegawai_unit_id' value='" + $('#pegawai_unit_id').val() + "'/>";
        form += "<input type='hidden' name='jenis' value='bagan'/>";

        $(form + "</form>").appendTo($(document.body)).submit();
    });
</script>