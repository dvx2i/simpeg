<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Rekap Jumlah PNS Menurut Tingkat Pendidikan
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
                        <form role="form" action="<?= site_url('rekap/PnsPegawaiPendidikan/view') ?>" method="post">
                        <input type="hidden" name="jenis_rekap" id="jenis_rekap" value="1">
                            <div class="form-group">
                                <div class="input-group-addon">
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="btn btn-default">Tahun &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                                            </span>
                                            <select class="form-control " name="tahun" id="tahun" required="true">

                                                <?php
                                                $tahuns = array();

                                                foreach ($list_tahun->result() as $value) {
                                                    array_push($tahuns, $value->tahun);
                                                ?>
                                                    <option value="<?= $value->tahun ?>" <?= selected($value->tahun, $tahun, TRUE) ?>><?= $value->tahun ?></option>
                                                <?php }
                                                if (!in_array(date('Y'), $tahuns)) {
                                                    echo '<option value="' . date('Y') . '" selected="selected" >' . date('Y') . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3" id="bulan-div1">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="btn btn-default">Bulan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                                            </span>
                                            <select class="form-control " name="bulan" id="bulan" required="true">

                                                <?php
                                                $no = 1;
                                                foreach (bulan_indo() as $value) {
                                                ?>
                                                    <option value="<?= $no ?>" <?= selected($bulan, $no, TRUE) ?>><?= ($value) ?></option>
                                                <?php $no++;
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="btn btn-default">Unit &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                                            </span>
                                            <select class="form-control " name="unit" id="unit">
                                                <option value="">Semua</option>
                                                <?php foreach ($list_unit->result_array() as $key) : ?>
                                                    <option value="<?= $key['unit_nama'] ?>" <?= selected($key['unit_nama'], $unit, TRUE) ?>><?= $key['unit_nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3" style="text-align: right;">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Tampilkan</button>
                                        <!-- <?php
                                                if ($tahun == date('Y') && $bulan == date('m')) {
                                                ?>
                                            <a href="<?= site_url('rekap/CpnsPegawaiGolru/update') ?>" type="button" class="btn btn-warning"><i class="fa fa-save fa-fw"></i> Update Rekap Terbaru</a>
                                        <?php
                                                }
                                        ?> -->
                                    </div>
                                    
                                </div>

                            </div>

                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>


        <div class="row" id="pendidikan">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <button type="button" id="excel-btn" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</button>
                        <!-- <a href="<?= site_url('rekap/CpnsPegawaiPendidikan/excel/pendidikan/' . $tahun . '/' . $bulan) ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a> -->
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Jumlah PNS Menurut Pendidikan <?= $unit != null ? $unit : ''; ?>
                    </div>
                    <div class="panel-body">
                        <div id="chart_pendidikan" width="100" height="100"></div>
                        <div class="table-responsive">
                            <!-- jika jenis rekap perbandingan -->
                            <?php if ($jenis == '1') : ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pendidikan</th>
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
                            <?php endif; ?>

                            
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
    </section>
</div>

<!-- tabel to excel -->
<!-- jika jenis rekap perbandingan -->
<?php if ($jenis == '1') : ?>
    <table style="display: none;" id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th colspan="6" rowspan="2"><b>
                        <center>Rekap PNS Berdasarkan Pendidikan</center</b> </th> </tr> <tr>
            </tr>
            <tr>
                <th><b>No</b></th>
                <th><b>Unit</b></th>
                <th><b>Pendidikan</b></th>
                <th><b>Laki-laki</b></th>
                <th><b>Perempuan</b></th>
                <th><b>Jumlah</b></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $jumlah = 0;
            if (!empty($rekap_pendidikan)) {
                foreach ($rekap_pendidikan->result() as $value) {
            ?>
                    <?php
                    foreach ($rekap_pendidikan_unit->result() as $value2) {
                        if ($value->pendidikan == $value2->pendidikan) {
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value2->unit ?></td>
                                <td><?= $value2->pendidikan ?></td>
                                <td><?= $value2->laki ?></td>
                                <td><?= $value2->perempuan ?></td>
                                <td><?= $value2->jumlah ?></td>

                            </tr>
                    <?php }
                    } ?>
                    <tr>
                        <td colspan="5">
                            <center><b>Jumlah <?= $value->pendidikan ?></b></center>
                        </td>
                        <td><b><?= $value->jumlah ?></b></td>
                    </tr>
                <?php
                    // $no++;
                    $jumlah = ($jumlah + $value->jumlah);
                } ?>

                <tr>
                    <td colspan="5">
                        <center><b>Jumlah Keseluruhan</b></center>
                    </td>
                    <td><b><?= $jumlah ?></b></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php endif; ?>



<!-- <script src="<?= base_url() ?>assets/plugins/TableToExcel/jquery.tableToExcel.js"></script> -->
<script src="<?= base_url() ?>assets/dist/js/jquery.table2excel.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/highcharts.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/highcharts-3d.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/cylinder.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/data.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/drilldown.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/exporting.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/export-data.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/accessibility.js"></script>
<script>
    var form = $('#form-filter');
    $('#excel-btn').click(function() {
        $("#example").table2excel({
            exclude: ".excludeThisClass",
            name: "Rekap_PNS_Berdasarkan_Pendidikan",
            filename: "Rekap_PNS_Berdasarkan_Pendidikan.xls", // do include extension
            preserveColors: false // set to true if you want background colors and font colors preserved
        });
        // $('#example').tblToExcel();
        // $.ajax({
        //     type: "POST",
        //     url: '<?= site_url('rekap/PegawaiAgama/excel/') ?>',
        //     data: form.serialize(),
        //     success: function() {
        //         // console.log(response);
        //         // $('#show-pdf-content').html(response);
        //     }
        // });
    });

    function tampil(id) {
        $('#pendidikan').addClass('hide');
        $('#pendidikan').addClass('hide');
        $('#pendidikanp').addClass('hide');
        $('#kelamin').addClass('hide');
        $('#pendidikan').addClass('hide');
        $('#pendidikan').addClass('hide');
        $('#pendidikan').addClass('hide');

        $('#' + id).removeClass('hide');

    }
    
</script>

<script>
<?php if ($jenis == '1') : ?>
        // Highcharts.setOptions({
        //     lang: {
        //         drillUpText: '<'
        //     }
        // });

        // Highcharts.chart('chart_pendidikan', {
        //     chart: {
        //         type: 'column',
        //         height: 600,
        //         options3d: {
        //             enabled: true,
        //             alpha: 15,
        //             beta: 15,
        //             depth: 50,
        //             viewDistance: 25
        //         }
        //     },
        //     title: {
        //         text: 'Jumlah PNS Menurut Tingkat Pendidikan   <?= $unit != null ? $unit : ''; ?>'
        //     },
        //     subtitle: {
        //         text: 'sipedas.sanggau.go.id</a>'
        //     },
        //     accessibility: {
        //         announceNewData: {
        //             enabled: true
        //         }
        //     },
        //     xAxis: {
        //         type: 'category'
        //     },
        //     yAxis: {
        //         title: {
        //             text: 'Total PNS'
        //         }

        //     },
        //     legend: {
        //         enabled: true
        //     },
        //     plotOptions: {
        //         series: {
        //             borderWidth: 0,
        //             dataLabels: {
        //                 enabled: false,
        //                 // format: '{point.y:.1f}'
        //             }
        //         }
        //     },

        //     tooltip: {
        //         headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        //         pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> <br/>'
        //     },

        //     series: [{
        //         name: "Laki-laki & Perempuan",
        //         data: [
        //             <?php foreach ($rekap_pendidikan->result_array() as $key) : ?> {
        //                     name: "<?= $key['pendidikan'] ?>",
        //                     y: <?= $key['jumlah'] ?>,
        //                     drilldown: "<?= 'jumlah' . $key['pendidikan'] ?>"
        //                 },
        //             <?php endforeach; ?>
        //         ]
        //     }, {
        //         name: "Laki-laki",
        //         data: [
        //             <?php foreach ($rekap_pendidikan->result_array() as $key) : ?> {
        //                     y: <?= $key['laki'] ?>,
        //                     drilldown: "<?= 'laki' . $key['pendidikan'] ?>"
        //                 },
        //             <?php endforeach; ?>
        //         ]
        //     }, {
        //         name: "Perempuan",
        //         data: [
        //             <?php foreach ($rekap_pendidikan->result_array() as $key) : ?> {
        //                     y: <?= $key['perempuan'] ?>,
        //                     drilldown: "<?= 'perempuan' . $key['pendidikan'] ?>"
        //                 },
        //             <?php endforeach; ?>
        //         ]
        //     }, ],
        //     drilldown: {
        //         allowPointDrilldown: true,
        //         series: [
        //             <?php foreach ($rekap_pendidikan->result_array() as $key) : ?> {
        //                     name: "Laki-laki & Perempuan",
        //                     type: 'bar',
        //                     // inverted: true,
        //                     id: "<?= 'jumlah' . $key['pendidikan'] ?>",
        //                     data: [
        //                         <?php foreach ($rekap_pendidikan_unit->result_array() as $key2) : ?>
        //                             <?php if ($key['pendidikan'] == $key2['pendidikan']) : ?> {
        //                                     name: "<?= $key2['unit'] ?>",
        //                                     y: <?= $key2['jumlah'] ?>,
        //                                 },
        //                             <?php endif; ?>
        //                         <?php endforeach; ?>
        //                     ]
        //                 },
        //             <?php endforeach; ?>
        //             <?php foreach ($rekap_pendidikan->result_array() as $key) : ?> {
        //                     name: "Laki-laki",
        //                     id: "<?= 'laki' . $key['pendidikan'] ?>",
        //                     data: [
        //                         <?php foreach ($rekap_pendidikan_unit->result_array() as $key2) : ?>
        //                             <?php if ($key['pendidikan'] == $key2['pendidikan']) : ?> {
        //                                     name: "<?= $key2['unit'] ?>",
        //                                     y: <?= $key2['laki'] ?>,
        //                                 },
        //                             <?php endif; ?>
        //                         <?php endforeach; ?>
        //                     ]
        //                 },
        //             <?php endforeach; ?>
        //             <?php foreach ($rekap_pendidikan->result_array() as $key) : ?> {
        //                     name: "Perempuan",
        //                     id: "<?= 'perempuan' . $key['pendidikan'] ?>",
        //                     data: [
        //                         <?php foreach ($rekap_pendidikan_unit->result_array() as $key2) : ?>
        //                             <?php if ($key['pendidikan'] == $key2['pendidikan']) : ?> {
        //                                     name: "<?= $key2['unit'] ?>",
        //                                     y: <?= $key2['perempuan'] ?>,
        //                                 },
        //                             <?php endif; ?>
        //                         <?php endforeach; ?>
        //                     ]
        //                 },
        //             <?php endforeach; ?>
        //         ]
        //     }
        // });


        $(function() {
            // prevent default drilldown
            var seriesName = '';
            var drilldownBackText = '<< Back',
                noop = function() {};
            Highcharts.Chart.prototype.drillUp = function() {
                var chart = this;
                setTimeout(function() {
                    $(chart.renderTo).highcharts($.extend(true, {}, colChart));
                }, 0);
            };
            Highcharts.Chart.prototype.getDrilldownBackText = function() {
                return drilldownBackText;
            };

            // set chart options
            <?php $no = 1;
            foreach ($rekap_pendidikan->result_array() as $key) : ?>
                var barChart<?= $no++; ?> = {
                    series: [

                        {
                            type: 'column',
                            name: 'Laki-laki',
                            data: [
                                <?php foreach ($rekap_pendidikan->result_array() as $key2) : ?>
                                    <?php if ($key['pendidikan'] == $key2['pendidikan']) : ?>
                                        <?= $key2['laki'] ?>,
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            ]
                        },
                        {
                            type: 'column',
                            name: 'Perempuan',
                            data: [
                                <?php foreach ($rekap_pendidikan->result_array() as $key2) : ?>
                                    <?php if ($key['pendidikan'] == $key2['pendidikan']) : ?>
                                        <?= $key2['perempuan'] ?>,
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            ]
                        },
                    ],
                    xAxis: {
                        categories: [ '<?= $key['pendidikan'] ?>'
                        ]
                    },
                    chart: {
                        events: {
                            load: function() {
                                this.showDrillUpButton();
                            }
                        },
                        type: 'column',
                        // inverted: true,
                        // height: 2000,
                        options3d: {
                            enabled: true,
                            alpha: 15,
                            beta: 15,
                            depth: 50,
                            viewDistance: 25
                        }
                    },
                    title: {
                        text: 'Jumlah PNS Menurut Pendidikan  ' + seriesName + '  <?= $unit != null ? $unit : ''; ?>'
                    },
                    subtitle: {
                        text: 'sipedas.sanggau.go.id</a>'
                    },
                }
            <?php endforeach; ?>

            colChart = {
                chart: {
                    events: {
                        drilldown: function(e) {
                            var chart = this;
                            // console.log(e.seriesOptions)
                            drilldownBackText = e.category || (e.point && e.point.name) || 'Back';
                            drilldownBackText = '<< ' + drilldownBackText;
                            setTimeout(function() {
                                <?php $no = 1;
                                foreach ($rekap_pendidikan->result_array() as $key) : ?>
                                    seriesName = e.point.name;
                                    if (e.point.name == '<?= $key['pendidikan'] ?>') {
                                        $(chart.renderTo).highcharts($.extend(true, {}, barChart<?= $no++; ?>));
                                    }
                                <?php endforeach; ?>
                            }, 0);
                        }
                    },
                    type: 'column',
                    // inverted: true,
                    height: 600,
                    options3d: {
                        enabled: true,
                        alpha: 15,
                        beta: 15,
                        depth: 50,
                        viewDistance: 25
                    }
                },
                title: {
                    text: 'Jumlah PNS Menurut Pendidikan   <?= $unit != null ? $unit : ''; ?>'
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
                    data: [

                        <?php foreach ($rekap_pendidikan->result_array() as $key) : ?> {
                                name: "<?= $key['pendidikan'] ?>",
                                y: <?= $key['jumlah'] ?>,
                                drilldown: true
                            },
                        <?php endforeach; ?>
                    ]
                }]
            };

            // create the chart
            $('#chart_pendidikan').highcharts($.extend(true, {}, colChart));
        });
    </script>
<?php endif ?>
