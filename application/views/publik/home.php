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
                    <link rel="stylesheet" href="<?= base_url('assets/plugins/abkchart') ?>/style_bagan_home.css">
    <style>
        #div_bagan.fullscreen{
    z-index: 9999; 
    width: 100%; 
    height: 100%; 
    position: fixed; 
    top: 0; 
    left: 0; 
 }
    </style>

            <div class="row" id="div_bagan">
                <div class="col-md-12">
                    <div class="box">

                    <!-- <button type="button" class="btn btn-sm" id="full"><i class="fa fa-fullscreen"></i> </button> -->
                                            <!-- <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div> -->

                        <div class="box-body ">

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

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">

                                        <div class="box-header with-border">
                                        </div>

                                        <div class="box-body table-responsive">
                                            <div id="html-content">
                                                <figure>
                                                    <!-- <figcaption>PETA JABATAN BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</figcaption> -->
                                                    <div class="orgchart" style="font-size: 0.6rem">
                                                        <!-- LEVEL 1 -->
                                                        <ul class="nodes">
                                                            
                                            <?php 
                                                $is_assistant = $is_assistant->num_rows();
                                                $i      = 0;
                                            ?>
                                            <?php foreach($bagan as $level1) : ?> 

                                                <?php $i++; ?>
                                                <?php if($level1['bagan_level'] == '1') : ?>

                                                    <?php 
                                                    $fotokpe = 'assets/images/user.jpg';

                                                    $JPG = str_replace('.jpg', '.JPG',  $level1['pegawai_foto_kpe']);
                                                    if (!blank($level1['pegawai_foto_kpe'])) {
                                                        if (file_exists(('assets/images/' . $level1['pegawai_foto_kpe']))) {
                                                            $fotokpe = 'assets/images/' . $level1['pegawai_foto_kpe'];
                                                        } else if (file_exists(('assets/images/' . $JPG))) {
                                                            $fotokpe = 'assets/images/' . $JPG;
                                                        } else {
                                                            $foto = str_replace(".jpg", ".jpeg", $level1['pegawai_foto_kpe']);
                                                            if (file_exists(('assets/images/' . $foto))) {
                                                                $fotokpe = 'assets/images/' . $foto;
                                                            }
                                                        }
                                                    } ?>

                                                    <li>
                                                    
                                                    <?php if($level1['bagan_is_assistant'] == '1' ) { ?>

                                                            <assistant>
                                                            <div class="bagan">
                                                                <table width="340px">
                                                                    <tbody>
                                                                        <tr>
                                                                        <td rowspan="2" width="35%"><img width="113" height="149" src="<?= base_url($fotokpe) ?>" alt=""></td>
                                                                        <td class="title-chart"  colspan="2"><?= $level1['jabatan_nama'] ?></td>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2">
                                                                                <?php if(!empty($level1['pegawai_nip'])) { ?>
                                                                                <table  width="100%" class="border-none">
                                                                                <tr><td> <b><?= $level1['pegawai_nama'] ?></b>	<br>
                                                                                    NIP : <?= $level1['pegawai_nip'] ?>		<br>
                                                                                    TTL : <?= $level1['pegawai_tempat_lahir'] ?>, <?= date('d-m-Y', strtotime($level1['pegawai_tgl_lahir'])) ?>		<br>
                                                                                    TMT. JAB : <?= date('d-m-Y', strtotime($level1['pegawai_jabatan_tmt'])) ?>			<br>
                                                                                    GOL. : <?= $level1['pegawai_pangkat_terakhir_golru'] ?>, TMT : <?= date('d-m-Y', strtotime($level1['pegawai_pangkat_terakhir_tmt'])) ?> 	<br>	
                                                                                    
                                                                                    </td></tr>
                                                                                </table>
                                                                                <?php } else { ?>
                                                                                    <h3>LOWONG</h3>
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            </assistant>

                                                            <?php } elseif($level1['bagan_is_bupati'] == '1') { ?> 

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
                                                                
                                                            <span  id="parent">
                                                            <div class="bagan">
                                                                <table width="500px">
                                                                <tbody>
                                                                    <tr>
                                                                    <td rowspan="2" width="20%" style="height: 149px;"><img width="113" height="149" src="<?= base_url($fotobup) ?>" alt=""></td>
                                                                    <td class="title-chart">BUPATI / WAKIL BUPATI</td>
                                                                    <td rowspan="2" width="20%" style="height: 149px;"><img width="113" height="149" src="<?= base_url($fotowabup) ?>" alt=""></td>

                                                                    </tr>
                                                                    <tr>
                                                                            <td> <b><?= $level1['bagan_bupati_nama'] ?></b> <br><br>
                                                                                 <b><?= $level1['bagan_wabupati_nama'] ?></b> <br>
                                                                    </td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                            </div>
                                                            </span>
                                                            
                                                            <?php } else { ?> 

                                                                <span  id="parent">
                                                                    <div class="bagan">
                                                                        <table width="340px" >
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td rowspan="2" width="35%"><img width="113" height="149" src="<?= base_url($fotokpe) ?>" alt=""></td>
                                                                                    <td class="title-chart" colspan="2"><?= $level1['jabatan_nama'] ?></td>

                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                <?php if(!empty($level1['pegawai_nip'])) { ?>
                                                                                        <table width="100%" class="border-none">
                                                                                        <tr><td> <b><?= $level1['pegawai_nama'] ?></b>	<br>
                                                                                            NIP : <?= $level1['pegawai_nip'] ?>		<br>
                                                                                            TTL : <?= $level1['pegawai_tempat_lahir'] ?>, <?= date('d-m-Y', strtotime($level1['pegawai_tgl_lahir'])) ?>		<br>
                                                                                            TMT. JAB : <?= date('d-m-Y', strtotime($level1['pegawai_jabatan_tmt'])) ?>			<br>
                                                                                            GOL. : <?= $level1['pegawai_pangkat_terakhir_golru'] ?>, TMT : <?= date('d-m-Y', strtotime($level1['pegawai_pangkat_terakhir_tmt'])) ?> 	<br>	
                                                                                            
                                                                                            </td></tr>
                                                                                        </table>
                                                                                <?php } else { ?>
                                                                                    <h3>LOWONG</h3>
                                                                                <?php } ?>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </span>
                                                            <?php } ?>

                                                                
                                                            <?php if($is_assistant > 0 && $i == 1) : ?>
                                                            <ul class="connector">
                                                                <li></li>
                                                            </ul>
                                                            <?php endif; ?>

                                                                <!-- LEVEL 2 -->
                                                                <ul class="<?= $is_assistant > 0 && $i == 1 ? 'after-assistant' : ''; ?>">

                                                                
                                                                <?php foreach($bagan as $level2) : ?>
                                                                    <!-- CLASS warna sesuai jumlah abk -->
                                                                <?php if($level2['bagan_level'] == '2' && $level1['bagan_id'] == $level2['bagan_parent_id'] ) : ?>
                                                                    
                                                                    
                                                    <?php 
                                                    $fotokpe = 'assets/images/user.jpg';

                                                    $JPG = str_replace('.jpg', '.JPG',  $level2['pegawai_foto_kpe']);
                                                    if (!blank($level2['pegawai_foto_kpe'])) {
                                                        if (file_exists(('assets/images/' . $level2['pegawai_foto_kpe']))) {
                                                            $fotokpe = 'assets/images/' . $level2['pegawai_foto_kpe'];
                                                        } else if (file_exists(('assets/images/' . $JPG))) {
                                                            $fotokpe = 'assets/images/' . $JPG;
                                                        } else {
                                                            $foto = str_replace(".jpg", ".jpeg", $level2['pegawai_foto_kpe']);
                                                            if (file_exists(('assets/images/' . $foto))) {
                                                                $fotokpe = 'assets/images/' . $foto;
                                                            }
                                                        }
                                                    } ?>

                                                                    <li>
                                                                        <span>
                                                                            <div class="bagan">
                                                                                <table width="340px">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td rowspan="2" width="35%"><img width="113" height="149" src="<?= base_url($fotokpe) ?>" alt=""></td>
                                                                                            <td class="title-chart" colspan="2"><?= $level2['jabatan_nama'] ?></td>

                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2">
                                                                                <?php if(!empty($level2['pegawai_nip'])) { ?>
                                                                                                <table width="100%" class="border-none">
                                                                                                <tr><td> <b><?= $level2['pegawai_nama'] ?></b>	<br>
                                                                                                    NIP : <?= $level2['pegawai_nip'] ?>		<br>
                                                                                                    TTL : <?= $level2['pegawai_tempat_lahir'] ?>, <?= date('d-m-Y', strtotime($level2['pegawai_tgl_lahir'])) ?>		<br>
                                                                                                    TMT. JAB : <?= date('d-m-Y', strtotime($level2['pegawai_jabatan_tmt'])) ?>			<br>
                                                                                                    GOL. : <?= $level2['pegawai_pangkat_terakhir_golru'] ?>, TMT : <?= date('d-m-Y', strtotime($level2['pegawai_pangkat_terakhir_tmt'])) ?> 	<br>	
                                                                                                    
                                                                                                    </td></tr>
                                                                                                </table>
                                                                                <?php } else { ?>
                                                                                    <h3>LOWONG</h3>
                                                                                <?php } ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </span>

                                                                        <!-- LEVEL 3 -->
                                                                        <ul>

                                                                        <?php foreach($bagan as $level3) : ?>

                                                                            <?php if($level3['bagan_level'] == '3' && $level2['bagan_id'] == $level3['bagan_parent_id'] ) : ?>
                                                                            
                                                    <?php 
                                                    $fotokpe = 'assets/images/user.jpg';

                                                    $JPG = str_replace('.jpg', '.JPG',  $level3['pegawai_foto_kpe']);
                                                    if (!blank($level3['pegawai_foto_kpe'])) {
                                                        if (file_exists(('assets/images/' . $level3['pegawai_foto_kpe']))) {
                                                            $fotokpe = 'assets/images/' . $level3['pegawai_foto_kpe'];
                                                        } else if (file_exists(('assets/images/' . $JPG))) {
                                                            $fotokpe = 'assets/images/' . $JPG;
                                                        } else {
                                                            $foto = str_replace(".jpg", ".jpeg", $level3['pegawai_foto_kpe']);
                                                            if (file_exists(('assets/images/' . $foto))) {
                                                                $fotokpe = 'assets/images/' . $foto;
                                                            }
                                                        }
                                                    } ?>
                                                                                <li>
                                                                                <span>
                                                                                    <div class="bagan">
                                                                                        <table width="340px">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td rowspan="2" width="35%"><img width="113" height="149" src="<?= base_url($fotokpe) ?>" alt=""></td>
                                                                                                <td class="title-chart" colspan="2"><?= $level3['jabatan_nama'] ?></td>

                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">
                                                                                <?php if(!empty($level3['pegawai_nip'])) { ?>
                                                                                                    <table width="100%" class="border-none">
                                                                                                    <tr><td> <b><?= $level3['pegawai_nama'] ?></b>	<br>
                                                                                                        NIP : <?= $level3['pegawai_nip'] ?>		<br>
                                                                                                        TTL : <?= $level3['pegawai_tempat_lahir'] ?>, <?= date('d-m-Y', strtotime($level3['pegawai_tgl_lahir'])) ?>		<br>
                                                                                                        TMT. JAB : <?= date('d-m-Y', strtotime($level3['pegawai_jabatan_tmt'])) ?>			<br>
                                                                                                        GOL. : <?= $level3['pegawai_pangkat_terakhir_golru'] ?>, TMT : <?= date('d-m-Y', strtotime($level3['pegawai_pangkat_terakhir_tmt'])) ?> 	<br>	
                                                                                                        
                                                                                                        </td></tr>
                                                                                                    </table>
                                                                                <?php } else { ?>
                                                                                    <h3>LOWONG</h3>
                                                                                <?php } ?>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </span>
                                                                            </li>

                                                                        <!-- <ul>

                                                                        <?php foreach($bagan as $level4) : ?>
                                                                        <?php if($level4['bagan_level'] == '4' && $level3['bagan_id'] == $level4['bagan_parent_id'] ) : ?>
                                                                              
                                                                            

                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                        </ul> -->
                                                                        <!-- END LEVEL 4 -->

                                                                    </li>
                                                                        <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                        </ul>
                                                                        <!-- END LEVEL 3 -->

                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php endforeach; ?>

                                                                </ul>
                                                                <!-- END LEVEL 2 -->

                                                            </li>
                                                            <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                        <!-- END LEVEL 1 -->
                                                    </div>
                                                </figure>

                                            </div>
                                            <!--                             <a href="javascript:genPDF()">Download PDF</a> -->
                                            <!-- <button type="butoon" onclick="CreatePDFfromHTML()" class="btn btn-primary"><i class="fa fa-print"></i>
                                                Cetak</button> -->

                                        </div>
                                    </div>
                                </div>
                            </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- begin #pricing -->
<div id="pegawai" class="content" data-scrollview="true" style="display:none;">
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