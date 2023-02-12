<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Rekap PNS Unit Kerja Golongan Ruang
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
                        <form role="form" action="" method="post" >
                            <div class="form-group">
                                <div class="input-group-addon">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="btn btn-default">Tahun</div>
                                            </span>
                                            <select class="form-control " name="tahun" id="tahun" required="true">

                                                <?php
                                                foreach ($list_tahun->result() as $value) {
                                                    ?>
                                                    <option value="<?= $value->tahun ?>" <?= selected($value->tahun, $tahun, TRUE) ?> ><?= $value->tahun ?></option>
                                                <?php } ?>    
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
                                                // if($no <= date('m')) {
                                                    ?>
                                                    <option value="<?= $no ?>" <?= selected($no, $bulan, TRUE)?>><?= ($value) ?></option>
                                                <?php $no++; } 
                                            	// } ?>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Tampilkan</button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>


        <div class="row" id="golru">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    
                <div id="chart_golru" style="height: 600px;" width="100" ></div>
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <button onclick="cetak()" class="btn btn-default"><i class="fa fa-print"></i> Cetak</button>
                    <button type="button" id="btn_excel" class="btn btn-default"><i class="fa fa-print"></i> Excel</button>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Rekap PNS Unit Kerja Golongan Ruang                        
                    </div>
                    <div class="panel-body" id="target_print">
                        <style>
                            th{
                                text-align: center;
                            }
                            td{
                                padding-left: 10px;
                                padding-right: 10px;
                                text-align: right;
                            }
                        </style>
                        <table border="0" width="100%">
                            <tr>
                                <td><img src="<?= base_url('assets/images/logo_header_75.png') ?>" style="float:left;height: 75px"/></td>
                                <td>
                                    <p align="center"><b>JUMLAH PEGAWAI NEGERI SIPIL DIRINCI MENURUT UNIT KERJA / JENIS KELAMIN DAN GOLONGAN RUANG
                                            <br/>DI LINGKUNGAN PEMERINTAH KABUPATEN SANGGAU
                                            <br/>KEADAAN : <?= strtoupper(bulan($bulan)) . ' ' . $tahun ?></b></p>                                     
                                </td>
                            </tr>
                        </table>

                        <div class="table-responsive">
                            <table width="100%" border="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th rowspan="3" scope="col">NO</th>
                                        <th rowspan="3" scope="col">SATUAN KERJA</th>
                                        <th rowspan="3" scope="col">JUMLAH</th>
                                        <th colspan="18" scope="col">GOLONGAN / JENIS KELAMIN</th>
                                    </tr>
                                    <tr>
                                        <th colspan="9">LAKI-LAKI</th>
                                        <th colspan="9">PEREMPUAN</th>
                                    </tr>
                                    <tr>
                                        <th>III/c</th>
                                        <th>III/b</th>
                                        <th>III/a</th>
                                        <th>II/c</th>
                                        <th>II/b</th>
                                        <th>II/a</th>
                                        <th>I/b</th>
                                        <th>I/a</th>
                                        <th>JML</th>
                                        <th>III/c</th>
                                        <th>III/b</th>
                                        <th>III/a</th>
                                        <th>II/c</th>
                                        <th>II/b</th>
                                        <th>II/a</th>
                                        <th>I/b</th>
                                        <th>I/a</th>
                                        <th>JML</th>
                                    </tr>
                                    <tr>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>
                                        <th>7</th>
                                        <th>8</th>
                                        <th>9</th>
                                        <th>10</th>
                                        <th>11</th>
                                        <th>12</th>
                                        <th>13</th>
                                        <th>14</th>
                                        <th>15</th>
                                        <th>16</th>
                                        <th>17</th>
                                        <th>18</th>
                                        <th>19</th>
                                        <th>20</th>
                                        <th>21</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $total = array('jumlah'=>0,
                                        'laki_gol_3c'=>0,'laki_gol_3b'=>0,'laki_gol_3a'=>0,
                                        'laki_gol_2c'=>0,'laki_gol_2b'=>0,'laki_gol_2a'=>0,
                                        'laki_gol_1b'=>0,'laki_gol_1a'=>0,'laki'=>0,
                                        'perempuan_gol_3c'=>0,'perempuan_gol_3b'=>0,'perempuan_gol_3a'=>0,
                                        'perempuan_gol_2c'=>0,'perempuan_gol_2b'=>0,'perempuan_gol_2a'=>0,
                                        'perempuan_gol_1b'=>0,'perempuan_gol_1a'=>0,'perempuan'=>0);
                                    foreach ($result->result() as $value) {
                                         $total['jumlah'] += $value->jumlah ;
                                             $total['laki_gol_3c'] += $value->laki_gol_3c ;
                                             $total['laki_gol_3b'] += $value->laki_gol_3b ;
                                             $total['laki_gol_3a'] += $value->laki_gol_3a ;
                                             $total['laki_gol_2c'] += $value->laki_gol_2c ;
                                             $total['laki_gol_2b'] += $value->laki_gol_2b ;
                                             $total['laki_gol_2a'] += $value->laki_gol_2a ;
                                             $total['laki_gol_1b'] += $value->laki_gol_1b ;
                                             $total['laki_gol_1a'] += $value->laki_gol_1a ;
                                             $total['laki'] += $value->laki ;
                                             $total['perempuan_gol_3c'] += $value->perempuan_gol_3c ;
                                             $total['perempuan_gol_3b'] += $value->perempuan_gol_3b ;
                                             $total['perempuan_gol_3a'] += $value->perempuan_gol_3a ;
                                             $total['perempuan_gol_2c'] += $value->perempuan_gol_2c ;
                                             $total['perempuan_gol_2b'] += $value->perempuan_gol_2b ;
                                             $total['perempuan_gol_2a'] += $value->perempuan_gol_2a ;
                                             $total['perempuan_gol_1b'] += $value->perempuan_gol_1b ;
                                             $total['perempuan_gol_1a'] += $value->perempuan_gol_1a ;
                                             $total['perempuan'] += $value->perempuan ;
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td style="text-align: left"><?= $value->unit_nama ?></td>
                                            <td><?= $value->jumlah ?></td>
                                            <td><?= $value->laki_gol_3c ?></td>
                                            <td><?= $value->laki_gol_3b ?></td>
                                            <td><?= $value->laki_gol_3a ?></td>
                                            <td><?= $value->laki_gol_2c ?></td>
                                            <td><?= $value->laki_gol_2b ?></td>
                                            <td><?= $value->laki_gol_2a ?></td>
                                            <td><?= $value->laki_gol_1b ?></td>
                                            <td><?= $value->laki_gol_1a ?></td>
                                            <td><?= $value->laki ?></td>
                                            <td><?= $value->perempuan_gol_3c ?></td>
                                            <td><?= $value->perempuan_gol_3b ?></td>
                                            <td><?= $value->perempuan_gol_3a ?></td>
                                            <td><?= $value->perempuan_gol_2c ?></td>
                                            <td><?= $value->perempuan_gol_2b ?></td>
                                            <td><?= $value->perempuan_gol_2a ?></td>
                                            <td><?= $value->perempuan_gol_1b ?></td>
                                            <td><?= $value->perempuan_gol_1a ?></td>
                                            <td><?= $value->perempuan ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td style="text-align: right">TOTAL</td>
                                            <td><?= $total['jumlah'] ?></td>
                                            <td><?= $total['laki_gol_3c'] ?></td>
                                            <td><?= $total['laki_gol_3b'] ?></td>
                                            <td><?= $total['laki_gol_3a'] ?></td>
                                            <td><?= $total['laki_gol_2c'] ?></td>
                                            <td><?= $total['laki_gol_2b'] ?></td>
                                            <td><?= $total['laki_gol_2a'] ?></td>
                                            <td><?= $total['laki_gol_1b'] ?></td>
                                            <td><?= $total['laki_gol_1a'] ?></td>
                                            <td><?= $total['laki'] ?></td>
                                            <td><?= $total['perempuan_gol_3c'] ?></td>
                                            <td><?= $total['perempuan_gol_3b'] ?></td>
                                            <td><?= $total['perempuan_gol_3a'] ?></td>
                                            <td><?= $total['perempuan_gol_2c'] ?></td>
                                            <td><?= $total['perempuan_gol_2b'] ?></td>
                                            <td><?= $total['perempuan_gol_2a'] ?></td>
                                            <td><?= $total['perempuan_gol_1b'] ?></td>
                                            <td><?= $total['perempuan_gol_1a'] ?></td>
                                            <td><?= $total['perempuan'] ?></td>
                                        </tr>
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

<script src="<?= base_url() ?>assets/dist/js/jquery.table2excel.js"></script>
<!-- <script type="text/javascript" src="http://code.highcharts.com/stock/highstock.js"></script> -->
<script src="<?= base_url() ?>assets/plugins/highcharts/highcharts.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/highcharts-3d.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/data.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/drilldown.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/exporting.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/export-data.js"></script>
<script src="<?= base_url() ?>assets/plugins/highcharts/modules/accessibility.js"></script>
<script>
    function cetak() {
        var content = document.getElementById("target_print").innerHTML;
        var mywindow = window.open('', 'Print', 'height=600,width=800');

        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(content);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus()
        mywindow.print();
        //mywindow.close();
        //return true;
    }

	$("#btn_excel").click(function(e) {   
   // window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#target_print').html())); // content is the id of the DIV element  
   //getting values of current time for generating the file name
        var dt = new Date();
        var day = dt.getDate();
        var month = dt.getMonth() + 1;
        var year = dt.getFullYear();
        var hour = dt.getHours();
        var mins = dt.getMinutes();
        var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
        //creating a temporary HTML link element (they support setting file names)
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        // var table_div = document.getElementById('target_print');
        var table_html = encodeURIComponent($('#target_print').html());
        a.href = data_type + ', ' + table_html;
        //setting the file name
        a.download = 'Reakap_PNS_Unit_Kerja_Golongan_Ruang_' + postfix + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
    e.preventDefault();   
});  


        $(function() {
            // prevent default drilldown
            var colors = ['#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6', 
		  '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D',
		  '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A', 
		  '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC',
		  '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC', 
		  '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399',
		  '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680', 
		  '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933',
		  '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3', 
		  '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF'];
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
            function getRandomInt(max) {
                return Math.floor(Math.random() * max);
            }

            // set chart options
            <?php $no = 1;
            foreach ($rekap_golru->result_array() as $key) : ?>

                var barChart<?= $no++; ?> = {
                    series: [

                        {
                            name: 'Laki-laki',
                            color: colors[getRandomInt(50)],
                            data: [
                                <?php $height = 0; foreach ($rekap_golru_unit->result_array() as $key2) : ?>
                                    <?php if ($key['golru'] == $key2['golru']) : ?>
                                        <?= $key2['laki'] ?>,
                                    <?php $height++; endif; ?>
                                <?php endforeach; ?>
                            ]
                        },
                        {
                            name: 'Perempuan',
                            color: colors[getRandomInt(50)],
                            data: [
                                <?php foreach ($rekap_golru_unit->result_array() as $key2) : ?>
                                    <?php if ($key['golru'] == $key2['golru']) : ?>
                                        <?= $key2['perempuan'] ?>,
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            ]
                        },
                    ],
                    xAxis: {
                    type: 'category',
                        categories: [
                            <?php foreach ($rekap_golru_unit->result_array() as $key2) : ?>
                                <?php if ($key['golru'] == $key2['golru']) : ?> '<?= $key2['unit'] ?>',
                                <?php endif; ?>
                            <?php endforeach; ?>
                        ],
                    min: 0,
                    // max: 10,
                    scrollbar: {
                        enabled: true
                    },
                    tickLength: 0
                    },
                    yAxis: {
                        min: 0,
                        // max: 1200,
                        title: {
                            text: 'Jumlah',
                            align: 'high'
                        }
                    },
                    chart: {
                        events: {
                            load: function() {
                                this.showDrillUpButton();
                            }
                        },
                        type: 'bar',
                        height: 500 + <?= $height*17 ?>,
                        // inverted: true,
                        // height: 2000,
                        // options3d: {
                        //     enabled: true,
                        //     alpha: 15,
                        //     beta: 15,
                        //     depth: 50,
                        //     viewDistance: 25
                        // }
                    },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: false,
                            // format: '{point.y:.1f}'
                        },
                        minPointLength: 3
                    }
                },
                    title: {
                        text: 'Jumlah PNS Menurut Golongan Ruang  ' + seriesName + '  <?= $unit != null ? $unit : ''; ?>'
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
                                foreach ($rekap_golru->result_array() as $key) : ?>
                                    seriesName = e.point.name;
                                    if (e.point.name == '<?= $key['golru'] ?>') {
                                        $(chart.renderTo).highcharts($.extend(true, {}, barChart<?= $no++ ?>));
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
                    text: 'Jumlah PNS Menurut Golongan Ruang   <?= $unit != null ? $unit : ''; ?>'
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
                        },
                    minPointLength: 3
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> <br/>'
                },
                series: [{
                    color: colors[getRandomInt(50)],
                    name: 'Laki-laki & Perempuan',
                    type: 'column',
                    data: [

                        <?php foreach ($rekap_golru->result_array() as $key) : ?> {
                                name: "<?= $key['golru'] ?>",
                                y: <?= $key['jumlah'] ?>,
                                drilldown: true
                            },
                        <?php endforeach; ?>
                    ]
                }]
            };

            // create the chart
            $('#chart_golru').highcharts($.extend(true, {}, colChart));
        });


</script>