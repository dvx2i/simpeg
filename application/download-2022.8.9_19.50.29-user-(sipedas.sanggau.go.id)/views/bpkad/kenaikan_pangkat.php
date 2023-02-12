<?php
defined('BASEPATH') or exit('No direct script access allowed');
$modul = 'Kenaikan Pangkat ';
$filter = $this->session->userdata('filter');

?>
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
                                <?php /*
                                    <div class="col-sm-4 col-md-2">
                                        <div class="color-palette-set">
                                            <div class="color-palette">
                                                <label for="">Bulan</label>
                                            </div>
                                            <div class="color-palette">
                                                <select name="bulan" class="form-control select2" id="bulan">
                                                    <?php
                                                    $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                                    
      
                                                    for ($a = 1; $a <= 12; $a++) {
                                                        if ($a == $filter['bulan']) {
                                                            $pilih = "selected";
                                                        } else {
                                                            $pilih = "";
                                                        }
                                                        echo ("<option value=\"$a\" $pilih>$bulan[$a]</option>" . "\n");
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 col-md-2">
                                        <div class="color-palette-set">
                                            <div class="color-palette">
                                                <label for="">Tahun</label>
                                            </div>
                                            <div class="color-palette">
                                                <select name="tahun" class="form-control  select2" id="tahun">
                                                    <?php
                                                    for ($a = date('Y'); $a >= date('Y') - 10; $a--) {
                                                        if ($a == $filter['tahun']) {
                                                            $pilih = "selected";
                                                        } else {
                                                            $pilih = "";
                                                        }
                                                        echo ("<option value=\"$a\" $pilih>$a</option>" . "\n");
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    */ ?>
                                    <div class="col-sm-4 col-md-2">
                                        <div class="color-palette-set">
                                            <div class="color-palette">
                                                <label for="">Unit Kerja</label>
                                            </div>
                                            <div class="color-palette">
                                                <select name="opd" class="form-control select2" id="opd">
                                                    <option value="all">Semua</option>
                                                    <?php foreach ($unit->result() as $key) : ?>
                                                        <option <?= $filter['opd'] == $key->unit_id ? 'selected' : ''; ?> value="<?= $key->unit_id ?>"><?= $key->unit_nama ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-2">
                                        <div class="color-palette-set">
                                            <div class="color-palette">
                                                <label for="">Status</label>
                                            </div>
                                            <div class="color-palette">
                                                <select name="proses" class="form-control select2" id="proses">
                                                    <option <?= $filter['proses'] == '1' ? 'selected' : ''; ?> value="1">Belum Diproses</option>
                                                    <option <?= $filter['proses'] == '2' ? 'selected' : ''; ?>  value="2">Sudah Diproses</option>
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
                                                <button class="btn btn-primary btn-sm" id="btn-filter">Filter</button>
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
                    <div class="panel-body">
                        <table id="tabelss" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>TMT Kenaikan Pangkat Terakhir</th>
                                    <th>Pangkat / Golru</th>
                                    <th>Jabatan</th>
                                    <th>Eselon</th>
                                    <th>OPD/Unit Kerja</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th>Administrator</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

  <!-- Modal -->
  <div class="modal fade" id="berkasModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">File SK Kenaikan Pangkat </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body berkasModal">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
  </div>


<link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert.css">
<script src="<?= base_url() ?>assets/sweetalert/sweetalert.min.js"></script>
<script>
    var tableData;

    
    function upload_sk(v) {
			$('#id_pangkat').val(v);
			$('#myModal2').modal('show');
				
		}

    function proses() {

        swal({
            title: "",
            text: "Proses Kenaikan Pangkat ?",
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
        }, function(isConfirm) {
            if (isConfirm) {
                location.href = '<?= site_url('bpkad/Kenaikan_pangkat/update') ?>'
            } else {
                swal("Dibatalkan", "", "error");
            }
        })


    }
    
    function edit(nip,nama) {
        $('#nip').val(nip);
        $('#nama').val(nama);
        $('#cpns_proses').val($('#cpns').val());
        $('#myModal').modal('toggle');
        $('#myModal').modal('show');
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
                url: '<?= site_url('bpkad/Kenaikan_pangkat/json') ?>',
                type: 'POST',
                data: function(data) {
                    data.bulan = $('#bulan').val();
                    data.tahun = $('#tahun').val();
                    data.opd = $('#opd').val();
                    data.proses = $('#proses').val();
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
                    "data": "pegawaipangkat_id",
                    "orderable": false,
                    "checkboxes": {
                        'selectRow': true
                    },
                    'width': '5%'
                },
                {
                    "data": "pegawai_nip"
                },
                {
                    "data": "pegawai_nama",
                    "searchable": false
                },
                {
                    "data": "pegawaipangkat_tmt"
                },
                {
                    "data": "pangkat",
                    "searchable": false
                },
                {
                    "data": "pegawai_jabatan_nama",
                },
                {
                    "data": "pegawai_eselon_nama"
                },
                {
                    "data": "pegawai_unit_nama",
                },
                {
                    "data": "pegawai_telpon",
                    "searchable": false
                },
                {
                    "data": "pegawai_email",
                    "searchable": false
                },
                {
                    "data": "aksi",
                    "orderable": false,
                    "className": "text-center",
                    'width': '30%'
                },
                {
                    "data": "pegawai_nama",
                    "visible": false
                },
                {
                    "data": "pangkat_golongan_pangkat",
                    "visible": false
                },
                {
                    "data": "proses_bpkad",
                    "visible": false
                },
            ],
            dom: '<"dataTables_wrapper dt-bootstrap"<"row flex"<"col-md-2 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l>><"col-md-4 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"B>><"col-md-6 d-flex d-xl-block"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
            buttons: [
                {
                    text: '<i class="fa fa-external-link-square"></i> &nbsp;Tandai terproses',
                    attr: {
                        id: 'verifBtn',
                        class: 'btn btn-primary',
                        // style: 'border-radius: 6px;'
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


        $('#btn-filter').on('click', function() {
            tableData.ajax.reload();
        });

        $('#verifBtn').on('click', function() {
            var table = tableData;
            var rows_selected = table.column(0).checkboxes.selected();
            list_id = [];

            $.each(rows_selected, function(index, rowId) {
                list_id.push(rowId);
            })

            if (list_id.length == 0) {
                swal("Pegawai belum dipilih", "", "error");
                return false;
            }
            // swal({
            //     title: "",
            //     text: "Proses Kenaikan Pangkat ?",
            //     type: 'info',
            //     showCancelButton: true,
            //     confirmButtonText: 'Ya',
            //     cancelButtonText: 'Batal',
            // }, function(isConfirm) {
                // if (isConfirm) {
                    var cpns = $('#cpns').val();
                    // var form = "<form id='hidden-form' action='<?= site_url('bpkad/Kenaikan_pangkat/update') ?>' method='post' target='_blank'>";

                    // $.each(rows_selected, function(index, rowId) {
                    //     form += "<input type='hidden' name='nip[]' value='" + rowId + "'/>";
                    // })
                    //     form += "<input type='hidden' name='cpns' value='" + cpns + "'/>";

                    // $(form + "</form>").appendTo($(document.body)).submit();
                    
                    $.ajax({
                        url: '<?= site_url('bpkad/Kenaikan_pangkat/update') ?>',
                        type: "POST",
                        data: {
                            ajax: '1',
                            list_id: list_id
                        },
                        success: function(response) {
                            tableData.ajax.reload();
                        },
                        error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                            swal(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                        }
                    });

                // } else {
                //     swal("Dibatalkan", "", "error");
                // }
            // })
        })

        
        

    function d_m_y(date) {
        if (date != null) {
            var from = date.split("-");
            return from[2] + "/" + from[1] + "/" + from[0];
        } else {
            return date;
        }
    }
    
    
		$('#btn-upload').click(function(){
			
			var frm = $('#form_sk');
        	var formData = new FormData(frm[0]);

							$.ajax({
								type: "POST", // Method pengiriman data bisa dengan GET atau POST
								url: "<?= site_url('bpkad/Kenaikan_pangkat/update/sk/') ?>",
								dataType: "JSON",
								data: formData,
								processData: false,
								contentType: false,
								success: function(response) {
                                    if(response.success){
                                    swal({
                                        title: 'Berhasil',
                                        text: "Upload SK Berhasil",
                                        type: 'success',
                                        // showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya'
                                    }).then((result) => {
                                        if (result.value) {
                                        var api = $("#tableData").DataTable();
                                        api.ajax.reload();
                                        }
                                    })
                                    }else{
                                        
                                    swal({
                                        type: 'error',
                                        title: '!',
                                        text: response.message,
                                        // footer: '<a href>Why do I have this issue?</a>'
                                    })
                                    }
								},
								error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
									swal(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
								}
							});
		})

    });

        $(document).on('click', '.btn-sk', function(){
            var v = $(this).data('id');
            $.ajax({
            url: '<?= site_url('pegawai/PegawaiAjax/getSkPangkat') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            success: function(data) {
                $("#berkasModal" ).find(".berkasModal").html('');
                $("#berkasModal" ).find(".modal-footer").html('');
                // console.log(data[0].pangkatsk_file)
                var html = ' <a href="<?= base_url("assets/files/") ?>' + data[0].pangkatsk_file + '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-download"></i> <small>Unduh</small></a>';
                html += '&nbsp; <button type="button" class="btn  btn-sm btn-primary" data-toggle="modal" data-target="#berkasModal'  + '"><i class="fa fa-eye"></i> <small>Lihat</small></button>';
                $('#form' ).html(html);

                var berkasModal = '<object data="<?= base_url("assets/files/") ?>/' + data[0].pangkatsk_file + '" type="application/pdf" width="100%" height="480px"></object>';
                $("#berkasModal" ).find(".berkasModal").append(berkasModal);
                var footerModal = '<a href="<?= base_url("assets/files/") ?>/' + data[0].pangkatsk_file + '" class="btn btn-success" target="_blank"> Unduh</a><button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>'
                $("#berkasModal" ).find(".modal-footer").append(footerModal);
            }
                });
            
            
            });
</script>