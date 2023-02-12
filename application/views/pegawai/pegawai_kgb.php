<?php
defined('BASEPATH') or exit('No direct script access allowed');

    header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

$filter['cpns'] = '';
$filter = $this->session->userdata('filterkgb');
$newitem = $newitem_kgb->new_item;
$modul = 'Kenaikan Gaji Berkala ';

?>

<style>

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
    
  <section class="content-header">
    <h1>
      Kenaikan Gaji Berkala
    </h1>
  </section>

  <section class="content-header">
    <?php echo $this->session->flashdata('message'); ?>
  </section>

    <section class="content">
        <div class="row">

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
                                                <label for="">Bulan</label>
                                            </div>
                                            <div class="color-palette">
                                                <select name="bulan" class="form-control select2" id="bulan">
                                                    <?php
                                                        if (!empty($filter['bulan'])) {
                                                            $bln= $filter['bulan'];
                                                        } else {
                                                            $bln = date('m');
                                                        }
                                                    $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                                    for ($a = 1; $a <= 12; $a++) {
                                                        if ($a == $bln) {
                                                            $pilih = "selected";
                                                        } else {
                                                            $pilih = "";
                                                        }
                                                        echo ("<option value=\"$a\" $pilih>$bulan[$a].</option>" . "\n");
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
                                                <select name="tahun" class="form-control select2 " id="tahun">
                                                    <?php
                                                        if (!empty($filter['tahun'])) {
                                                            $tahun = $filter['tahun'];
                                                        } else {
                                                            $tahun = date('Y');
                                                        }
                                                    for ($a = date('Y')+1; $a >= date('Y') - 10; $a--) {
                                                        if ($a == $tahun) {
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
                                                <label for="">Status Kepegawaian</label>
                                            </div>
                                            <div class="color-palette">
                                                <select name="cpns" class="form-control select2" id="cpns">
                                                    <option <?= $filter['cpns'] == '2' ? 'selected' : ''; ?> value="2">PNS</option>
                                                    <option <?= $filter['cpns'] == '1' ? 'selected' : ''; ?> value="1">CPNS</option>
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
                                                    <option <?= $filter['proses'] == '0' ? 'selected' : ''; ?> value="0">Belum Diproses</option>
                                                    <option <?= $filter['proses'] == '1' ? 'selected' : ''; ?> value="1">Sudah Diproses</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
<!--                                     <div class="col-sm-4 col-md-2">
                                        <div class="color-palette-set">
                                            <div class="color-palette">
                                                <label for="">&nbsp;</label>
                                            </div>
                                            <div class="color-palette">
                                                <button class="btn btn-primary btn-sm" id="btn-filter">Filter</button>
                                            </div>
                                        </div>
                                    </div> -->
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
                                    <th>TMT Kenaikan Gaji Terakhir</th>
                                    <th>Pangkat / Golru</th>
                                    <th>Jabatan</th>
                                    <th>Eselon</th>
                                    <th>OPD/Unit Kerja</th>
                                    <th>Keterangan</th>
                                    <th>Surat Keterangan</th>
                                    <th width="200px">Administrator</th>
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
            <form role="form" action="<?= site_url('pegawai/PegawaiKgb/update/verif') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Nomor SK Kenaikan Gaji Berkala</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama" readonly autocomplete="off" />


                    </div>
                    <!-- <div class="form-group">
                        <label>Pejabat Yang Menetapkan</label> <br>
                        <select class="form-control select2" style="width: 100%;" name="pegawaikgb_pejabat" id="pegawaikgb_pejabat">
                            <option value="">--Pilih--</option>
                            <?php
                            foreach ($pejabat->result() as $value) {
                            ?>
                                <option <?= $value->pejabat_nama == 'BUPATI SANGGAU' ? 'seleceted' : ''; ?> value="<?= $value->pejabat_nama ?>"><?= $value->pejabat_nama ?></option>
                            <?php } ?>
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label>No SK</label>
                        <input type="text" class="form-control" name="pegawaikgb_sk_no" id="pegawaikgb_sk_no" autocomplete="off" />


                    </div>
                    <div class="form-group">
                        <label>Tanggal SK</label>
                        <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaikgb_sk_tanggal" id="pegawaikgb_sk_tanggal" autocomplete="off" />


                    </div>
                    <input type="hidden" name="nip" id="nip" value="">
                    <input type="hidden" name="id_kgb" id="id_kgb" value="">
                    <input type="hidden" name="cpns" id="cpns_proses" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- The Modal -->


<div class="modal fade" id="berkasModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body ">
            	
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <table class="table" border="0">
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td id="status_proses"></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td id="keterangan"></td>
                    </tr>
                </table>
                <div class="row">
                    <div class="sk"></div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert.css">
<script src="<?= base_url() ?>assets/sweetalert/sweetalert.min.js"></script>
<script>
    var tableData;


    function ubah_sk(v) {

        $.ajax({

            url: '<?= site_url('pegawai/PegawaiAjax/getSkKgb') ?>',
            type: "POST",
            data: {
                ajax: '1',
                id: v
            },
            dataType: "json",
            async: true,
            success: function(data) {

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

                $('#formadd').attr('action', '<?= site_url('pegawai/PegawaiRiwayatJabatan/update') ?>');

            }
        });

        $('#id_kgb').val(v);

        $('#berkasModal').modal('hide');
        $('#myModal2').modal('show');

    }
    
    function verifikasi(id_kgb,nip,nama,sk,tgl_sk) {
        $('#id_kgb').val(id_kgb)
        $('#nip').val(nip);
        $('#nama').val(nama);
        $('#pegawaikgb_sk_no').val(sk);
        $('#pegawaikgb_sk_tanggal').datetextentry('set_date', tgl_sk);
        $('#cpns_proses').val($('#cpns').val());
        $('#myModal').modal('toggle');
        $('#myModal').modal('show');
    }

    function proses() {

        swal({
            title: "",
            text: "Proses Kenaikan Gaji Berkala?",
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
        }, function(isConfirm) {
            if (isConfirm) {
                location.href = '<?= site_url('pegawai/PegawaiKgb/update/proses') ?>'
            } else {
                swal("Dibatalkan", "", "error");
            }
        })


    }
    
    function verif(v) {

        swal({
            title: "Verifikasi?",
            text: "Berkas akan dilanjutkan ke proses penandatanganan.",
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
        }, function(isConfirm) {
            if (isConfirm) {
                    var form = "<form id='hidden-form' action='<?= site_url('pegawai/PegawaiKgb/update/verif') ?>' method='post'>";

                    form += "<input type='hidden' name='id_kgb' value='" + v + "'/>";

                    $(form + "</form>").appendTo($(document.body)).submit();
            } else {
                swal("Dibatalkan", "", "error");
            }
        })


    }

    function edit(nip, nama) {

        swal({
        title: "",
            text: "Proses Kenaikan Gaji Berkala?",
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
        }, function(isConfirm) {
            if (isConfirm) {
                var cpns = $('#cpns').val();
                var form = "<form id='hidden-form' action='<?= site_url('pegawai/PegawaiKgb/update/proses') ?>' method='post'>";

                form += "<input type='hidden' name='nip' value='" + nip + "'/>";
                
                form += "<input type='hidden' name='cpns' value='" + cpns + "'/>";

                $(form + "</form>").appendTo($(document.body)).submit();

            } else {
                swal("Dibatalkan", "", "error");
            }
        })
    }

    function view(id_kgb, proses, file, keterangan) {
    console.log(keterangan)
        url = '<?= site_url('pegawai/PegawaiKgb/update/sk') ?>'
        if (file.length > 0) {
            url_file = '<?= base_url("assets/docs/kgb/") ?>/' + file + '?<?=time();?>'
        } else {
            url_file = '#'
        }

        if (proses == '1') {
        var status_proses = 'Pengecekan Berkas';
        var btn_update = '<a href="'+ url + '/' + id_kgb + '" class="btn btn-default buttons-html5 " ><span><i class="fa fa-edit"></i> Ubah</span></a> '
        } else if (proses == '2') {
            var status_proses = 'Proses Penandatanganan';
            var btn_update = ''
        } else if (proses == '3') {
            var status_proses = 'Dikembalikan';
            var btn_update = '<a href="'+ url + '/' + id_kgb + '" class="btn btn-default buttons-html5 " ><span><i class="fa fa-edit"></i> Ubah</span></a> '
        } else {
            var status_proses = 'Ditandatangani';
            var btn_update = ''
        }

        $("#berkasModal").find(".modal-footer").html('');
        $("#berkasModal").find(".sk").html('');
        $("#berkasModal").find("#status_proses").html('');
        var berkasModal = '<object data="' + url_file + '" type="application/pdf" width="100%" height="720px"></object>';
        $("#berkasModal").find(".sk").append(berkasModal);
        $("#berkasModal").find("#status_proses").append(status_proses);
        $("#berkasModal").find("#keterangan").append(keterangan);
        var url = '<?= site_url('pegawai/PegawaiKgb/update/sk') ?>'
        
    	btn_update += '<a href="' + url_file + '" class="btn btn-success" target="_blank">Unduh</a>';
        btn_update += '<button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>';

        $("#berkasModal").find(".modal-footer").append(btn_update);
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


        tableData = $('#tabelss').DataTable({
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
            "ajax": {
                url: '<?= site_url('pegawai/PegawaiKgb/json') ?>',
                type: 'POST',
                data: function(data) {
                    data.bulan = $('#bulan').val();
                    data.tahun = $('#tahun').val();
                    data.opd = $('#opd').val();
                    data.proses = $('#proses').val();
                    data.cpns = $('#cpns').val();
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
                    "data": "pegawai_nip",
                    "orderable": false,
                    'width': '5%'
                },
                {
                    "data": "pegawai_nip"
                },
                {
                    "data": "nama",
                    "searchable": false
                },
                {
                    "data": "pegawaikgb_tmt"
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
                // {
                //     "data": "pegawai_telpon",
                //     "searchable": false
                // },
                // {
                //     "data": "pegawai_email",
                //     "searchable": false
                // },
                {
                    "data": "pegawaikgb_keterangan",
                },
                {
                    "data": "sk",
                    "orderable": false,
                    "className": "text-center",
                },
                {
                    "data": "aksi",
                    "orderable": false,
                    "className": "text-center",
                },
                {
                    "data": "pegawai_nama",
                    "visible": false
                },
                {
                    "data": "pangkat_golongan_pangkat",
                    "visible": false
                },
            ],
            dom: '<"dataTables_wrapper dt-bootstrap"<"row flex"<"col-md-2 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l>><"col-md-4 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"B>><"col-md-6 d-flex d-xl-block"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
            buttons: [
            <?php if($newitem != 0) : ?>
                {
                    text: '<i class="fa fa-send"></i> Beri Tahu Atasan',
                    attr: {
                        id: 'notif',
                        class: 'btn btn-danger',
                        style: 'border-radius: 6px;'
                    }
                },
            <?php endif; ?>
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
    
    	
        	if($('#proses').val() == '1'){
            	$('#notif').show()
            }else{
            	$('#notif').hide()
            }

    
    	$('#cpns').change(function() {
            tableData.ajax.reload();
        });
    	$('#opd').change(function() {
            tableData.ajax.reload();
        });
    	$('#tahun').change(function() {
            tableData.ajax.reload();
        });
    	$('#bulan').change(function() {
            tableData.ajax.reload();
        });
    	$('#proses').change(function() {
        	if($(this).val() == '1'){
            	$('#notif').show()
            }else{
            	$('#notif').hide()
            }
            tableData.ajax.reload();
        });

        $('#btn-filter').on('click', function() {
            tableData.ajax.reload();
        });
    
    	
        $('#notif').on('click', function() {
            swal({
                title: "",
                text: "Beri Tahu Atasan Untuk Menandatangani SK?",
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
            }, function(isConfirm) {
                if (isConfirm) {
                	
                	// return false;
          $.ajax({
            url: '<?= site_url('pegawai/PegawaiAjax/notifTte') ?>',
            type: "POST",
            data: {
              ajax: '1',
              menu: 'kgb'
            },
            dataType: "json",
            success: function(data) {
                  swal({
                    type: 'success',
                    title: '',
                    text: 'Berhasil',
                    // footer: '<a href>Why do I have this issue?</a>'
                  })
            	window.location.reload();
            },
            error: function(xhr, textStatus, errorThrown) {
              console.log(xhr);
              if (xhr.responseText == 'session timeout') {
                alert('Sesi anda telah habis. Silahkan LOGIN kembali');
                window.location = "<?= site_url('Akun') ?>";
              } else {
                  swal({
                    type: 'success',
                    title: '',
                    text: 'Berhasil',
                    // footer: '<a href>Why do I have this issue?</a>'
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

            swal({
                title: "",
                text: "Proses Kenaikan Gaji Berkala?",
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
            }, function(isConfirm) {
                if (isConfirm) {
                    var cpns = $('#cpns').val();
                    var form = "<form id='hidden-form' action='<?= site_url('pegawai/PegawaiKgb/update') ?>' method='post' target='_blank'>";

                    $.each(rows_selected, function(index, rowId) {
                        form += "<input type='hidden' name='nip[]' value='" + rowId + "'/>";
                    })
                    form += "<input type='hidden' name='cpns' value='" + cpns + "'/>";

                    $(form + "</form>").appendTo($(document.body)).submit();

                } else {
                    swal("Dibatalkan", "", "error");
                }
            })
        })


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