<?php
defined('BASEPATH') or exit('No direct script access allowed');
$modul = 'Lampiran SK Pegawai Pensiun';
$filter['cpns'] = '';
$filter = $this->session->userdata('filter');
$session = $this->session->userdata('login');

?>

<style>

  @media screen and (max-width: 767px){
div.dt-buttons {
  float: none;
  width: auto;
  text-align: center;
  margin-bottom: 0.5em;
}
}

	.modal-xl{
  width: 100%;
  height: 100%;
  margin: 0;
  top: 0;
  left: 0;
}
    /* .dropdown-toggle:hover .dropdown-menu{ display: block; } */
    .btn-group button:hover>.dropdown-menu {
    display: block;
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="row">

            <center>
                <?php echo $this->session->flashdata('message'); ?>
            </center>
            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <i class="fa fa-list fa-fw"></i> <?= $modul ?>
                    </div>
                    <div class="panel-body">

                        <div class="box-footer">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-tag"></i> Cari</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    
                                    <div class="col-sm-4 col-md-2">
                                        <div class="color-palette-set">
                                            <div class="color-palette">
                                                <label for="">Status</label>
                                            </div>
                                            <div class="color-palette">
                                                <select name="proses" class="form-control select2" id="proses">
                                                    <option <?= $filter['proses'] == '1' ? 'selected' : ''; ?> value="1">Belum Ditandatangani</option>
                                                    <option <?= $filter['proses'] == '2' ? 'selected' : ''; ?>  value="2">Sudah Ditandatangani</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-2">
                                        <div class="color-palette-set">
                                            <div class="color-palette">
                                                <label for="">&nbsp;</label>
                                            </div>
                                            <div class="color-palette">
<!--                                                 <button class="btn btn-primary btn-sm" id="btn-filter">Filter</button> -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <i class="fa fa-list fa-fw"></i> Daftar <?= $modul ?>
                    </div>
                    <div class="panel-body table-responsive">
                        <table id="tabelss" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama File</th>
                                    <th>Lampiran</th>

                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formPassphrase">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Passphrase</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Passphrase</label>
                        <input type="password" class="form-control" name="passphrase" id="passphrase" autocomplete="off" />

                    </div>
                    <input type="hidden" name="pensiun_id" id="pensiun_id" value="">
                    <input type="hidden" name="file" id="file" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="button" id="final-btn" class="btn btn-primary">Final</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-tolak">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formTolak">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tolak Berkas Pegawai Pensiun</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" autocomplete="off" />

                    </div>
                    <input type="hidden" name="pensiun_id_tolak" id="pensiun_id_tolak" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="button" id="tolak-btn" class="btn btn-primary">Tolak</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="berkasModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        	<h4 class="modal-title" id="myModalLabel">Berkas Pegawai Pensiun</h4>
      	</div>
            <div class="modal-body ">
                <div class="row">
                    <div class="sk"></div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <div class="loader"></div>
        <div clas="loader-txt">
          <p>Sedang memuat.. </p>
          <i class="fa fa-refresh fa-spin"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert.css">
<script src="<?= base_url() ?>assets/sweetalert/sweetalert.min.js"></script>
<script>
    var tableData;

    
    
    
  function view(proses, file) {
        if (file.length > 0) {
            url_file = '<?= base_url("assets/docs/pensiun/") ?>/' + file
        } else {
            url_file = '#'
        }

        $("#berkasModal").find(".modal-footer").html('');
        $("#berkasModal").find(".sk").html('');
        $("#berkasModal").find("#status_proses").html('');
        var berkasModal = '<object data="' + url_file + '" type="application/pdf" width="100%" height="720px"></object>';
        $("#berkasModal").find(".sk").append(berkasModal);
        btn_back = '<button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>';

        $("#berkasModal").find(".modal-footer").append(btn_back);
        $('#berkasModal').modal('toggle');
        $('#berkasModal').modal('show');
    }
    
    function edit(pensiun_id, file) {
    	$('#file').val(file)
    	$('#pensiun_id').val(pensiun_id)
        $('#myModal').modal('toggle');
        $('#myModal').modal('show');
    }
    
    function tolak(pensiun_id) {
    	$('#pensiun_id_tolak').val(pensiun_id)
        $('#modal-tolak').modal('toggle');
        $('#modal-tolak').modal('show');
    }

    $(document).ready(function() {
        

        tableData = $('#tabelss').DataTable({
            "pageLength": 10,
            "order": [
                [0, "asc"]
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: '<?= site_url('esign/LampiranPensiun/json') ?>',
                type: 'POST',
                data: function(data) {
                    data.bulan = $('#bulan').val();
                    data.tahun = $('#tahun').val();
                    data.opd = $('#opd').val();
                    data.proses = $('#proses').val();
                    data.status_kepegawaian = $('#status_kepegawaian').val();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr);
                    if (xhr.responseText == 'session timeout') {
                        alert('Sesi anda telah habis. Silahkan LOGIN kembali');
                        window.location = "<?= site_url('Akun') ?>";
                    } else {
                        alert('Terjadi kesalahan sistem');
                    }
                }
            },
            columns: [{
                    "data": "pensiunlampiran_id",
                    "orderable": false,
                    "checkboxes": {
                        'selectRow': true
                    },
                    'width': '5%'
                },
                {
                    "data": "pensiunlampiran_file",
                },
                {
                "data": "lampiran",
                    "className": "text-center",
                "searchable": false
                },
                // {
                //     "data": "aksi",
                //     "orderable": false,
                //     "className": "text-center",
                // 	"width": '20%'
                // },
            ],
            dom: '<"dataTables_wrapper dt-bootstrap"<"row flex"<"col-md-2 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l>><"col-md-8 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex  text-center "B>><"col-md-2 d-flex d-xl-block"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
            buttons: [
                {
                    text: '<i class="fa fa-times"></i> Tolak',
                    attr: {
                        id: 'tolakBtn',
                        class: 'btn btn-danger',
                        style: 'border-radius: 6px;'
                    }
                },
                {
                    text: '<i class="fa fa-check"></i> Final',
                    attr: {
                        id: 'verifBtn',
                        class: 'btn btn-primary',
                        style: 'border-radius: 6px; margin-left: 30px;'
                    }
                },
                // {
                //     extend: 'pdf',
                //     className: 'btn btn-primary',
                //     orientation: 'landscape',
                //     pageSize: 'LEGAL',
                //     exportOptions: {
                //         columns: [0, 1, 2, 3, 4, 5, 6,7,8,9,10]
                //     }
                // },
                // {
                //     extend: 'print',
                //     className: 'btn btn-primary',
                //     exportOptions: {
                //         columns: [0, 1, 2, 3, 4, 5, 6,7,8,9,10]
                //     }
                // },
            ],
        });
    
        	if($('#proses').val() == '1'){
            	$('#tolakBtn').show()
            	$('#verifBtn').show()
            }else{
            	$('#tolakBtn').hide()
            	$('#verifBtn').hide()
            }

    	$('#opd').change(function() {
            tableData.ajax.reload();
        });
    
    	$('#proses').change(function() {
        	
        	if($(this).val() == '1'){
            	$('#tolakBtn').show()
            	$('#verifBtn').show()
            }else{
            	$('#tolakBtn').hide()
            	$('#verifBtn').hide()
            }
        
            tableData.ajax.reload();
        });

        $('#btn-filter').on('click', function() {
            tableData.ajax.reload();
        });

    	
        $('#tolakBtn').on('click', function() {
            var table = tableData;
            var rows_selected = table.column(0).checkboxes.selected();
            list_id = [];

            $.each(rows_selected, function(index, rowId) {
                list_id.push(rowId);
            })

            if (list_id.length == 0) {
                swal("Data belum dipilih", "", "error");
                return false;
            }
        
        $('#modal-tolak').modal('toggle');
        $('#modal-tolak').modal('show');
        });
    	
        $('#verifBtn').on('click', function() {
            var table = tableData;
            var rows_selected = table.column(0).checkboxes.selected();
            list_id = [];

            $.each(rows_selected, function(index, rowId) {
                list_id.push(rowId);
            })

            if (list_id.length == 0) {
                swal("Data belum dipilih", "", "error");
                return false;
            }
        
        $('#myModal').modal('toggle');
        $('#myModal').modal('show');
        });
    
    	
        $("#formPassphrase").submit(function (e) {
            e.preventDefault();
        
        	$('#myModal').modal('hide');
            var table = tableData;
            var rows_selected = table.column(0).checkboxes.selected();
            list_id = [];

            $.each(rows_selected, function(index, rowId) {
                list_id.push(rowId);
            })

            if (list_id.length == 0) {
                swal("Data belum dipilih", "", "error");
                return false;
            }

            swal({
                title: "",
                text: "Tanda tangani Berkas Pegawai Pensiun?",
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
            }, function(isConfirm) {
                if (isConfirm) {
                    
    				// $("#loadMe").modal({
    				// backdrop: "static", //remove ability to close modal with click
    				// keyboard: false, //remove option to close with keyboard
    				// show: true //Display loader!
    				// })
                    var pensiun_id = $('#pensiun_id').val();              
                	
                    $.ajax({
                        url: '<?= site_url('esign/LampiranPensiun/update/sign') ?>',
                        type: "POST",
                        data: {
                            ajax: '1',
                            pensiun_id: list_id,
                        	passphrase: $('#passphrase').val()
                        },
                        dataType: "json",
                        success: function(data) {
                        $('#passphrase').val('');
                        if(data.success ){
                        	
        					$('#myModal').modal('hide');
    						// setTimeout(function() {
                    			swal({
                            		type: 'success',
                            		title: '',
                            		text: 'Tandatangan Elektronik Berhasil',
                            		// footer: '<a href>Why do I have this issue?</a>'
                        		})
                    		// }, 200)
                        
    						setTimeout(function() {
              					window.location.reload()
                    		}, 200)
                        }else{
                    			swal({
                            		type: 'error',
                            		title: '',
                            		text: data.message,
                            		// footer: '<a href>Why do I have this issue?</a>'
                        		})
                        }
                        },
                		error: function(xhr, textStatus, errorThrown) {
                    	$('#passphrase').val('');
                    	if (xhr.responseText == 'session timeout') {
                        	alert('Sesi anda telah habis. Silahkan LOGIN kembali');
                       	 	window.location = "<?= site_url('Akun') ?>";
                    	} else {
                    			swal({
                            		type: 'error',
                            		title: '',
                            		text: 'Terjadi Kesalahan Sistem',
                            		// footer: '<a href>Why do I have this issue?</a>'
                        		})
                    	}
                }
                    });
                
        		// $('#loadMe').modal('hide');
                	

                } else {
                    swal("Dibatalkan", "", "error");
                }
            })
        })
        
        $('#final-btn').on('click', function() {
        	$('#myModal').modal('hide');
            var table = tableData;
            var rows_selected = table.column(0).checkboxes.selected();
            list_id = [];

            $.each(rows_selected, function(index, rowId) {
                list_id.push(rowId);
            })

            if (list_id.length == 0) {
                swal("Data belum dipilih", "", "error");
                return false;
            }

            swal({
                title: "",
                text: "Tanda tangani Berkas Pegawai Pensiun?",
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
            }, function(isConfirm) {
                if (isConfirm) {
                    
    				// $("#loadMe").modal({
    				// backdrop: "static", //remove ability to close modal with click
    				// keyboard: false, //remove option to close with keyboard
    				// show: true //Display loader!
    				// })
                    var pensiun_id = $('#pensiun_id').val();              
                	
                    $.ajax({
                        url: '<?= site_url('esign/LampiranPensiun/update/sign') ?>',
                        type: "POST",
                        data: {
                            ajax: '1',
                            pensiun_id: list_id,
                        	passphrase: $('#passphrase').val()
                        },
                        dataType: "json",
                        success: function(data) {
                        $('#passphrase').val('');
                        if(data.success ){
                        	
        					$('#myModal').modal('hide');
    						// setTimeout(function() {
                    			swal({
                            		type: 'success',
                            		title: '',
                            		text: 'Tandatangan Elektronik Berhasil',
                            		// footer: '<a href>Why do I have this issue?</a>'
                        		})
                    		// }, 200)
                        
    						setTimeout(function() {
              					window.location.reload()
                    		}, 200)
                        }else{
                    			swal({
                            		type: 'error',
                            		title: '',
                            		text: data.message,
                            		// footer: '<a href>Why do I have this issue?</a>'
                        		})
                        }
                        },
                		error: function(xhr, textStatus, errorThrown) {
                    	$('#passphrase').val('');
                    	if (xhr.responseText == 'session timeout') {
                        	alert('Sesi anda telah habis. Silahkan LOGIN kembali');
                       	 	window.location = "<?= site_url('Akun') ?>";
                    	} else {
                    			swal({
                            		type: 'error',
                            		title: '',
                            		text: 'Terjadi Kesalahan Sistem',
                            		// footer: '<a href>Why do I have this issue?</a>'
                        		})
                    	}
                }
                    });
                
        		// $('#loadMe').modal('hide');
                	

                } else {
                    swal("Dibatalkan", "", "error");
                }
            })
        })
    
  $(document).ajaxStart(function(){
    // $('#loadMe').show();
    $("#loadMe").modal({
      backdrop: "static", //remove ability to close modal with click
      keyboard: false, //remove option to close with keyboard
      show: true //Display loader!
    });
  }).ajaxComplete(function(){
      // $('#loadMe').hide();
    $("#loadMe").modal("hide");
  });

        <?php /*
        // $('#final-btn').on('click', function() {
        //     var table = tableData;
        // 	$('#myModal').modal('hide');

        //     swal({
        //         title: "",
        //         text: "Tanda tangani Berkas Pegawai Pensiun?",
        //         type: 'info',
        //         showCancelButton: true,
        //         confirmButtonText: 'Ya',
        //         cancelButtonText: 'Batal',
        //     }, function(isConfirm) {
        //         if (isConfirm) {
    	// 			$("#loadMe").modal({
      	// 				backdrop: "static", //remove ability to close modal with click
      	// 				keyboard: false, //remove option to close with keyboard
      	// 				show: true //Display loader!
    	// 			});
        //             var pensiun_id = $('#pensiun_id').val();
        //             var file = $('#file').val();                
                	
        //             $.ajax({
        //                 url: '<?= site_url('esign/LampiranPensiun/update/sign') ?>',
        //                 type: "POST",
        //                 data: {
        //                     ajax: '1',
        //                     pensiun_id: pensiun_id,
        //                 	file: file
        //                 },
        //                 dataType: "json",
        //                 success: function(data) {
        //                 if(data.success ){
                        	
        // 					$('#myModal').modal('hide');
    	// 					setTimeout(function() {
        //             			swal({
        //                     		type: 'success',
        //                     		title: '',
        //                     		text: 'Tandatangan Elektronik Berhasil',
        //                     		// footer: '<a href>Why do I have this issue?</a>'
        //                 		})
        //             		}, 400)
      	// 				table.ajax.reload();
        //                 }else{
        //             			swal({
        //                     		type: 'error',
        //                     		title: '',
        //                     		text: data.message,
        //                     		// footer: '<a href>Why do I have this issue?</a>'
        //                 		})
        //                 }
        //                 },
        //         		error: function(xhr, textStatus, errorThrown) {
        //             	console.log(xhr);
        //             	if (xhr.responseText == 'session timeout') {
        //                 	alert('Sesi anda telah habis. Silahkan LOGIN kembali');
        //                	 	window.location = "<?= site_url('Akun') ?>";
        //             	} else {
        //             			swal({
        //                     		type: 'error',
        //                     		title: '',
        //                     		text: 'Terjadi Kesalahan Sistem',
        //                     		// footer: '<a href>Why do I have this issue?</a>'
        //                 		})
        //             	}
        //         }
        //             });
                
        // 		$('#loadMe').modal('hide');
                	

        //         } else {
        //             swal("Dibatalkan", "", "error");
        //         }
        //     })
        // }) */ ?>
    
    
        $('#tolak-btn').on('click', function() {
        	$('#modal-tolak').modal('hide');
            var table = tableData;
        	$('#myModal').modal('hide');
            var table = tableData;
            var rows_selected = table.column(0).checkboxes.selected();
            list_id = [];

            $.each(rows_selected, function(index, rowId) {
                list_id.push(rowId);
            })

            if (list_id.length == 0) {
                swal("Data belum dipilih", "", "error");
                return false;
            }

            swal({
                title: "",
                text: "Berkas Pegawai Pensiun tidak akan ditanda tangani?",
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
            }, function(isConfirm) {
                if (isConfirm) {
    				$("#loadMe").modal({
      					backdrop: "static", //remove ability to close modal with click
      					keyboard: false, //remove option to close with keyboard
      					show: true //Display loader!
    				});
                
                    var keterangan = $('#keterangan').val();                
                	
                    $.ajax({
                        url: '<?= site_url('esign/LampiranPensiun/update/tolak') ?>',
                        type: "POST",
                        data: {
                            ajax: '1',
                            pensiun_id: list_id,
                        	keterangan: keterangan
                        },
                        dataType: "json",
                        success: function(data) {
                        if(data.success ){
                        	
        					$('#myModal').modal('hide');
    						// setTimeout(function() {
                    			swal({
                            		type: 'success',
                            		title: '',
                            		text: 'Berhasil dikembalikan',
                            		// footer: '<a href>Why do I have this issue?</a>'
                        		})
                    		// }, 200)
                        
    						setTimeout(function() {
              					window.location.reload()
                    		}, 200)
                        }else{
                    			swal({
                            		type: 'error',
                            		title: '',
                            		text: data.message,
                            		// footer: '<a href>Why do I have this issue?</a>'
                        		})
                        }
                        },
                		error: function(xhr, textStatus, errorThrown) {
                    	console.log(xhr);
                    	if (xhr.responseText == 'session timeout') {
                        	alert('Sesi anda telah habis. Silahkan LOGIN kembali');
                       	 	window.location = "<?= site_url('Akun') ?>";
                    	} else {
                    			swal({
                            		type: 'error',
                            		title: '',
                            		text: 'Terjadi Kesalahan Sistem',
                            		// footer: '<a href>Why do I have this issue?</a>'
                        		})
                    	}
                }
                    });
                
        		$('#loadMe').modal('hide');
                	

                } else {
                    swal("Dibatalkan", "", "error");
                }
            })
        })
    
    
        $("#formTolak").submit(function (e) {
            e.preventDefault();
        	
        	$('#modal-tolak').modal('hide');
            var table = tableData;
        	$('#myModal').modal('hide');
            var table = tableData;
            var rows_selected = table.column(0).checkboxes.selected();
            list_id = [];

            $.each(rows_selected, function(index, rowId) {
                list_id.push(rowId);
            })

            if (list_id.length == 0) {
                swal("Data belum dipilih", "", "error");
                return false;
            }

            swal({
                title: "",
                text: "Berkas Pegawai Pensiun tidak akan ditanda tangani?",
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
            }, function(isConfirm) {
                if (isConfirm) {
    				$("#loadMe").modal({
      					backdrop: "static", //remove ability to close modal with click
      					keyboard: false, //remove option to close with keyboard
      					show: true //Display loader!
    				});
                
                    var keterangan = $('#keterangan').val();                
                	
                    $.ajax({
                        url: '<?= site_url('esign/LampiranPensiun/update/tolak') ?>',
                        type: "POST",
                        data: {
                            ajax: '1',
                            pensiun_id: list_id,
                        	keterangan: keterangan
                        },
                        dataType: "json",
                        success: function(data) {
                        if(data.success ){
                        	
        					$('#myModal').modal('hide');
    						// setTimeout(function() {
                    			swal({
                            		type: 'success',
                            		title: '',
                            		text: 'Berhasil dikembalikan',
                            		// footer: '<a href>Why do I have this issue?</a>'
                        		})
                    		// }, 200)
                        
    						setTimeout(function() {
              					window.location.reload()
                    		}, 200)
                        }else{
                    			swal({
                            		type: 'error',
                            		title: '',
                            		text: data.message,
                            		// footer: '<a href>Why do I have this issue?</a>'
                        		})
                        }
                        },
                		error: function(xhr, textStatus, errorThrown) {
                    	console.log(xhr);
                    	if (xhr.responseText == 'session timeout') {
                        	alert('Sesi anda telah habis. Silahkan LOGIN kembali');
                       	 	window.location = "<?= site_url('Akun') ?>";
                    	} else {
                    			swal({
                            		type: 'error',
                            		title: '',
                            		text: 'Terjadi Kesalahan Sistem',
                            		// footer: '<a href>Why do I have this issue?</a>'
                        		})
                    	}
                }
                    });
                
        		$('#loadMe').modal('hide');
                	

                } else {
                    swal("Dibatalkan", "", "error");
                }
            })
        });
        

    function d_m_y(date) {
        if (date != null) {
            var from = date.split("-");
            return from[2] + "/" + from[1] + "/" + from[0];
        } else {
            return date;
        }
    }
    

    });
</script>