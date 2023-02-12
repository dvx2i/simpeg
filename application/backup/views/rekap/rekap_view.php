<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Rekap Jumlah Pegawai
        </h1>
    </section>

    <section class="content">
        <div class="row" id="filter">
            <div class="col-lg-12">
                <div class="panel panel-default">                    
                    <div class="panel-heading">
                        <i class="fa fa-search fa-fw"></i> Filter 
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?= site_url('rekap/RekapPns/view') ?>" method="post" >
                            <div class="form-group">
                                <div class="input-group-addon">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="btn btn-default">Tahun</div>
                                            </span>
                                            <select class="form-control " name="tahun" id="tahun" required="true">

                                                <?php
                                                $tahuns = array();
                                                
                                                foreach ($list_tahun->result() as $value) {
                                                    array_push($tahuns, $value->tahun);
                                                    ?>
                                                <option value="<?= $value->tahun ?>" <?= selected($value->tahun, $tahun, TRUE)?> ><?= $value->tahun ?></option>
                                                <?php } 
                                                if(!in_array(date('Y'),$tahuns)){
                                                        echo '<option value="'.date('Y').'" selected="selected" >'.date('Y').'</option>';
                                                    }
                                                ?>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="btn btn-default">Bulan</div>
                                            </span>
                                            <select class="form-control " name="bulan" id="bulan" required="true" >

                                                <?php
                                                $no=1;
                                                foreach (bulan_indo() as $value) {
                                                    ?>
                                                    <option value="<?= $no ?>" <?= selected($value, date('m'), TRUE)?>><?= ($value) ?></option>
                                                <?php $no++; } ?>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Tampilkan</button>
                                        <?php
                                        if($tahun == date('Y') && $bulan == date('m')){
                                        ?>
                                        <a href="<?= site_url('rekap/RekapPns/update')?>" type="button" class="btn btn-warning"><i class="fa fa-save fa-fw"></i> Update Rekap Terbaru</a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>

        <div class="row" id="filter">
            <div class="col-lg-12">
                <div class="panel panel-default">                    
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart fa-fw"></i> Grafik 
                    </div>
                    <div class="panel-body">
                        <button type="button" class="btn btn-success" onclick="tampil('agama')">AGAMA</button>
                        <button type="button" class="btn btn-success" onclick="tampil('golru')">GOLONGAN</button>
                        <button type="button" class="btn btn-success" onclick="tampil('kelamin')">KELAMIN</button>
                        <button type="button" class="btn btn-success" onclick="tampil('eselon')">ESELON</button>
                        <button type="button" class="btn btn-success" onclick="tampil('pendidikan')">PENDIDIKAN</button>
                        <button type="button" class="btn btn-success" onclick="tampil('jabatan')">JNS JABATAN</button>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>



        <div class="row hide" id="golru">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <a href="<?= site_url('rekap/RekapPns/excel/golru/' . $tahun . '/' . $bulan) ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Jumlah PNS Menurut Golongan Ruang (Laki-laki)                        
                    </div>
                    <div class="panel-body">
                        
                        <button type="button" class="btn btn-primary" >Laki-laki</button>
                        <button type="button" class="btn btn-default" onclick="tampil('golrup')">Perempuan</button>
                        
                        <br/><br/>
                        <canvas id="chart_golru" width="100" height="50"></canvas>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Golongan/Ruang</th>
                                        <th>Laki-laki</th>
                                        <th>Perempuan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <?php
                                    $no = 1;
                                    if (!empty($rekap_golru)) {
                                    	$lakigolru = 0;
                                    	$perempuangolru = 0;
                                    	$jumlahgolru = 0;
                                        foreach ($rekap_golru->result() as $value) {
                                        
                                    	$lakigolru += $value->laki;
                                    	$perempuangolru += $value->perempuan;
                                    	$jumlahgolru += $value->jumlah;
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value->golru ?></td>
                                                <td><?= $value->laki ?></td>
                                                <td><?= $value->perempuan ?></td>
                                                <td><?= $value->jumlah ?></td>                                       

                                            </tr>
                                            <?php
                                            $no++;
                                        } ?>
                                            <tr>
                                                <td colspan="2">Jumlah</td>
                                                <td><?= $lakigolru ?></td>
                                                <td><?= $perempuangolru ?></td>
                                                <td><?= $jumlahgolru ?></td>                                       

                                            </tr>
                                
                                <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
        
        <div class="row hide" id="golrup">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <a href="<?= site_url('rekap/RekapPns/excel/golru/' . $tahun . '/' . $bulan) ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Jumlah PNS Menurut Golongan Ruang (Perempuan)                        
                    </div>
                    <div class="panel-body">
                        <button type="button" class="btn btn-default" onclick="tampil('golru')">Laki-laki</button>
                        <button type="button" class="btn btn-success" >Perempuan</button>
                        <br/><br/>
                        <canvas id="chart_golrup" width="100" height="50"></canvas>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Golongan/Ruang</th>
                                        <th>Laki-laki</th>
                                        <th>Perempuan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                    $no = 1;
                                    if (!empty($rekap_golru)) {
                                    	$lakigolru = 0;
                                    	$perempuangolru = 0;
                                    	$jumlahgolru = 0;
                                        foreach ($rekap_golru->result() as $value) {
                                        
                                    	$lakigolru += $value->laki;
                                    	$perempuangolru += $value->perempuan;
                                    	$jumlahgolru += $value->jumlah;
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value->golru ?></td>
                                                <td><?= $value->laki ?></td>
                                                <td><?= $value->perempuan ?></td>
                                                <td><?= $value->jumlah ?></td>                                       

                                            </tr>
                                            <?php
                                            $no++;
                                        } ?>
                                            <tr>
                                                <td colspan="2">Jumlah</td>
                                                <td><?= $lakigolru ?></td>
                                                <td><?= $perempuangolru ?></td>
                                                <td><?= $jumlahgolru ?></td>                                       

                                            </tr>
                                
                                <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>

        <div class="row" id="agama">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <a href="<?= site_url('rekap/RekapPns/excel/agama/' . $tahun . '/' . $bulan) ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Jumlah PNS Menurut Agama 
                    </div>
                    <div class="panel-body">
                        <canvas id="chart_agama" width="100" height="50"></canvas>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Agama</th>
                                        <th>Laki-laki</th>
                                        <th>Perempuan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (!empty($rekap_agama)) {
                                    	$laki = 0;
                                    	$perempuan = 0;
                                    	$jumlah = 0;
                                        foreach ($rekap_agama->result() as $value) {
                                        
                                    	$laki += $value->laki;
                                    	$perempuan += $value->perempuan;
                                    	$jumlah += $value->jumlah;
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value->agama ?></td>
                                                <td><?= $value->laki ?></td>
                                                <td><?= $value->perempuan ?></td>
                                                <td><?= $value->jumlah ?></td>

                                            </tr>
                                            <?php
                                            $no++;
                                        } ?>
                                
                                            <tr>
                                                <td colspan="2">Jumlah</td>
                                                <td><?= $laki ?></td>
                                                <td><?= $perempuan ?></td>
                                                <td><?= $jumlah ?></td>                                       

                                            </tr>
                                <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>

        <div class="row hide" id="kelamin">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <a href="<?= site_url('rekap/RekapPns/excel/kelamin/' . $tahun . '/' . $bulan) ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Jumlah PNS Menurut Jenis Kelamin 
                    </div>
                    <div class="panel-body">
                        <canvas id="chart_kelamin" width="100" height="50"></canvas>
                        <div class="table-responsive">
                            
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (!empty($rekap_kelamin)) {
                                    	$jumlah = 0;
                                        foreach ($rekap_kelamin->result() as $value) {
                                    	$jumlah += $value->jumlah;
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value->jenis_kelamin ?></td>
                                                <td><?= $value->jumlah ?></td>

                                            </tr>
                                            <?php
                                            $no++;
                                        }?>
                                
                                            <tr>
                                                <td colspan="2">Jumlah</td>
                                                <td><?= $jumlah ?></td>                                       

                                            </tr>
                                <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>

        <div class="row hide" id="eselon">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <a href="<?= site_url('rekap/RekapPns/excel/eselon/' . $tahun . '/' . $bulan) ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Jumlah PNS Menurut Eselon 
                    </div>
                    <div class="panel-body">
                        <canvas id="chart_eselon" width="100" height="50"></canvas>
                        <div class="table-responsive">
                            
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Eselon</th>
                                        <th>Laki-laki</th>
                                        <th>Perempuan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (!empty($rekap_eselon)) {
                                    	$laki = 0;
                                    	$perempuan = 0;
                                    	$jumlah = 0;
                                        foreach ($rekap_eselon->result() as $value) {
                                    	$laki += $value->laki;
                                    	$perempuan += $value->perempuan;
                                    	$jumlah += $value->jumlah;
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value->eselon ?></td>
                                                <td><?= $value->laki ?></td>
                                                <td><?= $value->perempuan ?></td>
                                                <td><?= $value->jumlah ?></td>

                                            </tr>
                                            <?php
                                            $no++;
                                        }?>
                                
                                            <tr>
                                                <td colspan="2">Jumlah</td>
                                                <td><?= $laki ?></td>
                                                <td><?= $perempuan ?></td>
                                                <td><?= $jumlah ?></td>                                       

                                            </tr>
                                <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>

        <div class="row hide" id="pendidikan">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <a href="<?= site_url('rekap/RekapPns/excel/pendidikan/' . $tahun . '/' . $bulan) ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Jumlah PNS Menurut Tingkat Pendidikan 
                    </div>
                    <div class="panel-body">
                        <canvas id="chart_pendidikan" width="100" height="50"></canvas>
                        <div class="table-responsive">
                            
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tingkat Pendidikan</th>
                                        <th>Laki-laki</th>
                                        <th>Perempuan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (!empty($rekap_pendidikan)) {
                                    $laki = 0;
                                    	$perempuan = 0;
                                    	$jumlah = 0;
                                        foreach ($rekap_pendidikan->result() as $value) {
                                    	$laki += $value->laki;
                                    	$perempuan += $value->perempuan;
                                    	$jumlah += $value->jumlah;
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value->pendidikan ?></td>
                                                <td><?= $value->laki ?></td>
                                                <td><?= $value->perempuan ?></td>
                                                <td><?= $value->jumlah ?></td>

                                            </tr>
                                            <?php
                                            $no++;
                                        }?>
                                
                                            <tr>
                                                <td colspan="2">Jumlah</td>
                                                <td><?= $laki ?></td>
                                                <td><?= $perempuan ?></td>
                                                <td><?= $jumlah ?></td>                                       

                                            </tr>
                                <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>

        <div class="row hide" id="jabatan">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <a href="<?= site_url('rekap/RekapPns/excel/jabatan/' . $tahun . '/' . $bulan) ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Jumlah PNS Menurut Jenis Jabatan 
                    </div>
                    <div class="panel-body">
                        <canvas id="chart_jabatan" width="100" height="50"></canvas>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Jabatan</th>
                                        <th>Laki-laki</th>
                                        <th>Perempuan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (!empty($rekap_jabatan)) {
                                    $laki = 0;
                                    	$perempuan = 0;
                                    	$jumlah = 0;
                                        foreach ($rekap_jabatan->result() as $value) {
                                    	$laki += $value->laki;
                                    	$perempuan += $value->perempuan;
                                    	$jumlah += $value->jumlah;
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value->jenis_jabatan ?></td>
                                                <td><?= $value->laki ?></td>
                                                <td><?= $value->perempuan ?></td>
                                                <td><?= $value->jumlah ?></td>

                                            </tr>
                                            <?php
                                            $no++;
                                        }?>
                                
                                            <tr>
                                                <td colspan="2">Jumlah</td>
                                                <td><?= $laki ?></td>
                                                <td><?= $perempuan ?></td>
                                                <td><?= $jumlah ?></td>                                       

                                            </tr>
                                <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function tampil(id) {
        $('#agama').addClass('hide');
        $('#golru').addClass('hide');
        $('#golrup').addClass('hide');
        $('#kelamin').addClass('hide');
        $('#eselon').addClass('hide');
        $('#pendidikan').addClass('hide');
        $('#jabatan').addClass('hide');

        $('#' + id).removeClass('hide');

    }
</script>

<script>
    var cagama = document.getElementById("chart_agama");
    var cgolru = document.getElementById("chart_golru");
    var cgolrup = document.getElementById("chart_golrup");
    var ckelamin = document.getElementById("chart_kelamin");
    var ceselon = document.getElementById("chart_eselon");
    var cpendidikan = document.getElementById("chart_pendidikan");
    var cjabatan = document.getElementById("chart_jabatan");
    window.onload = function () {
        //AGAMA
        var myChartAgama = new Chart(cagama, {

            type: 'bar',
            data: {
                labels: <?php echo json_encode(($data_agama[0])); ?>,
                datasets: [{
                        label: "Laki-laki",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: <?php echo json_encode(($data_agama[3]), JSON_NUMERIC_CHECK); ?>,
                    },{
                        label: "Perempuan",
                        backgroundColor: "#00a65a",
                        borderColor: "#00a65a",
                        data: <?php echo json_encode(($data_agama[4]), JSON_NUMERIC_CHECK); ?>,
                    }],
            },
            options: {
                scales: {
                    xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            }
                        }],
                    yAxes: [{
                            ticks: {
                                min: 0,
                                max: <?php echo json_encode((intval(($rekap_agama->row()->jumlah) / 500) + 1) * 500, JSON_NUMERIC_CHECK); ?>,
                                maxTicksLimit: 10
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                },
                legend: {
                    display: false
                }
            }
        });
        
        //GOLRU
         new Chart(cgolru, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(($data_golru[0])); ?>,
                datasets: [{
                        label: "Laki-laki",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: <?php echo json_encode(($data_golru[3]), JSON_NUMERIC_CHECK); ?>,
                    }],
            },
            options: {
                scales: {
                    xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 16
                            }
                        }],
                    yAxes: [{
                            ticks: {
                                min: 0,
                                max: <?php echo json_encode((intval(($data_golru[2]) / 500) + 1) * 500, JSON_NUMERIC_CHECK); ?>,
                                maxTicksLimit: 10
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                },
                legend: {
                    display: false
                }
            }
        });
        
        //GOLRU
         new Chart(cgolrup, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(($data_golru[0])); ?>,
                datasets: [{
                        label: "Perempuan",
                        backgroundColor: "#00a65a",
                        borderColor: "#00a65a",
                        data: <?php echo json_encode(($data_golru[4]), JSON_NUMERIC_CHECK); ?>,
                    }],
            },
            options: {
                scales: {
                    xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 16
                            }
                        }],
                    yAxes: [{
                            ticks: {
                                min: 0,
                                max: <?php echo json_encode((intval(($data_golru[2]) / 500) + 1) * 500, JSON_NUMERIC_CHECK); ?>,
                                maxTicksLimit: 10
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                },
                legend: {
                    display: false
                }
            }
        });
        
        //KELAMIN
         new Chart(ckelamin, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(($data_kelamin[0])); ?>,
                datasets: [{
                        label: "Jumlah",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: <?php echo json_encode(($data_kelamin[1]), JSON_NUMERIC_CHECK); ?>,
                    }],
            },
            options: {
                scales: {
                    xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            }
                        }],
                    yAxes: [{
                            ticks: {
                                min: 0,
                                max: <?php echo json_encode((intval(($data_kelamin[2]) / 500) + 1) * 500, JSON_NUMERIC_CHECK); ?>,
                                maxTicksLimit: 10
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                },
                legend: {
                    display: false
                }
            }
        });
        
        //ESELON
         new Chart(ceselon, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(($data_eselon[0])); ?>,
                datasets: [{
                        label: "Laki-laki",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: <?php echo json_encode(($data_eselon[3]), JSON_NUMERIC_CHECK); ?>,
                    },{
                        label: "Perempuan",
                        backgroundColor: "#00a65a",
                        borderColor: "#00a65a",
                        data: <?php echo json_encode(($data_eselon[4]), JSON_NUMERIC_CHECK); ?>,
                    }],
            },
            options: {
                scales: {
                    xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            }
                        }],
                    yAxes: [{
                            ticks: {
                                min: 0,
                                max: <?php echo json_encode((intval(($data_eselon[2]) / 500) + 1) * 500, JSON_NUMERIC_CHECK); ?>,
                                maxTicksLimit: 10
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                },
                legend: {
                    display: false
                }
            }
        });
        
        //PENDIDIKAN
         new Chart(cpendidikan, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(($data_pendidikan[0])); ?>,
                datasets: [{
                        label: "Laki-laki",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: <?php echo json_encode(($data_pendidikan[3]), JSON_NUMERIC_CHECK); ?>,
                    },{
                        label: "Perempuan",
                        backgroundColor: "#00a65a",
                        borderColor: "#00a65a",
                        data: <?php echo json_encode(($data_pendidikan[4]), JSON_NUMERIC_CHECK); ?>,
                    }],
            },
            options: {
                scales: {
                    xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            }
                        }],
                    yAxes: [{
                            ticks: {
                                min: 0,
                                max: <?php echo json_encode((intval(($data_pendidikan[2]) / 500) + 1) * 500, JSON_NUMERIC_CHECK); ?>,
                                maxTicksLimit: 10
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                },
                legend: {
                    display: false
                }
            }
        });
        
        //JABATAN
         new Chart(cjabatan, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(($data_jabatan[0])); ?>,
                datasets: [{
                        label: "Laki-laki",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: <?php echo json_encode(($data_jabatan[3]), JSON_NUMERIC_CHECK); ?>,
                    },{
                        label: "Perempuan",
                        backgroundColor: "#00a65a",
                        borderColor: "#00a65a",
                        data: <?php echo json_encode(($data_jabatan[4]), JSON_NUMERIC_CHECK); ?>,
                    }],
            },
            options: {
                scales: {
                    xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            }
                        }],
                    yAxes: [{
                            ticks: {
                                min: 0,
                                max: <?php echo json_encode((intval(($data_jabatan[2]) / 500) + 1) * 500, JSON_NUMERIC_CHECK); ?>,
                                maxTicksLimit: 10
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                },
                legend: {
                    display: false
                }
            }
        });
    }
</script>
