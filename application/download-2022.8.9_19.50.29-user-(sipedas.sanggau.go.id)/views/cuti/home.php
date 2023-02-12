<link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert2.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/toast/toast.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/tracker/tracker.css">
<style>
    .form-horizontal .form-group:before {
        display: table;
        content: " ";
    }

    .form-control-plaintext {
        font-weight: bold;
    }

    /* .berkasModal {
        
 min-height: 600px;
    } */
</style>

<!-- begin #quote -->
<div id="quote" class="content" data-scrollview="true" style="background-color:#f1f3f4;">
    <!-- begin content-bg -->
    <!-- <div class="content-bg" style="background-image: url(<?= base_url('assets/publik') ?>/img/bg/bg-quote.jpg)"
				data-paroller-factor="0.5"
				data-paroller-factor-md="0.01"
				data-paroller-factor-xs="0.01">
			</div> -->
    <div class="content-bg" data-paroller-factor="0.5" data-paroller-factor-md="0.01" data-paroller-factor-xs="0.01">
    </div>
    <!-- end content-bg -->
    <!-- begin container -->
    <div class="container" data-animation="true" data-animation-type="fadeInLeft">
        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12 quote">&nbsp;</div>
            <div class="col-md-12 quote">
                <!-- <i class="fa fa-quote-left"></i> Passion leads to design, design leads to performance, <br />
						performance leads to <span class="text-primary">success</span>!  
						<i class="fa fa-quote-right"></i> -->
                <img class="logo-simpeg" height="200px" src="<?= base_url('assets/publik') ?>/img/logo-cuti.png" alt="">
                <!-- <small>sipedas.sanggau.go.id</small> -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end #quote -->

<?php /*
<style>
    .page-header-cover {
        position: absolute; 
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        overflow: hidden;
    }

    .img {
        max-width: 100%;
        max-height: 100%;
    }
</style>

<!-- BEGIN #page-header -->
<div id="page-header" class="page-header-container bg-white" style="margin-top: 72px;">
    <!-- BEGIN page-header-cover -->
    <div class="page-header-cover">
        <img class="img" src="<?= base_url('assets/publik') ?>/img/simpeg.jpg" alt="" />
    </div>
    <!-- END page-header-cover -->
</div>
<!-- BEGIN #page-header -->
*/ ?>

<?php /*
<!-- begin #pricing -->
<div class="content" data-scrollview="true">
    <!-- begin container -->
    <div class="container fadeInDown contentAnimated finishAnimated" data-animation="true" data-animation-type="fadeInDown">
        <h2 class="content-title">Saldo Cuti</h2>
        <p class="content-desc">
        </p>
        <!-- begin row -->
        <div class="row">
            <!-- begin col-4 -->
            <div class="col-md-4 col-sm-12">
                <div class="widget widget-stats bg-danger">
                    <div class="note note-with-right-icon m-b-15">
                        <div class="note-content text-center">
                            <h4><b>5 Hari</b></h4>
                            Sisa Cuti Tahunan
                        </div>
                        <div class="note-icon"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <!-- end col-4 -->
            <div class="col-md-4 col-sm-12">

                <div class="widget widget-stats bg-warning">
                    <div class="note note-with-right-icon m-b-15">
                        <div class="note-content text-center">
                            <h4><b>15 Hari</b></h4>
                            Sisa Cuti Besar
                        </div>
                        <div class="note-icon"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <!-- end col-4 -->
            <!-- end col-4 -->
            <div class="col-md-4 col-sm-12">
                <div class="widget widget-stats bg-success">
                    <div class="note note-with-right-icon m-b-15">
                        <div class="note-content text-center">
                            <h4><b>15 Hari</b></h4>
                            Sisa Cuti Sakit
                        </div>
                        <div class="note-icon"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <!-- end col-4 -->
        </div>
        <!-- end row -->
    </div>
</div>
*/ ?>

<div class="content " data-scrollview="true">
    <!-- p-t-0  -->
    <!-- begin container -->
    <div class="container fadeInDown contentAnimated finishAnimated" data-animation="true" data-animation-type="fadeInDown">
        <h2 class="content-title"><strong>Cuti Online</strong></h2>
        <div class="row">

            <div class="col-md-12 col-sm-12">

                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Daftar Cuti</h4>
                        <a href="<?= site_url('cuti/Pengajuan/create') ?>" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Buat Pengajuan Cuti</a>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body bg-abu">
                        <div id="data-table-default_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                            <div class="table-responsive">
                                <table id="tables" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th scope="col" style="text-align: center;min-width: 30px;width: 50px" style="text-align: center">NO</th>
                                            <th style="min-width: 60px;width: 200px; text-align:center;">AKSI</th>
                                            <th scope="col" style="text-align: center">NO PERMOHONAN</th>
                                            <th scope="col" style="text-align: center">NIP</th>
                                            <th scope="col" style="text-align: center">NAMA</th>
                                            <th scope="col" style="text-align: center">JENIS CUTI</th>
                                            <th scope="col" style="text-align: center">TGL. MULAI CUTI</th>
                                            <th scope="col" style="text-align: center">TGL. SELESAI CUTI</th>
                                            <th scope="col" style="text-align: center">STATUS</th>
                                            <th scope="col" style="text-align: center">SI CUTI</th>
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
                                                    <?php if ($value->pegawaicuti_status_permohonan == '1' || $value->pegawaicuti_status_permohonan == '3') : ?>
                                                        <a href="<?= site_url('cuti/Pengajuan/update/' . $value->pegawaicuti_no_permohonan) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i></a>
                                                    <?php endif; ?>
                                                    <a href="#detail" onclick="detail('<?= $value->pegawaicuti_id ?>')" class="btn btn-primary btn-sm"><i class="fa fa-info-circle fa-fw"></i></a>
                                                    <?php if ($value->pegawaicuti_status_permohonan <> '4') : ?>
                                                        <a href="<?= site_url('cuti/Pengajuan/delete/' . $value->pegawaicuti_no_permohonan) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Menghapus Data.?')"><i class="fa fa-trash-o fa-fw"></i></a>
                                                    <?php endif; ?>

                                                </td>
                                                <td><strong><?= $value->pegawaicuti_no_permohonan ?></strong></td>
                                                <td><?= $value->pegawaicuti_pegawai_nip ?></td>
                                                <td><?= $value->pegawai_nama ?></td>
                                                <td><?= $value->jenis_cuti_nama ?></td>
                                                <td><?= tgl($value->pegawaicuti_lama_cuti_mulai) ?></td>
                                                <td><?= tgl($value->pegawaicuti_lama_cuti_selesai) ?></td>
                                                <td><strong><?= status_permohonan_cuti($value->pegawaicuti_status_permohonan, $value->pegawaicuti_keterangan_tolak) ?></strong></td>
                                                <td><?= sk_cuti($value->file_sk, $value->pegawaicuti_status_permohonan) ?></td>
                                            </tr>

                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                    <!-- end panel-body -->
                </div>
            </div>
        </div>
        <!-- end container -->
    </div>


    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="detailModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail Cuti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body tracking" style="min-height: 99px;">

                </div>
                <div class="modal-body">
                    <form class="form form-horizontal">
                        <div class="form-group row">
                            <label for="message-text" class="col-sm-4 col-form-label">Status Permohonan:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext " id="status_permohonan" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="col-sm-4 col-form-label">Keterangan Ditolak:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="keterangan_tolak" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-4 col-form-label">No Permohonan:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="no_permohonan" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="col-sm-4 col-form-label">NIP:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="nip" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="col-sm-4 col-form-label">Nama:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="nama" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="col-sm-4 col-form-label">Unit Kerja:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="unit" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="col-sm-4 col-form-label">Pangkat / Golongan:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="pangkat" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="col-sm-4 col-form-label">Jabatan:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="jabatan" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="col-sm-4 col-form-label">Jenis Cuti:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="jenis_cuti" value="">
                            </div>
                        </div>
                        <div id="normal">
                            <div class="form-group row">
                                <label for="message-text" class="col-sm-4 col-form-label">Tanggal Mulai:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="tanggal_mulai" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="message-text" class="col-sm-4 col-form-label">Tanggal Selesai:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="tanggal_selesai" value="">
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label for="message-text" class="col-sm-4 col-form-label">Keterangan:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="keterangan" value="">
                                </div>
                            </div> -->
                        </div>
                        <div id="tahap1" style="display: none;">
                            <div class="form-group row">
                                <label for="message-text" class="col-sm-4 col-form-label">Tahap 1:</label>
                                <div class="col-sm-8">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="message-text" class="col-sm-4 col-form-label">Tanggal Mulai:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="tanggal_mulai_1" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="message-text" class="col-sm-4 col-form-label">Tanggal Selesai:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="tanggal_selesai_1" value="">
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label for="message-text" class="col-sm-4 col-form-label">Keterangan:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="keterangan_1" value="">
                                </div>
                            </div> -->
                        </div>
                        <div id="tahap2" style="display: none;">
                            <div class="form-group row">
                                <label for="message-text" class="col-sm-4 col-form-label">Tahap 2:</label>
                                <div class="col-sm-8">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="message-text" class="col-sm-4 col-form-label">Tanggal Mulai:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="tanggal_mulai_2" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="message-text" class="col-sm-4 col-form-label">Tanggal Selesai:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="tanggal_selesai_2" value="">
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label for="message-text" class="col-sm-4 col-form-label">Keterangan:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="keterangan_2" value="">
                                </div>
                            </div> -->
                        </div>

                        <?php
                        $berkass = $berkas->result_array();
                        for ($i = 0; $i < count($berkass); $i++) : ?>
                            <div class="form-group row">
                                <label for="message-text" class="col-sm-4 col-form-label"><?= $berkass[$i]['berkas_nama'] ?></label>
                                <div class="col-sm-8" id="form<?= $i ?>">
                                </div>
                            </div>
                        <?php endfor; ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cuti Online</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    $berkass = $berkas->result_array();
    for ($i = 0; $i < count($berkass); $i++) : ?>
        <!-- Modal -->
        <div class="modal fade" id="berkasModal<?= $i ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= $berkass[$i]['berkas_nama'] ?></h5>
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
    <?php endfor; ?>



    <!-- jQuery 3 -->

    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- jQuery UI 1.11.4 -->

    <script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>assets/sweetalert/sweetalert2.js"></script>
    <script src="<?= base_url() ?>assets/plugins/toast/toast.min.js"></script>

    <script src="<?= base_url('assets') ?>/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- <script src="<?= base_url('assets') ?>/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script> -->
    <script src="<?= base_url() ?>/assets/datatables/dataTables.checkbox.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/jszip/dist/jszip.min.js"></script>
    <script>
        function detail(v) {

            $("#detailModal").find(".tracking").html('');

            $.ajax({
                url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiCutiOnlineById') ?>',
                type: "POST",
                data: {
                    ajax: '1',
                    id: v
                },
                dataType: "json",
                async: true,
                success: function(data) {
                    $('#no_permohonan').val(data.pegawaicuti_no_permohonan);
                    $('#nip').val(data.pegawaicuti_pegawai_nip);
                    $('#nama').val(data.pegawai_nama);
                    $('#unit').val(data.pegawai_unit_nama);
                    $('#pangkat').val(data.pegawai_pangkat_terakhir_nama + ' (' + data.pegawai_pangkat_terakhir_golru + ')');
                    $('#jabatan').val(data.pegawai_jabatan_nama);
                    $('#jenis_cuti').val(data.jenis_cuti_nama);
                    $('#tanggal_mulai').val(tgl_indo(data.pegawaicuti_lama_cuti_mulai));
                    $('#tanggal_selesai').val(tgl_indo(data.pegawaicuti_lama_cuti_selesai));
                    // $('#keterangan').val(data.pegawaicuti_keterangan);
                    $('#keterangan_tolak').val(data.pegawaicuti_keterangan_tolak);
                    $('#status_permohonan').val(data.status_nama);

                    if (data.pegawaicuti_bertahap != '0') {
                        $('#normal').hide();
                        $('#tahap1').show();
                        $('#tahap2').show();
                        $('#tanggal_mulai_1').val(tgl_indo(data.pegawaicuti_lama_cuti_mulai));
                        $('#tanggal_selesai_1').val(tgl_indo(data.pegawaicuti_lama_cuti_selesai));
                        $('#jumlah_hari_1').val(data.pegawaicuti_jumlah_hari);
                        // $('#keterangan_1').val(data.pegawaicuti_keterangan);
                        $('#tanggal_mulai_2').val(tgl_indo(data.th2_mulai));
                        $('#tanggal_selesai_2').val(tgl_indo(data.th2_selesai));
                        $('#jumlah_hari_2').val(data.th2_jumlah_hari);
                        // $('#keterangan_2').val(data.th2_keterangan);
                    } else {

                        $('#normal').show();
                        $('#tahap1').hide();
                        $('#tahap2').hide();
                    }

                    var status_permohonan = data.pegawaicuti_status_permohonan;
                    var class1 = "todo";
                    var class2 = "todo";
                    var class3 = "todo";
                    var class4 = "todo";

                    if (status_permohonan == '3') {
                        var class1 = "done";
                    }
                    if (status_permohonan == '1') {
                        var class1 = "done";
                        var class2 = "done";
                    }
                    if (status_permohonan == '2') {
                        var class1 = "done";
                        var class2 = "done";
                        var class3 = "done";
                    }
                    if (status_permohonan == '4') {
                        var class1 = "done";
                        var class2 = "done";
                        var class3 = "done";
                        var class4 = "done";
                    }


                    var progres = '<ol class="track-progress"> ' +
                        '<li class="' + class1 + '"> ' +
                        '<em>1</em> ' +
                        '<span>Pengajuan</span> ' +
                        '</li> ' +
                        '<li class="' + class2 + '"> ' +
                        '<em>2</em> ' +
                        '<span>Verifikasi</span> ' +
                        '</li> ' +
                        '<li class="' + class3 + '"> ' +
                        ' <em>3</em> ' +
                        '<span>Diproses</span> ' +
                        '</li> ' +
                        '<li class="' + class4 + '"> ' +
                        '<em>4</em> ' +
                        '<span>Disetujui</span> ' +
                        '</li> ' +
                        '</ol>';


                    $("#detailModal").find(".tracking").append(progres);
                }
            });

            $.ajax({
                url: '<?= site_url('pegawai/PegawaiAjax/getPegawaiCutiOnlineBerkasById') ?>',
                type: "POST",
                data: {
                    ajax: '1',
                    id: v
                },
                dataType: "json",
                async: true,
                success: function(data) {
                    $.each(data, function(i, item) {
                        $("#berkasModal" + i).find(".berkasModal").html('');
                        var html = ' <a href="<?= base_url("assets/files/cuti/") ?>/' + item.url_file + '" class="btn btn-sm btn-grey" target="_blank"><i class="fa fa-download"></i> <small>Unduh</small></a>';
                        html += '&nbsp; <button type="button" class="btn  btn-sm btn-primary" data-toggle="modal" data-target="#berkasModal' + i + '"><i class="fa fa-eye"></i> <small>Lihat</small></button>';
                        $('#form' + i).html(html);

                        var berkasModal = '<object data="<?= base_url("assets/files/cuti/") ?>/' + item.url_file + '" type="application/pdf" width="100%" height="480px"></object>';
                        $("#berkasModal" + i).find(".berkasModal").append(berkasModal);
                    });
                }
            });

            $('#detailModal').modal('show')

        }

        $('#tables').DataTable();

        $(document).ready(function() {


            <?php if ($no_permohonan  <> "") : ?>

                $('#staticBackdrop').modal('show')
                $("#staticBackdrop").find(".modal-body").append("<p>Permohonan berhasil disimpan dengan nomor permohonan <strong><?= $no_permohonan ?></strong> </p>");

            <?php endif; ?>

            <?php if ($this->session->userdata('error') <> "") : ?>

                toastr.danger('Terjadi kesalahan.')
            <?php endif; ?>

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