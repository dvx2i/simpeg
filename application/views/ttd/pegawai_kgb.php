<?php
defined('BASEPATH') or exit('No direct script access allowed');
$modul = 'Kenaikan Gaji Berkala';
$filter['cpns'] = '';
$filter = $this->session->userdata('filter');

?>

<style>
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
                                                <select name="tahun" class="form-control select2 " id="tahun">
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
                                                    <option <?= $filter['cpns'] == '1' ? 'selected' : ''; ?>  value="1">CPNS</option>
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
                                                    <option <?= $filter['proses'] == '0' ? 'selected' : ''; ?> value="2">Belum Ditandatangani</option>
                                                    <option <?= $filter['proses'] == '1' ? 'selected' : ''; ?>  value="4">Sudah Ditandatangani</option>
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
                                    <th>TMT Kenaikan Gaji Terakhir</th>
                                    <th>Pangkat / Golru</th>
                                    <th>Jabatan</th>
                                    <th>Eselon</th>
                                    <th>OPD/Unit Kerja</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th>Surat Keterangan</th>
                                    <th>Aksi</th>
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
            <form role="form" action="<?= site_url('esign/PegawaiKgb/update') ?>" method="post">
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
                    <input type="hidden" name="kgb_id" id="kgb_id" value="">
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
<!-- The Modal -->
<div class="modal" id="myModal2">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Upload File SK</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form action="" id="form_sk" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6 form-group">
							<label for="">File SK (PDF/JPG/JPEG/PNG max 2MB)</label>
							<input type="file" name="file" id="file" class="form-control">
				      <input type="hidden" name="id_kgb" id="id_kgb" value="">
						</div>
						<!-- <div class="col-md-12 form-group">
							<label for="">Catatan</label>
							<textarea name="catatan" id="siswa_catatan" class="form-control" rows="5"></textarea>
						</div> -->
					</div>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
                <small class="pull-left">Data Kenaikan Gaji Berkala Akan Dikirim ke BPKAD Setelah File Diupload</small>
				<button id="btn-upload" type="button" class="btn btn-success" data-dismiss="modal">Upload</button>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="berkasModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
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

<link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert.css">
<script src="<?= base_url() ?>assets/sweetalert/sweetalert.min.js"></script>
<script>
    var tableData;

    
    
    function view(kgb_id, proses, file) {
        if (file.length > 0) {
            url_file = '<?= base_url("assets/docs/") ?>/' + file
        } else {
            url_file = '#'
        }

        if (proses == '1') {
        var status_proses = 'Pengecekan Berkas';
        var btn_update = '<a href="'+ url + '/' + kgb_id + '" class="btn btn-default buttons-html5 " ><span><i class="fa fa-edit"></i> Ubah</span></a> '
        } else if (proses == '2') {
            var status_proses = 'Proses Penandatanganan';
            var btn_update = ''
        } else if (proses == '3') {
            var status_proses = 'Dikembalikan';
            var btn_update = '<a href="'+ url + '/' + kgb_id + '" class="btn btn-default buttons-html5 " ><span><i class="fa fa-edit"></i> Ubah</span></a> '
        } else {
            var status_proses = 'Ditandatangani';
            var btn_update = ''
        }

        $("#berkasModal").find(".modal-footer").html('');
        $("#berkasModal").find(".sk").html('');
        $("#berkasModal").find("#status_proses").html('');
        var berkasModal = '<object data="' + url_file + '" type="application/pdf" width="100%" height="480px"></object>';
        $("#berkasModal").find(".sk").append(berkasModal);
        $("#berkasModal").find("#status_proses").append(status_proses);
        var url = '<?= site_url('pegawai/PegawaiKgb/update/sk') ?>'
        btn_update += '<button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>';

        $("#berkasModal").find(".modal-footer").append(btn_update);
        $('#berkasModal').modal('toggle');
        $('#berkasModal').modal('show');
    }
    
    function edit(kgb_id, file) {
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
                url: '<?= site_url('esign/PegawaiKgb/json') ?>',
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
                {
                    "data": "pegawai_telpon",
                    "searchable": false
                },
                {
                    "data": "pegawai_email",
                    "searchable": false
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
                {
                    "data": "status_proses",
                    "visible": false
                },
            ],
            dom: '<"dataTables_wrapper dt-bootstrap"<"row flex"<"col-md-2 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l>><"col-md-4 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"B>><"col-md-6 d-flex d-xl-block"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
            buttons: [
                // {
                //     text: 'Verifikasi',
                //     attr: {
                //         id: 'verifBtn',
                //         class: 'btn btn-primary',
                //         // style: 'border-radius: 6px;'
                //     }
                // },
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

        $('#final-btn').on('click', function() {

            $('#myModal').modal('hide');
            swal({
                title: "",
                text: "Tandatangan Kenaikan Gaji Berkala?",
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
            }, function(isConfirm) {
                if (isConfirm) {
                    
    setTimeout(function() {
                    swal({
                            type: 'success',
                            title: '',
                            text: 'Tandatangan Elektronik Berhasil',
                            // footer: '<a href>Why do I have this issue?</a>'
                        })
                    }, 400)

                } else {
                    // swal("Dibatalkan", "", "error");
    setTimeout(function() {
                    swal({
                            type: 'error',
                            title: '',
                            text: 'Tandatangan Elektronik Gagal',
                            // footer: '<a href>Why do I have this issue?</a>'
                        })
                    }, 400)
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