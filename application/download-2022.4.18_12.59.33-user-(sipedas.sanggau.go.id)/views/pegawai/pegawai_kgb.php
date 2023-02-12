<?php
defined('BASEPATH') or exit('No direct script access allowed');
$modul = 'Kenaikan Gaji Berkala';
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
                                    <div class="col-sm-4 col-md-2">
                                        <div class="color-palette-set">
                                            <div class="color-palette">
                                                <label for="">Bulan</label>
                                            </div>
                                            <div class="color-palette">
                                                <select name="bulan" class="form-control" id="bulan">
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
                                                <select name="tahun" class="form-control " id="tahun">
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
                                                    <option <?= $filter['proses'] == '0' ? 'selected' : ''; ?> value="0">Belum Diproses</option>
                                                    <option <?= $filter['proses'] == '1' ? 'selected' : ''; ?>  value="1">Sudah Diproses</option>
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
                                    <th width="20%">Administrator</th>
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
            <form role="form" action="<?= site_url('pegawai/PegawaiKgb/update') ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Proses Kenaikan Gaji Berkala</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama" readonly autocomplete="off" />
                                                           

                    </div>
                    <div class="form-group">
                        <label>Pejabat Yang Menetapkan</label> <br>
                        <select class="form-control select2" style="width: 100%;"  name="pegawaikgb_pejabat" id="pegawaikgb_pejabat">
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
                        <input type="text" class="form-control" name="pegawaikgb_sk_no" id="pegawaikgb_sk_no" autocomplete="off" />
                                                           

                    </div>
                    <div class="form-group">
                        <label>Tanggal SK</label>
                        <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawaikgb_sk_tanggal" id="pegawaikgb_sk_tanggal" autocomplete="off" />
                                                           

                    </div>
                    <input type="hidden" name="nip" id="nip" value="">
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

<link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert.css">
<script src="<?= base_url() ?>assets/sweetalert/sweetalert.min.js"></script>
<script>
    var tableData;

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
                location.href = '<?= site_url('pegawai/PegawaiKgb/update') ?>'
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
                    "data": "aksi",
                    "orderable": false,
                    "className": "text-center",
                    'width': '15%'
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
            buttons: [{
                    text: 'Verifikasi',
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