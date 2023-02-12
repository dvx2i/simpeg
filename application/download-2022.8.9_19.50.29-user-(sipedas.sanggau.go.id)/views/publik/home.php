<link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert2.css">
<style>
    form {
        max-width: 400px;
        position: relative;
        /* margin: 50px auto 0; */
        font-size: 15px;
    }

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
                <img class="logo-simpeg" height="160px" src="<?= base_url('assets/publik') ?>/img/logo-2021.png" alt="">
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


<!-- begin #pricing -->
<div class="content" data-scrollview="true">
    <!-- begin container -->
    <div class="">
        <h2 class="content-title">Susunan Organisasi</h2>
        <!-- <p class="content-desc">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
					sed bibendum turpis luctus eget
				</p> -->
        <div class="row">
            <div class="col-lg-12">
                <div id="struktur" class="card">
                    <div class="card-header">
                        <form action="">

                            <div class="form-group">
                                <label>Unit Kerja</label>
                                <select class="form-control select2" id="pegawai_unit_id" name="pegawai_unit_id">
                                    <!--                                                     <option value="">-- PILIH --</option> -->
                                    <?php
                                    foreach ($unit_bagan->result() as $value) {
                                        if (empty($value->unit_parent_id)) {
                                            $bold = $value->unit_nama;
                                        }
                                    ?>

                                        <option <?= (isset($where['pegawai_unit_id'])) ? selected($value->unit_id, $where['pegawai_unit_id']) : ''; ?> value="<?= $value->unit_id ?>"><?= $bold ?></option>';
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <button type="button" class="btn btn-success btn-sm float-right" id="bagan">Tampilkan</button>
                        </form>
                    </div>
                    <div style="">
                        <div class="card-body">
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
                                    OrgChart.templates.header.size = [400, 50];
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
                                                        footer: 'sipedas.sanggau.go.id',
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
                                                        // photo1: "<?= 'http://sipedas.sanggau.go.id/' . $fotokpe ?>",
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


                                    chart.editUI.on('show', function(sender, nodeId) {
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
            </div>
        </div>
    </div>
</div>


<!-- begin #pricing -->
<div id="pegawai" class="content" data-scrollview="true">
    <!-- begin container -->
    <div class="container">
        <h2 class="content-title">Cari Pegawai</h2>
        <!-- <p class="content-desc">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
					sed bibendum turpis luctus eget
				</p> -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="input-group mb-3 mt-3">
                            <input type="text" id="nip" class="form-control" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" id="cari-pegawai" type="button">Cari</button>
                                <button class="btn btn-danger" id="reset-pegawai" type="button">Reset</button>
                            </div>
                        </div>
                    </div>
                    <div id="detail-pegawai">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- begin #pricing -->
<div id="price" class="content" data-scrollview="true">
    <!-- begin container -->
    <div class="">
        <h2 class="content-title">Grafik Data Kepegawaian</h2>
        <!-- <p class="content-desc">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
					sed bibendum turpis luctus eget
				</p> -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Grafik PNS Berdasarkan Pendidikan (<?= bulan_indo()[$bulan] . '-' . $tahun ?>)</div>
                    <div style="">
                        <div class="card-body">
                            <div id="chart_pendidikan"></div>
                            <center>
                                <a href="<?= site_url('publik/PegawaiPendidikan') ?>" class="btn btn-grey">Selengkapnya</a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Grafik PNS Berdasarkan Jenis Kelamin (<?= bulan_indo()[$bulan] . '-' . $tahun ?>)</div>
                    <div style="">
                        <div class="card-body">
                            <div id="chart_jk"></div>
                            <center>
                                <a href="<?= site_url('publik/PegawaiJk') ?>" class="btn btn-grey">Selengkapnya</a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="col-lg-4 ">
                <div class="card">
                    <div class="card-header">Grafik PNS Berdasarkan Golongan (<?= bulan_indo()[$bulan] . '-' . $tahun ?>)</div>
                    <div style="">
                        <div class="card-body">
                            <div id="chart_golru"></div>
                            <center>
                                <a href="<?= site_url('publik/PegawaiGolru') ?>" class="btn btn-grey">Selengkapnya</a>
                            </center>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        &nbsp;
        <div class="row">
            <div class="col-lg-6 offset-lg-3 ">
                <div class="card">
                    <div class="card-header">Grafik PNS Berdasarkan Golongan (<?= bulan_indo()[$bulan] . '-' . $tahun ?>)</div>
                    <div style="">
                        <div class="card-body">
                            <div id="chart_golru"></div>
                            <center>
                                <a href="<?= site_url('publik/PegawaiGolru') ?>" class="btn btn-grey">Selengkapnya</a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end container -->
</div>
<!-- end #pricing -->
<div class="content bg-silver-lighter" data-scrollview="true">
    <!-- begin container -->
    <div class="fadeInDown contentAnimated finishAnimated" data-animation="true" data-animation-type="fadeInDown">
        <!-- <h2 class="content-title">Statistik Pengunjung &amp; Polling Kepuasan</h2> -->
        <!-- begin row -->
        <div class="row">
            <div class="col-lg-4">
                <h3>Statistik Pengunjung</h3>

                <table class="table table-bordered table-stripped" style="
        max-width: 400px;">
                    <tr>

                        <td>Pengunjung Hari ini</td>


                        <td><?php echo $pengunjunghariini ?> orang</td>

                    </tr>

                    <tr>

                        <td>Total Pengunjung</td>


                        <td><?php echo $totalpengunjung ?> orang</td>

                    </tr>

                    <tr>

                        <td>Pengunjung Online</td>


                        <td><?php echo $pengunjungonline ?> orang</td>

                    </tr>

                </table>
            </div>
            <!-- end col-6 -->
            <!-- begin col-6 -->
            <div class="col-lg-4">
                <form action="<?= site_url('Home/polling') ?>" id="form-kepuasan" method="POST">
                    <div id="form-polling">
                        <h3>Polling Kepuasan</h3>

                        <div class="radiobtn">
                            <input type="radio" id="radio1" name="polling" value="1" />
                            <label for="radio1">Sangat Puas</label>
                        </div>
                        <div class="radiobtn">
                            <input type="radio" id="radio2" name="polling" value="2" />
                            <label for="radio2">Cukup Puas</label>
                        </div>
                        <div class="radiobtn">
                            <input type="radio" id="radio3" name="polling" value="3" />
                            <label for="radio3">Puas</label>
                        </div>
                        <div class="radiobtn">
                            <input type="radio" id="radio4" name="polling" value="4" />
                            <label for="radio4">Kurang Puas</label>
                        </div>
                    </div>
                    <div id="form-kritik" style="display: none;">
                        <h3>Kritik & Saran</h3>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Kritik & Saran</label>
                            <input type="text" id="kritik" name="kritik" class="form-control" />
                        </div>
                    </div>
                    <div>
                        <button type="button" id="btn-kirim" class="btn btn-success">Kirim</button>
                        <button type="button" id="btn-kritik" class="btn btn-success">Kritik & Saran</button>
                        <button type="button" style="display: none;" id="btn-polling" class="btn btn-success">Polling Kepuasan</button>
                    </div>

                </form>
            </div>
            <!-- end col-6 -->
            <div class="col-lg-4">
                <div>
                    <h3>Hasil Polling</h3>
                    <label>Sangat Puas</label>
                    <div class="progress mb-2">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"  role="progressbar" aria-valuenow="<?= $polling->sangat_puas ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $polling->sangat_puas ?>%"> </div>
                    </div>
                    <label>Cukup Puas</label>
                    <div class="progress mb-2">
                        <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" aria-valuenow="<?= $polling->cukup_puas ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $polling->cukup_puas ?>%"> </div>
                    </div>
                    <label>Puas</label>
                    <div class="progress mb-2">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="<?= $polling->puas ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $polling->puas ?>%"> </div>
                    </div>
                    <label>Kurang Puas</label>
                    <div class="progress mb-2">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"  role="progressbar" aria-valuenow="<?= $polling->kurang_puas ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $polling->kurang_puas ?>%"> </div>
                    </div>
                </div>
            </div>
            <!-- end col-6 -->

        </div>
    </div>
    <!-- end container -->
</div>

<!-- jQuery 3 -->

<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->

<script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- <script src="<?= base_url() ?>assets/plugins/TableToExcel/jquery.tableToExcel.js"></script> -->
<script src="<?= base_url() ?>assets/plugins/highcharts/highcharts.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/highcharts-3d.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/data.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/drilldown.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/exporting.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/export-data.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/accessibility.js"></script>
<script src="<?= base_url() ?>assets/sweetalert/sweetalert2.js"></script>

<script>
    // console.log(Highcharts.char

    colChart1 = {
        chart: {
            type: 'column',
            // inverted: true,
            height: 400,
            options3d: {
                enabled: false,
                alpha: 15,
                beta: 15,
                depth: 50,
                viewDistance: 25
            }
        },
        title: {
            text: 'Jumlah PNS Menurut Pendidikan  <?= $unit != null ? $unit : ''; ?>'
        },
        subtitle: {
            text: 'sipedas.sanggau.go.id</a>'
        },
        xAxis: {
            type: 'category',
        },
        yAxis: {
            title: {
                text: 'Total Pegawai'
            }

        },
        legend: {
            enabled: true
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: false,
                    // format: '{point.y:.1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> <br/>'
        },
        series: [{
            name: 'Laki-laki & Perempuan',
            type: 'column',
            color: '#84c31e',
            data: [

                <?php foreach ($rekap_pendidikan->result_array() as $key) : ?> {
                        name: "<?= $key['pendidikan'] ?>",
                        y: <?= $key['jumlah'] ?>,
                        drilldown: false
                    },
                <?php endforeach; ?>
            ]
        }]
    };

    colChart2 = {
        chart: {
            type: 'column',
            // inverted: true,
            height: 400,
            options3d: {
                enabled: false,
                alpha: 15,
                beta: 15,
                depth: 50,
                viewDistance: 25
            }
        },
        title: {
            text: 'Jumlah PNS Menurut Golongan  <?= $unit != null ? $unit : ''; ?>'
        },
        subtitle: {
            text: 'sipedas.sanggau.go.id</a>'
        },
        xAxis: {
            type: 'category',
        },
        yAxis: {
            title: {
                text: 'Total Pegawai'
            }

        },
        legend: {
            enabled: true
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: false,
                    // format: '{point.y:.1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> <br/>'
        },
        series: [{
            name: 'Laki-laki & Perempuan',
            type: 'column',
            color: '#84c31e',
            data: [

                <?php foreach ($rekap_golru->result_array() as $key) : ?> {
                        name: "<?= $key['golru'] ?>",
                        y: <?= $key['jumlah'] ?>,
                        drilldown: false
                    },
                <?php endforeach; ?>
            ]
        }]
    };

    colChart3 = {
        chart: {
            type: 'pie',
            // inverted: true,
            height: 400,
            options3d: {
                enabled: true,
                alpha: 45,
                // beta: 0
            }
        },
        title: {
            text: 'Jumlah PNS Menurut Jenis Kelamin <?= $unit != null ? $unit : ''; ?>'
        },
        subtitle: {
            text: 'sipedas.sanggau.go.id</a>'
        },
        xAxis: {
            type: 'category',
        },
        yAxis: {
            title: {
                text: 'Total Pegawai'
            }

        },
        legend: {
            enabled: true
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    // format: '{point.y:.1f}'
                }
            },
            pie: {
                innerSize: 80,
                depth: 45,
                colors: ['#0a00fb',
                    '#fe7101'

                ],
            }

        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> <br/>'
        },
        series: [{
            name: 'Laki-laki & Perempuan',
            data: [

                <?php foreach ($rekap_jk->result_array() as $key) : ?> {
                        name: "<?= $key['jk'] ?>",
                        y: <?= $key['jumlah'] ?>,
                        drilldown: false
                    },
                <?php endforeach; ?>
            ]
        }]
    };

    // create the chart
    $('#chart_jk').highcharts($.extend(true, {}, colChart3));
    $('#chart_pendidikan').highcharts($.extend(true, {}, colChart1));
    $('#chart_golru').highcharts($.extend(true, {}, colChart2));

    <?php if ($where['pegawai_unit_id'] != '2') : ?>
        $(document).ready(function() {
            window.location.hash = '#struktur';
        })
    <?php endif; ?>


    $(document).on('click', '#bagan', function() { //Cetak BY name
        var form = "<form id='hidden-form' action='<?= site_url('Home/index') ?>' method='post'>";

        form += "<input type='hidden' name='pegawai_unit_id' value='" + $('#pegawai_unit_id').val() + "'/>";
        form += "<input type='hidden' name='bagan' value='bagan'/>";

        $(form + "</form>").appendTo($(document.body)).submit();
    });


    $('#cari-pegawai').on('click', function() {
        $.ajax({
            url: '<?= site_url('Home/pegawai_detail') ?>',
            type: "POST",
            data: {
                nip: $('#nip').val(),
            },
            success: function(data) {
                $('#detail-pegawai').html(data);
            }
        });
    });

    $('#reset-pegawai').on('click', function() {
        $('#nip').val('');
        $.ajax({
            url: '<?= site_url('Home/pegawai_detail') ?>',
            type: "POST",
            data: {
                nip: $('#nip').val(),
            },
            success: function(data) {
                $('#detail-pegawai').html('');
            }
        });
    });
    
    $('#btn-kirim').on('click', function() {
       var kritik = $('#kritik').val();
       if(kritik != ''){
            swal({
                title: "",
                text: "Kirim Kritik & Saran?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Kirim',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.value) {
                    $('#form-kepuasan').submit();
                }
            });
       }else{
            swal({
                title: "",
                text: "Kirim Polling?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Kirim',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.value) {
                    $('#form-kepuasan').submit();
                }
            });
       }
    });

    <?php if($sudah_polling->jumlah > 0) : ?>
        $('#btn-kritik').hide();
        $('#form-kritik').show();
        $('#btn-polling').hide();
        $('#form-polling').hide();
    <?php endif; ?>

    $('#btn-kritik').on('click', function() {
        // alert('kritik')
        $('#btn-polling').show();
        $('#form-polling').hide();
        $('#btn-kritik').hide();
        $('#form-kritik').show();
    });

    $('#btn-polling').on('click', function() {
        // alert('polling')
        $('#btn-kritik').show();
        $('#form-kritik').hide();
        $('#btn-polling').hide();
        $('#form-polling').show();
    });
    
<?php if($this->session->userdata('message') <> '') : ?>
  $(document).ready(function(){
    
    swal({
            type: 'info',
            title: '',
            text: '<?= $this->session->userdata('message') ?>',
            // footer: '<a href>Why do I have this issue?</a>'
          });
  });
  <?php endif; ?>
</script>