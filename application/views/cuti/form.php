<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/date-text/jquery.datetextentry.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert2.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
<style>
    .radiobtn {
        position: relative;
        display: block;
    }

    .radiobtn label {
        display: block;
        background: #fee8c3;
        color: #444;
        border-radius: 5px;
        padding: 10px 20px;
        border: 2px solid #fdd591;
        margin-bottom: 5px;
        cursor: pointer;
    }

    .radiobtn label:after,
    .radiobtn label:before {
        content: "";
        position: absolute;
        right: 11px;
        top: 11px;
        width: 20px;
        height: 20px;
        border-radius: 3px;
        background: #fdcb77;
    }

    .radiobtn label:before {
        background: transparent;
        transition: 0.1s width cubic-bezier(0.075, 0.82, 0.165, 1) 0s, 0.3s height cubic-bezier(0.075, 0.82, 0.165, 2) 0.1s;
        z-index: 2;
        overflow: hidden;
        background-repeat: no-repeat;
        background-size: 13px;
        background-position: center;
        width: 0;
        height: 0;
        background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNS4zIDEzLjIiPiAgPHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE0LjcuOGwtLjQtLjRhMS43IDEuNyAwIDAgMC0yLjMuMUw1LjIgOC4yIDMgNi40YTEuNyAxLjcgMCAwIDAtMi4zLjFMLjQgN2ExLjcgMS43IDAgMCAwIC4xIDIuM2wzLjggMy41YTEuNyAxLjcgMCAwIDAgMi40LS4xTDE1IDMuMWExLjcgMS43IDAgMCAwLS4yLTIuM3oiIGRhdGEtbmFtZT0iUGZhZCA0Ii8+PC9zdmc+);
    }

    .radiobtn input[type=radio] {
        display: none;
        position: absolute;
        width: 100%;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .radiobtn input[type=radio]:checked+label {
        background: #fdcb77;
        -webkit-animation-name: blink;
        animation-name: blink;
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        border-color: #fcae2c;
    }

    .radiobtn input[type=radio]:checked+label:after {
        background: #fcae2c;
    }

    .radiobtn input[type=radio]:checked+label:before {
        width: 20px;
        height: 20px;
    }

    @-webkit-keyframes blink {
        0% {
            background-color: #fdcb77;
        }

        10% {
            background-color: #fdcb77;
        }

        11% {
            background-color: #fdd591;
        }

        29% {
            background-color: #fdd591;
        }

        30% {
            background-color: #fdcb77;
        }

        50% {
            background-color: #fdd591;
        }

        45% {
            background-color: #fdcb77;
        }

        50% {
            background-color: #fdd591;
        }

        100% {
            background-color: #fdcb77;
        }
    }

    @keyframes blink {
        0% {
            background-color: #fdcb77;
        }

        10% {
            background-color: #fdcb77;
        }

        11% {
            background-color: #fdd591;
        }

        29% {
            background-color: #fdd591;
        }

        30% {
            background-color: #fdcb77;
        }

        50% {
            background-color: #fdd591;
        }

        45% {
            background-color: #fdcb77;
        }

        50% {
            background-color: #fdd591;
        }

        100% {
            background-color: #fdcb77;
        }
    }
</style>

<?php /*
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
                <img class="logo-simpeg" height="160px" src="<?= base_url('assets/publik') ?>/img/logo-cuti.png" alt="">
                <!-- <small>sipedas.sanggau.go.id</small> -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end #quote -->

<!-- begin #pricing -->
<div class="content m-t-20" data-scrollview="true">
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
*/

?>


<div class="content m-t-40" data-scrollview="true">
    <!-- begin container -->
    <div class="container fadeInDown contentAnimated finishAnimated" data-animation="true" data-animation-type="fadeInDown">

        <h2 class="content-title"><strong>Permohonan Cuti</strong></h2>
        <p class="content-desc">
        </p>
        <div class="row">

            <div class="col-md-12 col-sm-12">

                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Form Permohonan Cuti</h4>
                        <!-- <a href="<?= site_url('cuti/') ?>" class="btn btn-primary pull-left"><i class="fa fa-table"></i> Daftar Pengajuan Cuti</a> -->
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body bg-abu">
                        <div class="col-md-8 col-sm-12 offset-md-2">
                            <form action="<?= $action ?>" method="POST" id="form-cuti" enctype="multipart/form-data">
                                <input type="hidden" name="pegawaicuti_id" id="pegawaicuti_id" value="<?= $pegawaicuti_id ?>">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4  text-lg-right">
                                        <span class="text-danger">*</span> Nama
                                    </label>
                                    <div class="input-group col-md-8">
                                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $nama ?>" placeholder="" readonly />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4  text-lg-right">
                                        <span class="text-danger">*</span> NIP
                                    </label>
                                    <div class="input-group col-md-8">
                                        <input type="text" class="form-control" name="nip" id="nip" value="<?= $nip ?>" placeholder="" readonly />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4  text-lg-right">
                                        <span class="text-danger">*</span> Jenis Cuti
                                    </label>
                                    <div class="input-group col-md-8">
                                        <select class="form-control" name="jeniscuti_id" id="jeniscuti_id" required="true">
                                            <option value="">--Pilih--</option>
                                            <?php
                                            if ($jenkel_id == '1' && $value->jenis_cuti_id <> '6' && $value->jenis_cuti_id <> '4') {
                                                foreach ($jenis_cuti->result() as $value) {
                                                    $selected = $jeniscuti_id == $value->jenis_cuti_id ? 'selected' : '';
                                                    if ($value->jenis_cuti_id <> '6' && $value->jenis_cuti_id <> '4') {
                                                        echo '<option ' . $selected . ' value="' . $value->jenis_cuti_id . '">' . $value->jenis_cuti_nama . '</option>';
                                                    }
                                                }
                                            } else {
                                                foreach ($jenis_cuti->result() as $value) {
                                                    $selected = $jeniscuti_id == $value->jenis_cuti_id ? 'selected' : '';
                                                    if ($value->jenis_cuti_id <> '6') {
                                                        echo '<option ' . $selected . ' value="' . $value->jenis_cuti_id . '">' . $value->jenis_cuti_nama . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4  text-lg-right">
                                        <span class="text-danger">*</span> Tahun
                                    </label>
                                    <div class="col-md-8">
                                        <?php $y = date('Y')+1;
                                        $x = $y - 3;
                                        $p = 0;
                                        for ($i = $x; $i <= $y; $i++) { ?>

                                            <div class="form-check form-check-inline">
                                                <input <?= $tahun[$p] == $i ? 'checked' : ''; ?> type="checkbox" class="tahun" name="tahun[]" id="check<?= $i ?>" value="<?= $i ?>">
                                                <label class="form-check-label" for="check<?= $i ?>"> &nbsp;<?= $i ?></label>
                                            </div>
                                        <?php $p++;
                                        }
                                        ?>
                                    </div>
                                </div>



                                <?php /*
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4  text-lg-right">
                                        <span class="text-danger">*</span> Tahun
                                    </label>
                                    <div class="input-group col-md-8">
                                        <select class="form-control select2 tahun" name="tahun[]" multiple="multiple" id="tahun">
                                            <?php $y = date('Y');
                                            $x = $y - 3;
                                            for ($i = $y; $i >= $x; $i--) {
                                                echo '<option>' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                */ ?>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-lg-right">
                                        Cuti Bertahap <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" type="radio" <?= $bertahap == '0' ? 'checked' : ''; ?> name="bertahap" id="inlineRadio1" value="0">
                                            <label class="form-check-label" for="inlineRadio1">Tidak</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" <?= $bertahap == '1' ? 'checked' : ''; ?> name="bertahap" id="inlineRadio2" value="1">
                                            <label class="form-check-label" for="inlineRadio2">Ya</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="normal">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            <span class="text-danger">*</span> Tanggal Mulai
                                        </label>
                                        <div class="input-group col-md-8">

                                            <input type="text" class="form-control dateEntry" required="true" name="cuti_mulai" id="cuti_mulai" value="<?= $cuti_mulai ?>" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            <span class="text-danger">*</span> Tanggal Selesai
                                        </label>
                                        <div class="input-group col-md-8">

                                            <input type="text" class="form-control dateEntry" required="true" name="cuti_selesai" id="cuti_selesai" value="<?= $cuti_selesai ?>" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            <span class="text-danger">*</span> Lama Cuti (Hari Kerja)
                                        </label>
                                        <div class="input-group col-md-8">
                                            <input type="text" class="form-control" onkeyup="angka(this);" name="jumlah_hari" id="jumlah_hari" value="<?= $jumlah_hari ?>" placeholder="" />
                                        </div>
                                    </div>
                                    <?php /*
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            <span class="text-danger">*</span> Keterangan
                                        </label>
                                        <div class="input-group col-md-8">
                                            <textarea class="form-control" name="keterangan" id="keterangan" placeholder="" /><?= $keterangan ?></textarea>
                                        </div>
                                    </div>
                                    */ ?>
                                </div>
                                <div id="tahap1" style="display: none;">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            Tahap 1
                                        </label>
                                        <div class="input-group col-md-8"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            <span class="text-danger">*</span> Tanggal Mulai
                                        </label>
                                        <div class="input-group col-md-8">

                                            <input type="text" class="form-control dateEntry" required="true" name="cuti_mulai_1" id="cuti_mulai_1" value="<?= $cuti_mulai ?>" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            <span class="text-danger">*</span> Tanggal Selesai
                                        </label>
                                        <div class="input-group col-md-8">

                                            <input type="text" class="form-control dateEntry" required="true" name="cuti_selesai_1" id="cuti_selesai_1" value="<?= $cuti_selesai ?>" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            <span class="text-danger">*</span> Lama Cuti (Hari Kerja)
                                        </label>
                                        <div class="input-group col-md-8">
                                            <input type="text" class="form-control" onkeyup="angka(this);" name="jumlah_hari_1" id="jumlah_hari_1" value="<?= $jumlah_hari ?>" placeholder="" />
                                        </div>
                                    </div>
                                    <?php /*
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            <span class="text-danger">*</span> Keterangan
                                        </label>
                                        <div class="input-group col-md-8">
                                            <textarea class="form-control" name="keterangan" id="keterangan_1" placeholder="" /><?= $keterangan ?></textarea>
                                        </div>
                                    </div>
                                    */ ?>
                                    <hr>
                                </div>
                                <div id="tahap2" style="display: none;">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            Tahap 2
                                        </label>
                                        <div class="input-group col-md-8"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            <span class="text-danger"></span> Tanggal Mulai
                                        </label>
                                        <div class="input-group col-md-8">

                                            <input type="text" class="form-control dateEntry" required="true" name="cuti_mulai_2" id="cuti_mulai_2" value="<?= $cuti_mulai_2 ?>" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            <span class="text-danger"></span> Tanggal Selesai
                                        </label>
                                        <div class="input-group col-md-8">

                                            <input type="text" class="form-control dateEntry" required="true" name="cuti_selesai_2" id="cuti_selesai_2" value="<?= $cuti_selesai_2 ?>" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            <span class="text-danger"></span> Lama Cuti (Hari Kerja)
                                        </label>
                                        <div class="input-group col-md-8">
                                            <input type="text" class="form-control" onkeyup="angka(this);" name="jumlah_hari_2" id="jumlah_hari_2" value="<?= $jumlah_hari_2 ?>" placeholder="" />
                                        </div>
                                    </div>
                                    <?php /*
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4  text-lg-right">
                                            <span class="text-danger"></span> Keterangan
                                        </label>
                                        <div class="input-group col-md-8">
                                            <textarea class="form-control" name="keterangan_2" id="keterangan_2" placeholder="" /><?= $keterangan_2 ?></textarea>
                                        </div>
                                    </div>
                                    */ ?>
                                </div>
                                <hr>
                                <?php
                                foreach ($berkas->result() as $item) : ?>
                                    <div class="form-group row" id="row_berkas<?= $item->berkas_id ?>" <?= $item->berkas_id == '4' ? 'style="display: none;"' : ''; ?> >
                                        <label class="col-form-label col-md-4 text-lg-right">
                                            <span class="text-red">*</span> <?= $item->berkas_nama ?> <span>(Pdf/JPG Maks. 2MB)</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="file" style="padding: .175rem 0.75rem" class="form-control" accept="application/pdf" name="berkas_<?= $item->berkas_id ?>" id="berkas_<?= $item->berkas_id ?>" value="" placeholder="" />
                                        </div>
                                        <?php if ($pegawaicuti_id != '') : ?>
                                            <label class="col-form-label col-md-4 text-lg-right">
                                            </label>
                                            <div class="col-md-8">
                                                <?php foreach ($berkas_cuti as $key) : ?>
                                                    <?php if ($key['berkas_id'] == $item->berkas_id) : ?>
                                                        <a href="<?= base_url('assets/files/cuti/' . $key['url_file']) ?>" class="btn btn-sm btn-grey" target="_blank"><i class="fa fa-download"></i> <small>Unduh <?= $item->berkas_nama ?></small></a>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <button type="button" class="btn btn-grey" onclick="history.go(-1)">Batal</button>
                                            <button type="button" id="kirim" class="btn btn-primary m-r-5"><?= empty($pegawaicuti_id) ? 'Ajukan' : 'Perbarui'; ?></button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel-body -->
                </div>
            </div>
        </div>
        <!-- end container -->
    </div>

    <div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="loader"></div>
                    <div clas="loader-txt">
                        <p>Sedang memuat.. </p>
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery 3 -->

    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- jQuery UI 1.11.4 -->

    <script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>assets/sweetalert/sweetalert2.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/date-text/jquery.datetextentry.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert.css">
<script src="<?= base_url() ?>assets/sweetalert/sweetalert.min.js"></script>
    <script>
        $('.dateEntry').datetextentry({
            show_tooltips: false,
            errorbox_x: -135,
            errorbox_y: 28
        });

        function angka(e) {
            if (!/^[0-9]+$/.test(e.value)) {
                e.value = e.value.substring(0, e.value.length - 1);
            }

        }
    	
    
        $(document).ready(function() {
            $('.select2').select2({
                multiple: true,
            });
        
        	<?php if($this->session->flashdata('message') != NULL) { ?>
                swal({
                  type: 'error',
                  title: '',
                  text: '<?= $this->session->flashdata('message') ?>',
                  // footer: '<a href>Why do I have this issue?</a>'
                })
        	<?php } ?>


            if ($('#inlineRadio2').is(':checked')) {
                $('#tahap1').show();
                $('#tahap2').show();
                $('#normal').hide();

            }
            if ($('#inlineRadio1').is(':checked')) {
                $('#tahap1').hide();
                $('#tahap2').hide();
                $('#normal').show();
            }

            $('#inlineRadio2').click(function() {

                if ($('#inlineRadio2').is(':checked')) {
                    $('#tahap1').show();
                    $('#tahap2').show();
                    $('#normal').hide();

                }
            })

            $('#inlineRadio1').click(function() {

                if ($('#inlineRadio1').is(':checked')) {
                    $('#tahap1').hide();
                    $('#tahap2').hide();
                    $('#normal').show();
                }
            })

            $('#jeniscuti_id').on('change', function(){
              if($(this).val() == '3'){
                $('#row_berkas4').show();
              }else{
                $('#row_berkas4').hide();
              }
            })

            <?php if (!empty($tahun)) : ?>
                var selectedValues = new Array();
                <?php for ($i = 0; $i < count($tahun); $i++) : ?>
                    selectedValues[<?= $i ?>] = '<?= $tahun[$i] ?>';
                <?php endfor; ?>

                $('.tahun').val(selectedValues).trigger('change');

            <?php endif; ?>


            $('#kirim').on('click', function() {
				
		var jenis = document.getElementById("jeniscuti_id").value;
		if (jenis != "" ) {
        	console.log('ok')
		}else{
                swal({
                  type: 'error',
                  title: '',
                  text: 'Isian Form Tidak Lengkap',
                  // footer: '<a href>Why do I have this issue?</a>'
                })
        return false;
		}
 
        if (document.getElementById('inlineRadio1').checked) {
        
        	var cuti_mulai = document.getElementById("cuti_mulai").value;
			var cuti_selesai = document.getElementById("cuti_selesai").value;
			var jumlah_hari = document.getElementById("jumlah_hari").value;
        
			if (cuti_mulai != "" && cuti_selesai != ""  && jumlah_hari != "" ) {
        	console.log('ok')
			}else{
                swal({
                  type: 'error',
                  title: '',
                  text: 'Isian Form Tidak Lengkap',
                  // footer: '<a href>Why do I have this issue?</a>'
                })
        return false;
			}
		}
 
        if (document.getElementById('inlineRadio2').checked) {
        
        	var cuti_mulai_1 = document.getElementById("cuti_mulai_1").value;
			var cuti_selesai_1 = document.getElementById("cuti_selesai_1").value;
			var jumlah_hari_1 = document.getElementById("jumlah_hari_1").value;
        
			if (cuti_mulai_1 != "" && cuti_selesai_1 != ""  && jumlah_hari_1 != "" ) {
        	console.log('ok')
			}else{
                swal({
                  type: 'error',
                  title: '',
                  text: 'Isian Form Tidak Lengkap',
                  // footer: '<a href>Why do I have this issue?</a>'
                })
        return false;
			}
		}
        
         var jenis = $('#jeniscuti_id').val();
        <?php   foreach ($berkas->result() as $item) : ?>
		var berkas_<?= $item->berkas_id ?> = document.getElementById("berkas_<?= $item->berkas_id ?>").value;
        if('<?= $item->berkas_id ?>' != '4' || jenis == '3'){
		if (berkas_<?= $item->berkas_id ?> != "") {
        	console.log('ok')
		}else{
                swal({
                  type: 'error',
                  title: '',
                  text: 'Berkas Tidak Lengkap',
                  // footer: '<a href>Why do I have this issue?</a>'
                })
        return false;
		}
        }
        <?php endforeach; ?>
            
                $("#loadMe").modal({
                    backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true //Display loader!
                });
// return false;
                $('#form-cuti').submit();
            })

        })
    </script>