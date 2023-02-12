<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">               

    <section class="content-header">
        <?php echo $this->session->flashdata('message'); ?>
        <h1>
            Rekap Golongan, Status Pegawai dan Jenis Kelamin
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
                        <i class="fa fa-users fa-fw"></i> Rekap Golongan, Status Pegawai dan Jenis Kelamin                        
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
                                    <p align="center"><b>JUMLAH PEGAWAI NEGERI SIPIL DIRINCI MENURUT GOLONGAN RUANG / STATUS PEGAWAI DAN JENIS KELAMIN
                                            <br/>DI LINGKUNGAN PEMERINTAH KABUPATEN SANGGAU
                                            <br/>KEADAAN : <?= strtoupper(bulan($bulan)) . ' ' . $tahun ?></b></p>
                                </td>
                            </tr>
                        </table>

                        <div class="table-responsive">
                            <table width="100%" border="1" cellspacing="0">
                                <thead>
                                    <tr align="center">
                                        <th align="center" rowspan="3" scope="col">GOLONGAN RUANG</th>
                                        <th rowspan="3" scope="col">JUMLAH</th>
                                        <th colspan="8" scope="col">STATUS PEGAWAI / JENIS KELAMIN</th>
                                        <th rowspan="3" scope="col">%</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" align="center">CPNS</th>
                                        <th colspan="4" align="center">PNS</th>
                                    </tr>
                                    <tr>
                                        <th align="center">PRIA</th>
                                        <th align="center">WANITA</th>
                                        <th align="center">JUMLAH</th>
                                        <th align="center">%</th>
                                        <th align="center">PRIA</th>
                                        <th align="center">WANITA</th>
                                        <th align="center">JUMLAH</th>
                                        <th align="center">%</th>
                                    </tr>
                                </thead>
                                <tr align="center">
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
                                </tr>
                                <?php
                                $total['jumlah'] = 0;
                                $total['cpns_laki'] = 0;
                                $total['cpns_perempuan'] = 0;
                                $total['cpns'] = 0;
                                $total['cpns_persen'] = 0;
                                $total['pns_laki'] = 0;
                                $total['pns_perempuan'] = 0;
                                $total['pns'] = 0;
                                $total['pns_persen'] = 0;
                                $total['persen'] = 0;
                                foreach ($result->result() as $value) {
                                    $total['jumlah'] += $value->jumlah;
                                    $total['cpns_laki'] += $value->cpns_laki;
                                    $total['cpns_perempuan'] += $value->cpns_perempuan;
                                    $total['cpns'] += $value->cpns;
                                    $total['cpns_persen'] += $value->cpns / $value->jumlah * 100;
                                    $total['pns_laki'] += $value->pns_laki;
                                    $total['pns_perempuan'] += $value->pns_perempuan;
                                    $total['pns'] += $value->pns;
                                    $total['pns_persen'] += $value->pns / $value->jumlah * 100;
                                }
                                foreach ($result->result() as $value) {
                                    ?>
                                    <tr>
                                        <th><?= $value->golru ?></th>
                                        <td><?= $value->jumlah ?></td>
                                        <td><?= $value->cpns_laki ?></td>
                                        <td><?= $value->cpns_perempuan ?></td>
                                        <td><?= $value->cpns ?></td>
                                        <td><?= number_format($value->cpns / $value->jumlah * 100, 1) . ' %' ?></td>
                                        <td><?= $value->pns_laki ?></td>
                                        <td><?= $value->pns_perempuan ?></td>
                                        <td><?= $value->pns ?></td>
                                        <td><?= number_format($value->pns / $value->jumlah * 100, 1) . ' %' ?></td>
                                        <td><?= number_format($value->jumlah / ($total['jumlah'] / 2) * 100, 1) . ' %' ?></td>
                                    </tr>
                                    <?php
                                    $total['persen'] += $value->jumlah / ($total['jumlah'] / 2) * 100;
                                }
                                ?>
                                <tr>
                                    <td><b>JUMLAH</b></td>
                                    <td><?= $total['jumlah'] / 2 ?></td>
                                    <td><?= $total['cpns_laki'] / 2 ?></td>
                                    <td><?= $total['cpns_perempuan'] / 2 ?></td>
                                    <td><?= $total['cpns'] / 2 ?></td>
                                    <td><?= number_format((($total['cpns'] / 2) / ($total['jumlah'] / 2) * 100), 1) . ' %' ?></td>
                                    <td><?= $total['pns_laki'] / 2 ?></td>
                                    <td><?= $total['pns_perempuan'] / 2 ?></td>
                                    <td><?= $total['pns'] / 2 ?></td>
                                    <td><?= number_format((($total['pns'] / 2) / ($total['jumlah'] / 2) * 100), 1) . ' %' ?></td>
                                    <td><?= number_format($total['persen'] / 2, 1) . ' %' ?></td>
                                </tr>
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
        a.download = 'Rekap_Golongan_' + postfix + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
    e.preventDefault();   
});   
</script>