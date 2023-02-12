<?php

$filter = $this->session->userdata('filterpensiun');
$newitem = $this->session->userdata('newitempensiun');
$newitem = $newitem_pensiun->new_item;
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/date-text/jquery.datetextentry.css">

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

  .form-control-plaintext {
    display: block;
    width: 100%;
    padding-top: 0.375rem;
    padding-bottom: 0.375rem;
    margin-bottom: 0;
    line-height: 1.5;
    color: #333;
    background-color: transparent;
    border: solid transparent;
    border-width: 2px 0;
    font-weight: bold;
  }

  #loadMe {
    text-align: center;
    padding: 0 !important;
  }

  #loadMe:before {
    content: '';
    display: inline-block;
    height: 100%;
    vertical-align: middle;
    margin-right: -4px;
  }

  #loadMe .modal-dialog {
    display: inline-block;
    text-align: left;
    vertical-align: middle;
  }
</style>
<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Pegawai Pensiun
    </h1>
  </section>

  <section class="content-header">
    <?php echo $this->session->flashdata('message'); ?>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">

          <div class="panel-body">

            <div class="box-footer">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Cari</h3>
                <a href="<?= site_url('pensiun/PegawaiPensiun/add') ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</a>
              </div>
              <div class="box-body">
                <div class="row">

                  <!-- /.col -->
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
                                                    <option value="all">Semua</option>
                                                    <option <?= $filter['proses'] == '1' ? 'selected' : ''; ?> value="1">Proses Penandatanganan</option>
                                                    <option <?= $filter['proses'] == '2' ? 'selected' : ''; ?>  value="2">Selesai Penandatanganan</option>
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
<!--                         <button class="btn btn-primary btn-sm" id="btn-filter">Filter</button> -->
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
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
          </div>
          <div class="box-body table-responsive">
            <table id="mytable" class="table table-bordered table-striped" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <!-- <th>Status</th> -->
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Pangkat</th>
                  <th>Jabatan</th>
                  <th>Eselon</th>
                  <th>Unit</th>
                  <!-- <th>DPCP</th> -->
                  <th>SK</th>
                  <!-- <th>Lampiran</th> -->
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<div class="modal fade" id="berkasModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body ">
            	
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
<!-- jQuery 3 -->

<link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert.css">
<script src="<?= base_url() ?>assets/sweetalert/sweetalert.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/date-text/jquery.datetextentry.js"></script>
 
<script>
  var t;

  $('.dateEntry').datetextentry({
    show_tooltips: false,
    errorbox_x: -135,
    errorbox_y: 28
  });

  


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

    var t = $("#mytable").DataTable({
      // initComplete: function() {
      //   var api = this.api();
      //   $('#mytable_filter input')
      //     .off('.DT')
      //     .on('keyup.DT', function(e) {
      //       if (e.keyCode == 13) {
      //         api.search(this.value).draw();
      //       }
      //     });
      // },
      scrollX: true,
      oLanguage: {
        sEmptyTable: "Tidak ada data yang tersedia pada tabel ini",
        sProcessing: "Sedang memproses...",
        sLengthMenu: "Tampilkan _MENU_ entri",
        sZeroRecords: "Tidak ditemukan data yang sesuai",
        sInfo: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        sInfoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
        sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
        sInfoPostFix: "",
        sSearch: "Cari:",
        sUrl: "",
        oPaginate: {
          sFirst: "Pertama",
          sPrevious: "Sebelumnya",
          sNext: "Selanjutnya",
          sLast: "Terakhir"
        }
      },
      processing: true,
      serverSide: true,
      ajax: {
        "url": "PegawaiPensiun/json",
        "type": "POST",
        "data": function(data) {
          data.opd = $('#opd').val();
          data.proses = $('#proses').val();
          //   data.id_kuasa_pengguna = $('#id_kuasa_pengguna').val();
        }
      },
      columns: [{
          "data": "pegawaipensiun_id",
          "searchable": false,
          "orderable": false,
          // "checkboxes": {
          //   'selectRow': true
          // },
          'width': '5%'
        }, {
          "data": "pegawaipensiun_nip",
        },
        {
          "data": "nama",
          "searchable": false
        },
        {
          "data": "pangkat",
          "searchable": false
        },
        {
          "data": "pegawai_jabatan_nama",
          "searchable": false
        },
        {
          "data": "pegawai_eselon_nama",
          "searchable": false
        },
        {
          "data": "pegawai_unit_nama",
          "searchable": false
        },
        // {
        //   "data": "dpcp",
        //   "searchable": false
        // },
        {
          "data": "sk",
          "searchable": false
        },
        // {
        //   "data": "lampiran",
        //   "searchable": false
        // },
        {
          "data": "aksi",
          "searchable": false,
          "orderable": false,
          "className": "text-center",
        },
        {
          "data": "pegawai_nama",
          "visible": false
        },
      ],
      order: [
        [0, 'desc']
      ],
      dom: '<"dataTables_wrapper dt-bootstrap"<"row flex"<"col-md-2 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l>><"col-md-4 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"B>><"col-md-6 d-flex d-xl-block"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
      buttons: [
        <?php if ($newitem != 0) : ?> {
            text: '<i class="fa fa-send"></i> Beri Tahu Atasan',
            attr: {
              id: 'notif',
              class: 'btn btn-danger',
              style: 'border-radius: 6px;'
            }
          },
        <?php endif; ?>
            // dom: '<"dataTables_wrapper dt-bootstrap"<"row flex"<"col-md-2 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l>><"col-md-8 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex  text-center "B>><"col-md-2 d-flex d-xl-block"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
            // buttons: [
            //     {
            //         text: '<i class="fa fa-times"></i> Tolak',
            //         attr: {
            //             id: 'tolakBtn',
            //             class: 'btn btn-danger',
            //             style: 'border-radius: 6px;'
            //         }
            //     },
            //     {
            //         text: '<i class="fa fa-check"></i> Final',
            //         attr: {
            //             id: 'verifBtn',
            //             class: 'btn btn-primary',
            //             style: 'border-radius: 6px; margin-left: 30px;'
            //         }
            //     },
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
      rowCallback: function(row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $('td:eq(0)', row).html(index);
      // if (data['status_validasi'] == '1') $('td', row).css('background-color', 'white');
      // else if (data['status_validasi'] == '2') $('td', row).css('background-color', 'ghostwhite');
      // else if (data['status_validasi'] == '3') $('td', row).css('background-color', '#F5B7B1  ');
      }
    });
  
  
        	if($('#proses').val() == '2'){
            	$('#tolakBtn').show()
            	$('#verifBtn').show()
            }else{
            	$('#tolakBtn').hide()
            	$('#verifBtn').hide()
            }
  
    	$('#proses').change(function() {
        	
        	if($(this).val() == '2'){
            	$('#tolakBtn').show()
            	$('#verifBtn').show()
            }else{
            	$('#tolakBtn').hide()
            	$('#verifBtn').hide()
            }
        
            t.ajax.reload();
        });
  
    	$('#opd').change(function() {
            t.ajax.reload();
        });

    $('#btn-filter').on('click', function() {
      t.ajax.reload();
    });
  
	$('#notif').on('click', function() {
      swal({
        title: "",
        text: "Beri Tahu Atasan Untuk Menandatangani Berkas Pensiun?",
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
      }, function(isConfirm) {
        if (isConfirm) {

          $.ajax({
            url: '<?= site_url('pegawai/PegawaiAjax/notifTte') ?>',
            type: "POST",
            data: {
              ajax: '1',
              menu: 'pensiun'
            },
            success: function(data) {
              console.log(data);
              $('#myModal').modal('hide');
              swal({
                type: 'success',
                title: '',
                text: 'Berhasil',
              })
              window.location.reload();
            },
            error: function(xhr, textStatus, errorThrown) {
              console.log(textStatus);
              if (xhr.responseText == 'session timeout') {
                alert('Sesi anda telah habis. Silahkan LOGIN kembali');
                window.location = "<?= site_url('Akun') ?>";
              } else {
                swal({
                  type: 'error',
                  title: '',
                  text: xhr.responseText,
                })
                window.location.reload();
              }
            }
          });

        } else {
          swal("Dibatalkan", "", "error");
        }
      })
    });
   


  });
</script>
<script>
  function tgl_indo(string) {
    bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    date = string.split(" ")[0];
    time = string.split(" ")[1];

    tanggal = date.split("-")[2];
    bulan = date.split("-")[1];
    tahun = date.split("-")[0];

    return tanggal + " " + bulanIndo[Math.abs(bulan)] + " " + tahun;
  }
</script>