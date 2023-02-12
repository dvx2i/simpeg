<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Rekap Unit Kerja Golongan Jenis Kelamin
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
                    <div style="float: right;padding-top: 3px;padding-right: 13px">
                        <button onclick="cetak()" class="btn btn-default"><i class="fa fa-print"></i> Cetak</button>
                    	<button type="button" id="btn_excel" class="btn btn-default"><i class="fa fa-print"></i> Excel</button>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-users fa-fw"></i> Rekap Unit Kerja Golongan Jenis Kelamin                      
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
                            <td></td>
                                <td><img src="<?= base_url('assets/images/logo_header_75.png') ?>" style="float:left;height: 75px"/></td>
                                <td>
                                    <p align="center"><b>JUMLAH PEGAWAI NEGERI SIPIL DIRINCI MENURUT UNIT KERJA / JENIS KELAMIN DAN GOLONGAN
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
                                        <th colspan="10" scope="col">GOLONGAN / JENIS KELAMIN</th>
                                    </tr>
                                    <tr>
                                        <th colspan="5">LAKI-LAKI</th>
                                        <th colspan="5">PEREMPUAN</th>
                                    </tr>
                                    <tr>                                    
                                        <th>IV</th>
                                        <th>III</th>
                                        <th>II</th>
                                        <th>I</th>
                                        <th>JUMLAH</th>

                                        <th>IV</th>
                                        <th>III</th>
                                        <th>II</th>
                                        <th>I</th>
                                        <th>JUMLAH</th>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $total['jumlah'] = 0;
                                    $total['laki_gol_4'] = 0;
                                    $total['laki_gol_3'] = 0;
                                    $total['laki_gol_2'] = 0;
                                    $total['laki_gol_1'] = 0;
                                    $total['laki'] = 0;
                                    $total['perempuan_gol_4'] = 0;
                                    $total['perempuan_gol_3'] = 0;
                                    $total['perempuan_gol_2'] = 0;
                                    $total['perempuan_gol_1'] = 0;
                                    $total['perempuan'] = 0;
                                    foreach ($result->result() as $value) {
                                        $total['jumlah'] += $value->jumlah;
                                        $total['laki_gol_4'] += $value->laki_gol_4;
                                        $total['laki_gol_3'] += $value->laki_gol_3;
                                        $total['laki_gol_2'] += $value->laki_gol_2;
                                        $total['laki_gol_1'] += $value->laki_gol_1;
                                        $total['laki'] += $value->laki;
                                        $total['perempuan_gol_4'] += $value->perempuan_gol_4;
                                        $total['perempuan_gol_3'] += $value->perempuan_gol_3;
                                        $total['perempuan_gol_2'] += $value->perempuan_gol_2;
                                        $total['perempuan_gol_1'] += $value->perempuan_gol_1;
                                        $total['perempuan'] += $value->perempuan;
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td style="text-align: left"><?= $value->unit_nama ?></td>
                                            <td><?= $value->jumlah ?></td>
                                            <td><?= $value->laki_gol_4 ?></td>
                                            <td><?= $value->laki_gol_3 ?></td>
                                            <td><?= $value->laki_gol_2 ?></td>
                                            <td><?= $value->laki_gol_1 ?></td>
                                            <td><?= $value->laki ?></td>
                                            <td><?= $value->perempuan_gol_4 ?></td>
                                            <td><?= $value->perempuan_gol_3 ?></td>
                                            <td><?= $value->perempuan_gol_2 ?></td>
                                            <td><?= $value->perempuan_gol_1 ?></td>
                                            <td><?= $value->perempuan ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td style="text-align: right">TOTAL</td>
                                        <td><?= $total['jumlah'] ?></td>
                                        <td><?= $total['laki_gol_4'] ?></td>
                                        <td><?= $total['laki_gol_3'] ?></td>
                                        <td><?= $total['laki_gol_2'] ?></td>
                                        <td><?= $total['laki_gol_1'] ?></td>
                                        <td><?= $total['laki'] ?></td>
                                        <td><?= $total['perempuan_gol_4'] ?></td>
                                        <td><?= $total['perempuan_gol_3'] ?></td>
                                        <td><?= $total['perempuan_gol_2'] ?></td>
                                        <td><?= $total['perempuan_gol_1'] ?></td>
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

<script>
    function cetak() {
        var content = document.getElementById("target_print").innerHTML;
        var mywindow = window.open('', 'Print', 'height = 600, width = 800');

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
        a.download = 'Rekap_Golongan_Unit_Kerja' + postfix + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
    e.preventDefault();   
});   
</script>